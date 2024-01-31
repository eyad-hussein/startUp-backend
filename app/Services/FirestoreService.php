<?php

namespace App\Services;

use Google\Cloud\Firestore\FirestoreClient;
use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Core\Exception\GoogleException;
use Google\Cloud\Core\ExponentialBackoff;

class FirestoreService
{
    protected $firestore;
    protected $storage;

    public function __construct()
    {
        $this->firestore = new FirestoreClient();

        try {
            $this->storage = new StorageClient(['projectId' => 'styleach']);
        } catch (GoogleException $e) {
            throw new GoogleException('error:' . $e->getMessage());
        }
    }

    public function getImageUrlsFromStorage($bucketName)
    {
        $bucket = $this->storage->bucket($bucketName);

        $objects = $bucket->objects(['prefix' => 'images/']);

        $imageUrls = [];

        foreach ($objects as $object) {
            $imageUrls[] = $object->signedUrl(strtotime('+100 years'));
        }

        return $imageUrls;
    }

    public function getVideoUrlsFromStorge($bucketName)
    {
        $bucket = $this->storage->bucket($bucketName);

        $objects = $bucket->objects(['prefix' => 'videos/']);

        $videoUrls = [];

        foreach ($objects as $object) {
            // Assuming all objects in the bucket are videos
            $videoUrls[] = $object->signedUrl(strtotime('+100 years'));
        }

        return $videoUrls;
    }

    public function getImageUrlsWithStructure($bucketName)
    {
        $bucket = $this->storage->bucket($bucketName);

        $objects = $bucket->objects(['prefix' => 'images/']);

        $imageUrls = [];

        foreach ($objects as $object) {
            $path = explode('/', $object->name());
            $imageName = array_pop($path);

            $currentArray = &$imageUrls;
            foreach ($path as $folder) {
                if (!isset($currentArray[$folder])) {
                    $currentArray[$folder] = [];
                }
                $currentArray = &$currentArray[$folder];
            }

            if (substr($imageName, -4) === '.png') {
                $currentArray[$imageName] = $object->signedUrl(strtotime('+100 years'));
            }
        }

        return $imageUrls;
    }

}
