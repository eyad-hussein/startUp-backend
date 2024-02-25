<?php

namespace App\Services\Search;

class TextSearchService
{
    protected FastApiService $fastApiService;

    public function __construct(FastApiService $fastApiService)
    {
        $this->fastApiService = $fastApiService;
    }
    public function requestImagesFromText(string $text): array
    {
        return $this->fastApiService->requestSimilarImagesFromText($text);
    }
}
