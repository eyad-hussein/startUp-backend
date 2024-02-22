<?php

namespace App\Http\Controllers;

use App\Services\FirestoreService;
use App\Services\S3StorageService;
use App\Models\Image;
use Illuminate\Http\Request;

class Test extends Controller
{
    protected $firestoreService;
    protected $s3StorageService;

    public function __construct(FirestoreService $firestoreService, S3StorageService $s3StorageService)
    {
        $this->firestoreService = $firestoreService;
        $this->s3StorageService = $s3StorageService;
    }

    // public function index()
    // {
    //     $res = $this->firestoreService->migrateImageAndSubImagesToDatabase();

    //     return response(["res" => $res]);

    // }

    public function testStorage()
    {
        return $this->s3StorageService->test();
    }
}

