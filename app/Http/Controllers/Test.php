<?php

namespace App\Http\Controllers;

use App\Services\FirestoreService;
use App\Models\Image;
use Illuminate\Http\Request;

class Test extends Controller
{
    protected $firestoreService;

    public function __construct(FirestoreService $firestoreService)
    {
        $this->firestoreService = $firestoreService;
    }

    public function index()
    {
        $imageUrls = $this->firestoreService->getImageUrlsWithStructure("styleach.appspot.com");
        ;

        // foreach ($imageUrls as $imageUrl) {
        //     Image::create(['url' => $imageUrl, 'alt' => 'image']);
        // }

        return response([
            'images' => $imageUrls,
        ]);
    }
}



// class ImageSeeder extends Seeder
// {
//     protected $firestoreService;

//     public function __construct(FirestoreService $firestoreService)
//     {
//         $this->firestoreService = $firestoreService;
//     }
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         $imageUrls = $this->firestoreService->getImageUrlsFromStorage("styleach.appspot.com");

//         foreach ($imageUrls as $imageUrl) {
//             Image::create(['url' => $imageUrl, 'alt' => 'image']);
//         }
//     }
// }

