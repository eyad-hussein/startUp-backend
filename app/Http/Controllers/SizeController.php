<?php

namespace App\Http\Controllers;

use App\Http\Requests\Size\StoreSizeRequest;
use App\Http\Requests\Size\UpdateSizeRequest;
use App\Http\Resources\Size\SizeCollection;
use App\Http\Resources\Size\SizeResource;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index(): SizeCollection
    {
        return new SizeCollection(Size::all());
    }

    public function store(StoreSizeRequest $request): SizeResource
    {
        $size = Size::create($request->all());
        return new SizeResource($size);
    }

    public function show(Size $size): SizeResource
    {
        return new SizeResource($size);
    }

    public function update(UpdateSizeRequest $request, Size $size): SizeResource
    {
        $size->update($request->validated());

        return new SizeResource($size);
    }

    public function destroy(Size $size)
    {
        $size->delete();

        return response()->json(['message' => 'Size deleted successfully']);
    }
}
