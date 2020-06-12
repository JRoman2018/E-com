<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
            [
                'id' => 1,
                'name' => 'admin',
                'type' => 'admin',
                'phone' => '8299210205',
                'email' => 'admin@admin.com',
                'password' => \Illuminate\Support\Facades\Hash::make('8299210205'),
                'image' => '',
                'status' => 1
            ],
            [
                'id' => 2,
                'name' => 'Jhon',
                'type' => 'admin',
                'phone' => '8299210205',
                'email' => 'jhon@admin.com',
                'password' => \Illuminate\Support\Facades\Hash::make('123456789'),
                'image' => '',
                'status' => 1
            ],
            [
                'id' => 3,
                'name' => 'Juan',
                'type' => 'subadmin',
                'phone' => '8299210205',
                'email' => 'juan@admin.com',
                'password' => \Illuminate\Support\Facades\Hash::make('123456789'),
                'image' => '',
                'status' => 1
            ],
        ];

        DB::table('admins')->insert($adminRecords);
//        foreach ($adminRecords as $key => $record){
//            \App\Admin::create($record);
//        }
    }
}
