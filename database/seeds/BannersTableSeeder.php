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
                'image'=>'',
                'link'=>'',
                'title'=>'',
                'description'=>'',
                'alt'=>'',
                'status'=>1
            ],
            [
                'id'=>2,
                'image'=>'',
                'link'=>'',
                'title'=>'',
                'description'=>'',
                'alt'=>'',
                'status'=>1
            ],
            [
                'id'=>3,
                'image'=>'',
                'link'=>'',
                'title'=>'',
                'description'=>'',
                'alt'=>'',
                'status'=>1
            ],
        ];

        foreach ($Banners as $key => $record) {
            # code...
            \App\Banner::create( $record);
        }
    }
}
