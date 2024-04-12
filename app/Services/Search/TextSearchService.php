<?php

namespace App\Services\Search;

use App\Services\S3StorageService;
use Illuminate\Http\UploadedFile;

class TextSearchService
{
    protected FastApiService $fastApiService;
    protected $s3StorageService;


    public function __construct(FastApiService $fastApiService, S3StorageService $s3StorageService)
    {
        $this->fastApiService = $fastApiService;
        $this->s3StorageService = $s3StorageService;

    }
    public function requestSimilarImages(string $text)
    {
        // $imagesCodedList = $this->fastApiService->requestSimilarImagesFromText($text)['images'];

        // return $this->s3StorageService->storeTempImages($imagesCodedList);

        return response(
            [
                "urls" => [
                    'https://images.unsplash.com/photo-1557683316-973673baf926',
                    'https://images.unsplash.com/photo-1557683316-973673baf926',
                    'https://images.unsplash.com/photo-1557683316-973673baf926',
                ]
            ]
        );
    }
}
