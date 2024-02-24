<?php

namespace App\Services\Search;

use http\Env\Response;
use Illuminate\Support\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use App\Enums\CategoryEnum;

class FastApiService
{
    private $fastApiUrl;

    public function __construct()
    {
        $this->fastApiUrl = env('FAST_API_URL');
    }
    public function requestCategoryOfProduct(UploadedFile $image): CategoryEnum
    {
        $response = Http::attach(
            'image',
            file_get_contents($image->path()),
            $image->getClientOriginalName()
        )->post($this->fastApiUrl . '/get-category');

        $result = $response->json();

        return CategoryEnum::convertToEnum($result['category']);
    }

    public function requestSimilarProducts(Collection $vectorRepresentationsOfCategoryWithProductIds): array
    {
        $response = Http::post($this->fastApiUrl . '/get-similar-products', [
            'vector_representations_with_product_ids' => $vectorRepresentationsOfCategoryWithProductIds
        ]);

        return $response->json();
    }

    public function convertToVector(UploadedFile $image): array
    {
        $response = Http::post($this->fastApiUrl . '/convert-to-vector', [
            'image' => $image
        ]);

        return $response->json();
    }

    public function getSimilarImagesFromText(string $description): array
    {
        $response = Http::post($this->fastApiUrl.'/request-images-from-text',[
           'text' => $description
        ]);

        return $response->json();
    }

}
