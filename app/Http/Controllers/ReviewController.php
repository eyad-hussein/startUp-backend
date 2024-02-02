<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\StoreReviewRequest;
use App\Http\Requests\Review\UpdateReviewRequest;
use App\Http\Resources\Review\ReviewCollection;
use App\Http\Resources\Review\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(): ReviewCollection
    {
        return new ReviewCollection(Review::all());
    }

    public function store(StoreReviewRequest $request): ReviewResource
    {
        $review = Review::create($request->validated());
        return new ReviewResource($review);
    }

    public function show(Review $review): ReviewResource
    {
        return new ReviewResource($review);
    }
    public function update(UpdateReviewRequest $request, Review $review): ReviewResource
    {
        $review->update($request->validated());
        return new ReviewResource($review);
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return response()->json(['message' => 'Review deleted successfully']);
    }
}
