<?php

namespace App\Services;

use Exception;
use Google\Cloud\Firestore\FirestoreClient;
use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Core\Exception\GoogleException;
use Illuminate\Support\Facades\DB;
use Google\Cloud\Core\ExponentialBackoff;
use App\Models\Image;
use App\Models\SubImage;

class FirestoreService
{
    protected $firestore;
    protected $storage;
    protected $bucketName;

    public function __construct()
    {
        $this->firestore = new FirestoreClient();
        $this->bucketName = "styleach.appspot.com";
        try {
            $this->storage = new StorageClient(['projectId' => 'styleach']);
        } catch (GoogleException $e) {
            throw new GoogleException('error:' . $e->getMessage());
        }
    }

    public function getImageUrlsFromStorage()
    {
        $bucket = $this->storage->bucket($this->bucketName);


        $objects = $bucket->objects(['prefix' => 'images/']);

        $imageUrls = [];

        foreach ($objects as $object) {
            $imageUrls[] = $object->signedUrl(strtotime('+100 years'));
        }

        return $imageUrls;


    }

    public function getVideoUrlsFromStorge()
    {
        $bucket = $this->storage->bucket($this->bucketName);

        $objects = $bucket->objects(['prefix' => 'videos/']);

        $videoUrls = [];

        foreach ($objects as $object) {
            // Assuming all objects in the bucket are videos
            $videoUrls[] = $object->signedUrl(strtotime('+100 years'));
        }

        return $videoUrls;
    }

    public function getImageUrlsWithStructure()
    {
        $bucket = $this->storage->bucket($this->bucketName);

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

    public function getImageAndSubImagesFromFirestore()
    {
        $path = [];
        $bucket = $this->storage->bucket($this->bucketName);

        $objects = $bucket->objects(['prefix' => 'images/']);

        $arrObjects = iterator_to_array($objects);
        $result = [];

        foreach ($arrObjects as $object) {
            $path = explode('/', $object->name());

            if (count($path) === 3 && substr($object->name(), -4) === '.png') {
                $imageNumber = $path[1];

                if (!isset($result[$imageNumber])) {
                    $result[$imageNumber] = [
                        "url" => $object->signedUrl(strtotime('+100 years')),
                        "subImages" => [],
                    ];
                }
            } elseif (count($path) === 4 && substr($object->name(), -4) === '.png') {
                $imageNumber = $path[1];
                $result[$imageNumber]["subImages"][] = $object->signedUrl(strtotime('+100 years'));
            }
        }

        return $result;
    }

    public function migrateImageAndSubImagesToDatabase()
    {
        $images = $this->getImageAndSubImagesFromFirestore();

        foreach ($images as $image) {
            $img = new Image();
            $img->url = $image["url"];
            $img->alt = "";
            $img->save();

            foreach ($image["subImages"] as $subImage) {
                $subImg = new SubImage();
                $subImg->url = $subImage;
                $subImg->image_id = $img->id;
                $subImg->save();
            }
        }
    }
}


