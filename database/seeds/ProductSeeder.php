<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Fake;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = Fake::create('ja_JP');
        for ($i = 0; $i < 30; $i++) {
            DB::table('products')->insert([
                'name' => $fake->title,
                'price' => $fake->randomNumber(4),
                'description' => $fake->sentences(3, true),
                'icon'=> $fake->image('public/storage/icon', 1920, 1060, null, false),
                'created_at' => new Datetime(),
            ]);
        }
    }
}
