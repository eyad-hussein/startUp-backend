<?php
use App\Services\FirestoreService;


class Test
{

    public function hi()
    {
        // $this->firestoreService->testtFirestore("styleach.appspot.com");
        echo "HII";
    }

}

// Assuming you have autoloaded your classes using Composer
require_once 'vendor/autoload.php';

// Create an instance of FirestoreService (you may need to adjust the namespace)
// $firestoreService = new FirestoreService();

// Create an instance of the Test class and pass the FirestoreService instance to its constructor
$testInstance = new Test();

// Call the index method
$testInstance->hi();

