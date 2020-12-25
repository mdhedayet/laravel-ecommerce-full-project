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
        //
        DB::table('admins')->delete();
        //used password here is 123456
        $adminRecords = [
            [
                'id'=>1,
                'name'=>'admin',
                'type'=>'admin',
                'mobile'=>'01700000000',
                'email'=>'admin@admin.com',
                'password'=>'$2y$10$d24sqV3zpH.rld1BLACrUeyf9OZrvJZmy2ZmCM8c207xLfIeeGceC',
                'image'=>'',
                'status'=>1,
            ],
        ];

        foreach ($adminRecords as $key => $record) {
            # code...
            \App\Admin::create($record);
        }
    }
}
