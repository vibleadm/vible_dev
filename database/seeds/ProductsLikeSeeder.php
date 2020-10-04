<?php

use Illuminate\Database\Seeder;

class ProductsLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('like_products')->insert([
            [
            'product_id' =>'1',
            'user_id' =>'1',
            ],[
            'product_id' =>'2',
            'user_id' =>'2',
            ], [
            'product_id' =>'2',
            'user_id' =>'1',
            ],[
            'product_id' =>'6',
            'user_id' =>'1',
            ],[
            'product_id' =>'7',
            'user_id' =>'1',
            ],[
            'product_id' =>'4',
            'user_id' =>'1',
            ],[
            'product_id' =>'8',
            'user_id' =>'1',
            ],[
            'product_id' =>'9',
            'user_id' =>'1',
            ],[
            'product_id' =>'4',
            'user_id' =>'1',
            ],
            ]);
    }
}
