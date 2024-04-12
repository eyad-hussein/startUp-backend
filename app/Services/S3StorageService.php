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

    public function storeTempImages(array $codedImages)
    {
        $urls = [];

        foreach ($codedImages as $image) {
            $urls[] = $this->storeTempImage(base64_decode($image), 'temp');
        }

        return $urls;
    }

    public function storeTempImage(string $binaryData, string $path, string $extension = 'png')
    {
        $randomName = uniqid() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
        $url = Storage::disk('s3')->put($path . '/' . $randomName, $binaryData);

        return $url;
    }

    public function getImage(string $url){
        $imageFileData = Storage::disk('s3')->get($url);
        return new UploadedFile(
            $imageFileData,
            basename($url),
            mime_content_type($url),
            null,
            true
        );
    }

    public function emptyFolder(string $folderPath): void
    {
        // Get a list of all files in the folder
        $files = Storage::disk('s3')->files($folderPath);
        foreach ($files as $file) {
            Storage::disk('s3')->delete($file);
        }
    }


}
