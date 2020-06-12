<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecord = [
            ['id'=>1, 'parent_id'=>0, 'section_id'=>1, 'category_name'=>'T-Shirt', 'category_image'=>'',
                'category_discount'=>0, 'description' =>'', 'url' =>'t-shirt', 'meta_title' =>'',
                'meta_description' =>'', 'meta_keywords' =>'', 'status' =>1],

            ['id'=>2, 'parent_id'=>1, 'section_id'=>1, 'category_name'=>'Casual T-Shirt', 'category_image'=>'',
                'category_discount'=>0, 'description' =>'', 'url' =>'casual-t-shirt', 'meta_title' =>'',
                'meta_description' =>'', 'meta_keywords' =>'', 'status' =>1]
        ];

        Category::insert($categoryRecord);
    }
}
