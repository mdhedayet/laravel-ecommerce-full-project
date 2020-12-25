<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [
            [
                'id'=>1,
                'category_id'=>1,
                'section_id'=>1,
                'product_name'=>'Blue T-shart',
                'product_color'=>'Blue',
                'product_code'=>'BT100',
                'product_price'=>'1500',
                'product_discount'=>'10',
                'product_weight'=>'200',
                'product_video'=>'',
                'main_image'=>'',
                'description'=>'This a Blue t-shart.',
                'wash_care'=>'',
                'fabric'=>'',
                'pattern'=>'',
                'sleeve'=>'',
                'fit'=>'',
                'occassion'=>'',
                'meta_title'=>'This a Blue t-shart.',
                'meta_description'=>'This a Blue t-shart.',
                'meta_keywords'=>'This a Blue t-shart.',
                'is_featured'=>'No',
                'status'=>1,
            ],

            [
                'id'=>2,
                'category_id'=>2,
                'section_id'=>1,
                'product_name'=>'Red Casual T-shart',
                'product_color'=>'Red Casual',
                'product_code'=>'RT100',
                'product_price'=>'500',
                'product_discount'=>'15',
                'product_weight'=>'205',
                'product_video'=>'',
                'main_image'=>'',
                'description'=>'This a Red Casual t-shart.',
                'wash_care'=>'',
                'fabric'=>'',
                'pattern'=>'',
                'sleeve'=>'',
                'fit'=>'',
                'occassion'=>'',
                'meta_title'=>'This a Red Casual t-shart.',
                'meta_description'=>'This a Red Casual t-shart.',
                'meta_keywords'=>'This a Red Casual t-shart.',
                'is_featured'=>'No',
                'status'=>1,
            ],
        ];

        foreach ($productRecords as $key => $record) {
            # code...
            \App\Product::create($record);
        }
    }
}
