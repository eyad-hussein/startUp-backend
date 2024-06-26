<?php

namespace App\Http\Controllers;

use App\Http\Requests\Image\StoreImageRequest;
use App\Http\Requests\Image\UpdateImageRequest;
use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Image\ImageCollection;
use App\Models\Image;
use App\Services\FirestoreService;


class ImageController extends Controller
{
    protected $firestoreService;

    public function __construct(FirestoreService $firestoreService)
    {
        $this->firestoreService = $firestoreService;
    }


    public function index(): ImageCollection
    {
        return new ImageCollection(Image::all());
    }

    public function store(StoreImageRequest $request): ImageResource
    {
        $image = Image::create($request->validated());
        return response()->json($image, 201);
    }

    public function show(Image $image): ImageResource
    {
        return new ImageResource($image);
    }
    public function update(UpdateImageRequest $request, Image $image): ImageResource
    {
        $image->update($request->validated());
        return new ImageResource($image);
    }

    public function destroy(Image $image)
    {
        $image->delete();
        return response()->json(['message' => 'Image deleted successfully']);
    }

    public function test()
    {
        return $this->firestoreService->getImageAndSubImagesFromFirestore();
    }
}
