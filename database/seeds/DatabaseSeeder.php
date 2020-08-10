<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(CategoryTableSeeder::class);
//        $this->call(AdminsTableSeeder::class);
//        $this->call(SectionsTableSeeder::class);
//        $this->call(ProductTableSeeder::class);
//        $this->call(ProductsAttributesTableSeeder::class);
//        $this->call(ProductsImagesTableSeeder::class);
            $this->call(BrandTableSeeder::class);
//         $this->call(UserSeeder::class);
    }
}
