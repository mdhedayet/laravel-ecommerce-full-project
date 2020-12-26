<?php

use Illuminate\Database\Seeder;
use App\ProductsAttribute;

class ProductsAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products_attributes')->delete();
        $ProductsAttributesRecorde= [
            [
                'id'=>1,
                'product_id'=>1,
                'size'=>'Small',
                'price'=>1200,
                'stock'=>12,
                'sku'=>'BT100-S',
                'status'=>1
            ],
            [
                'id'=>2,
                'product_id'=>1,
                'size'=>'Medium',
                'price'=>1300,
                'stock'=>20,
                'sku'=>'BT100-M',
                'status'=>1
            ],
            [
                'id'=>3,
                'product_id'=>1,
                'size'=>'Large',
                'price'=>1400,
                'stock'=>25,
                'sku'=>'BT100-L',
                'status'=>1
            ],
        ];

        foreach ($ProductsAttributesRecorde as $key => $record) {
            # code...
            \App\ProductsAttribute::create( $record);
        }
    }
}
