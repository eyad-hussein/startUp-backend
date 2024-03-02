<?php

namespace App\Services\Search;

use App\Services\S3StorageService;
use Illuminate\Http\UploadedFile;

class TextSearchService
{
    protected FastApiService $fastApiService;
    protected $s3StorageService;


    public function __construct(FastApiService $fastApiService,S3StorageService $s3StorageService)
    {
        $this->fastApiService = $fastApiService;
        $this->s3StorageService = $s3StorageService;

    }
    public function requestSimilarImages(string $text)
    {
        $imagesList = $this->fastApiService->requestSimilarImagesFromText($text);
//        $imagePaths = [
//            "/storage/logo1.png",
//            "/storage/logo2.png",
//            "/storage/logo2.png",
//        ];
//        $imagesList = [];
//        foreach ($imagePaths as $path) {
//            $imageData = file_get_contents(public_path($path));
//            if ($imageData !== false) {
//                $imagesList[] = $imageData;
//            }
//        }
        $imagesPath = [];
        foreach($imagesList as $image){
//            $tempFilePath = tempnam(sys_get_temp_dir(), 'uploaded_image');
//            file_put_contents($tempFilePath, $image);
//            $finfo = finfo_open(FILEINFO_MIME_TYPE);
//            $mime = finfo_file($finfo, $tempFilePath);
//            $uploadedFile = new UploadedFile($tempFilePath, 'uploaded_image', $mime, null, true);
            $imagesPath[] = $this->s3StorageService->storeTempImage($image,'png');
        }

        return $imagesPath;
    }
}
