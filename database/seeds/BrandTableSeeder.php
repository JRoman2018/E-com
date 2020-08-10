<?php

use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $brandrecords = [
        ['id'=>1, 'name'=>'Arrow', 'status'=>1],
        ['id'=>2, 'name'=>'Gap', 'status'=>1],
        ['id'=>3, 'name'=>'Lee', 'status'=>1],
        ['id'=>4, 'name'=>'Monte Carlo', 'status'=>1],
        ['id'=>5, 'name'=>'Peter England', 'status'=>1]
            ];

        \App\Brand::insert($brandrecords);
    }
}
