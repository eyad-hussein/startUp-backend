<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Size;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $sizes = ["S", "M", "L", "XL", "2XL"];

        // for ($i = 0; $i < count($sizes); $i++) {
        //     Size::create(
        //         ["size" => $sizes[$i]]
        //     );
        // }

        $productsIds = [1, 2, 3, 4, 5];
        $sizesIds = [1, 2, 3, 4, 5];

        foreach ($productsIds as $productsId) {
            $product = Product::find($productsId);

            $product->sizes()->attach($sizesIds);
        }
    }
}
