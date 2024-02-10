<?php

namespace App\Services\Search;

use Illuminate\Support\Facades\Storage;

class ImageSearchService
{
    protected $image;
    public function setImage(object $image)
    {
        $this->image = $image;
    }

    public function requestUrlSimilarImages(){
        // Should Have Function that returns the urls from API
        return ['https://storage.googleapis.com/styleach.appspot.com/images/image1/image1.png?GoogleAccessId=firebase-adminsdk-9hieq%40styleach.iam.gserviceaccount.com&Expires=4863095452&Signature=I3Vx7Heh66XoTbMX2JTQUFJpffKSRycveJW6RaC5iLoaipFLSLpgQ%2FpuBjOFLVOl0Qo2hwVICd4wwkDt5tFZCdo5a81DsqhwFKyUH%2BPeT%2FNqrTLXpiYaIr5gvIBhm2ziyH3soJ1Gm8IGm2HzuTnO2nj%2BWzJpnvor9P2heOZjlLxbEoOv5oNSOd4dSJiQipKGXl4nwQ8Pb8W3SLub8TNABvrqlBEb%2BabBo2SeR9HT1zxHHH%2Fr%2FfyYUVgiTZ7e%2Bn0GBuPQHz7K17LxKFu3nL49SOtIdbmC0X4kfurm4omKDnjyf4q9M7nyEnw90ngTOIMg2w5YA5ZZ%2FO97yJDOozfHDw%3D%3D&generation=1706700502245476','https://storage.googleapis.com/styleach.appspot.com/images/image2/image2.png?GoogleAccessId=firebase-adminsdk-9hieq%40styleach.iam.gserviceaccount.com&Expires=4863095452&Signature=MzsSsE4GSyZd1Qq2m1%2BZmga41wpEniW0KKFe5gn%2BVtBd2v%2BzfGlmgwLZKWIY2F3515efiRO9v2fOqrt%2BLQF%2FHX8l%2BDxxO9tmDujgRb1dTcb%2FfKCPIjOP10nzxs92S2zb%2FFqKcAY11Qp7zQdUuhJCyoSgrSVlO4ZEfkOgvgtO1cWhjvVcHJ%2FIa4SUuvMnLw6%2FSAvY8nY21YZ0YQ5k2BVqQUDt1x9XIw68shUqEB%2BPvkt9MTF6inIjhtwagkHQFMs%2BpyWCvPH9Fo9byqiDAl1T0WZcP9jiHN8ECdFVZ8CRW6sDBV2P70SHeGEGu8AQTAwAgrr3do%2BLpsMe7S%2FBplwCYw%3D%3D&generation=1706700536311192'];
    }
}
