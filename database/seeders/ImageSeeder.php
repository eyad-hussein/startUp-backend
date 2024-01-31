<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Services\FirestoreService;
use App\Models\Image;

class ImageSeeder extends Seeder
{
    protected $firestoreService;

    public function __construct(FirestoreService $firestoreService)
    {
        $this->firestoreService = $firestoreService;
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imageUrls = $this->firestoreService->getImageUrlsFromStorage("styleach.appspot.com");

        foreach ($imageUrls as $imageUrl) {
            Image::create(['url' => $imageUrl, 'alt' => 'image']);
        }
    }
}
