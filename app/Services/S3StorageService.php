<?php

namespace App\Services;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class S3StorageService
{

    public function storeImage(UploadedFile $image, string $folder, string $name)
    {
        $path = $image->storeAs($folder, $name, 's3');
        return $path;
    }

    public function storeMetaData(string $path, int $product_id, array $images): string
    {
        $metaData = [
            'product_id' => $product_id,
            'thumbnail' => $this->storeImage($images['thumbnail'], $path . '/images/thumbnail', 'thumbnail' . $images['thumbnail']->getClientOriginalExtension()),
            'colors' => [],
        ];

        for ($i = 0; $i < count($images['colors']); $i++) {
            $metaData['colors'][$i] = [
                'color' => $images['colors'][$i]['color'],
                'images' => [],
            ];

            for ($j = 0; $j < count($images['colors'][$i]['images']); $j++) {
                $metaData['colors'][$i]['images'][$j] = $this->storeImage($images['colors'][$i]['images'][$j], $path . '/images/colors/' . $images['colors'][$i]['color'], $images['colors'][$i]['color'] . $j . $images['colors'][$i]['images'][$j]->getClientOriginalExtension());
            }
        }

        $jsonfile = json_encode($metaData);

        Storage::disk('s3')->put($path . '/meta_data.json', $jsonfile);
        return $path . '/meta_data.json';
    }

    public function retrieveProductsWithAccuracies(array $similarProducts): array
    {
        $productsWithAccuracies = [];

        foreach ($similarProducts as $similarProduct) {
            $jsonfile = Storage::disk('s3')->get(Product::find($similarProduct['product_id'])->meta_data_url);
            $metaData = json_decode($jsonfile, true);

            $productsWithAccuracies[] = [
                'product' => $metaData,
                'accuracy' => $similarProduct['accuracy'],
            ];
        }

        return $productsWithAccuracies;
    }

    public function test()
    {
        $jsonfile = Storage::disk('s3')->get('categories/dress/meta_data.json');

        return json_decode($jsonfile, true);
    }
}