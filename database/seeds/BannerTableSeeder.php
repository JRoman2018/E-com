<?php

use Illuminate\Database\Seeder;
use \App\Banner;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannerRecord = [
          ['id'=>1, 'image'=>'banner1.png', 'link'=>'','title'=>'Black Jacket', 'alt'=>'Black Jacket','status'=>1],
          ['id'=>2, 'image'=>'banner2.png', 'link'=>'','title'=>'Half Sleeve T-shirt', 'alt'=>'Half Sleeve T-shirt','status'=>1],
          ['id'=>3, 'image'=>'banner3.png', 'link'=>'','title'=>'Full Sleeve T-shirt', 'alt'=>'Full Sleeve T-shirt','status'=>1],
        ];

        Banner::insert($bannerRecord);
    }
}
