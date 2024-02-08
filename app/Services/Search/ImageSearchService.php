<?php

namespace App\Services\Search;

use Illuminate\Support\Facades\Storage;

class ImageSearchService
{
    protected $image;
    public function setImage(object $image)
    {
        $this->image = $image;
    }

    public function requestUrlSimilarImages(){
        // Should Have Function
    }
}
