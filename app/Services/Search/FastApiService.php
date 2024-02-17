<?php

namespace App\Services\Search;

class FastApiService
{
    // what is the type of $image?
    public function retrieveSimilarImagesWithAccuracties(object $image)
    {

        // logic for retrieving similar images with accuracies from fastapi
        $result = [
            "image1" => [
                "url" => "https://storage.googleapis.com/styleach.appspot.com/images/image2/image2.png?GoogleAccessId=firebase-adminsdk-9hieq%40styleach.iam.gserviceaccount.com&Expires=4863009514&Signature=lGFZnpkUEYijAY7XSSuUUdtlEjkC5Akzj53DqpR4z3eHzLyHno1ZgE88u96gbJDzL9q1Sqwbv2vcVs5K3l3m7i4EWCzQziQHUSTSajuDHyr5tIkYOL5gix%2F4jqbxsnBHwAuAVZ6Ggu%2FKtlfGY%2FizpkRtQE26MW083apVLNhMc55%2BOBcmxBY1wh7vZA5b8YAiOtGxNUDll4ArLJW%2FFROv8bLDzf98z3T%2BqgBRSbIAE4y%2F%2BBbIDovjxQZ1BRg8MZofgEClePrqQAKj4FW%2Ff5h%2F6C17l5qkVOIfjNEzahr9emqvrjjxGT8vc8yLOjFbf4icBHd2KkRYYOTB%2Fk13zQZu5g%3D%3D&generation=1706700536311192 ",
                "accuracy" => 0.9,
            ],
            "image2" => [
                "url" => "https://storage.googleapis.com/styleach.appspot.com/images/image1/image1.png?GoogleAccessId=firebase-adminsdk-9hieq%40styleach.iam.gserviceaccount.com&Expires=4863009472&Signature=Jwm8s%2FUMyexL1F8XODP4pLbu2l4vgVOSWDDkaTIwjz03rMTFLgEtaU%2Bad2N045eXpMys15yGhVvfLUGF%2FBzu%2FvlnA7cJpgIpwj98yO0DnIcYRcvtHi6nPX%2FlAXtc8dAorcbe8dv8PKrxWSg%2BysAF39s9nz45GV5gugmQpKoyACqi%2FhdugbaDOJ%2BKOPpXzNp4RzXofjwJUffiq1UQAV0uChOLaJ7aq6jjShtRkUBUfNsSXtaK4FOhyPGPoRfpS%2FpTxdqLK2v7KWEC%2BsANeI1%2Ba640dM95Lg6r%2B0ZN1t%2BxWrId7d2a3%2FH8HQsAZtsNBmBZmIPo78yjgbbAN7x5xAHYrA%3D%3D&generation=1706700502245476",
                "accuracy" => 0.9,
            ],
        ];
        return $result;
    }

}
