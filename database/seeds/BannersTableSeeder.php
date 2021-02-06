<?php

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('banners')->delete();
        $Banners= [
            [
                'id'=>1,
                'image'=>'girl1.jpg',
                'link'=>'',
                'title'=>'100% Unick Design',
                'description'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'alt'=>'100% Unick Design',
                'status'=>1
            ],
            [
                'id'=>2,
                'image'=>'girl2.jpg',
                'link'=>'',
                'title'=>'100% Unick Design',
                'description'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'alt'=>'100% Unick Design',
                'status'=>1
            ],
            [
                'id'=>3,
                'image'=>'girl3.jpg',
                'link'=>'',
                'title'=>'100% Unick Design',
                'description'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'alt'=>'100% Unick Design',
                'status'=>1
            ],
        ];

        foreach ($Banners as $key => $record) {
            # code...
            \App\Banner::create( $record);
        }
    }
}
