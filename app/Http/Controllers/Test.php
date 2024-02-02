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
        $res = $this->firestoreService->migrateImageAndSubImagesToDatabase();

        return response(["res" => $res]);

    }
}

