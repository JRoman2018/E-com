<?php

use Illuminate\Database\Seeder;
use App\ProductsImage;
class ProductsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productImageRecords = [
            ['id'=>1,'product_id'=>2, 'image'=>'ash.jpg-578115.jpg','status'=>1]
        ];
        \App\ProductsImage::insert($productImageRecords);
    }
}
