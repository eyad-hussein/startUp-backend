<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubImage\StoreSubImageRequest;
use App\Http\Requests\SubImage\UpdateSubImageRequest;
use App\Http\Resources\SubImage\SubImageResource;
use App\Http\Resources\SuImage\SubImageCollection;
use App\Models\SubImage;
use Illuminate\Http\Request;

class SubImageController extends Controller
{
    public function index(): SubImageCollection
    {
        return new SubImageCollection(SubImage::all());
    }

    public function store(StoreSubImageRequest $request): SubImageResource
    {
        $subImage = SubImage::create($request->validated());
        return new SubImageResource($subImage);
    }

    public function show(SubImage $subImage): SubImageResource
    {
        return new SubImageResource($subImage);
    }

    public function update(UpdateSubImageRequest $request, SubImage $subImage): SubImageResource
    {
        $subImage->update($request->validated());

        return new SubImageResource($subImage);
    }

    public function destroy(SubImage $subImage)
    {
        $subImage->delete();

        return response()->json(['message' => 'SubImage deleted successfully']);
    }
}
