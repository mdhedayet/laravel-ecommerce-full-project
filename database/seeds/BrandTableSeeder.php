<?php

use Illuminate\Database\Seeder;
use App\Brand;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('brands')->delete();
        $Brands= [
            [
                'id'=>1,
                'name'=>'Apple',
                'status'=>1
            ],
            [
                'id'=>2,
                'name'=>'Hp',
                'status'=>1
            ],
            [
                'id'=>3,
                'name'=>'Dell',
                'status'=>1
            ],
        ];

        foreach ($Brands as $key => $record) {
            # code...
            \App\Brand::create( $record);
        }
    }
}
