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
        DB::table('products_images')->delete();
        $productsImages =[
            [
            'id'=>1,
            'product_id'=>1,
            'image'=>'defalt.jpg',
            'status'=>1
            ]
        ];

        foreach ($productsImages as $key => $record) {
            # code...
            \App\ProductsImage::create( $record);
        }
    }
}
