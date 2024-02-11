<?php

namespace App\Services\Search;

class FastApiService
{
    // what is the type of $image?
    public function retrieveSimilarImagesWithAccuracties(object $image)
    {

        // logic for retrieving similar images with accuracies from fastapi
        $result = [
            "images" => [
                "image1" => ["url" => "link", "accuracy" => 0.9],
            ],
        ];
        return $result;
    }

}
