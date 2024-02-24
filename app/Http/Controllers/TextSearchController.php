<?php

namespace App\Http\Controllers;

use App\Services\Search\TextSearchService;
use Illuminate\Http\Request;


class TextSearchController
{
    protected $textSearchService;

    public function __construct(TextSearchService $textSearchService)
    {
        $this->textSearchService = $textSearchService;
    }

    public function requestImagesFromText(Request $request)
    {
        $imagesCorrespondingToText = $this->textSearchService->requestImagesFromText($request['text']);
        return response(
            [
                'images' => $imagesCorrespondingToText,
            ]
        );
    }
}
