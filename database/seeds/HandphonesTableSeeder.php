<?php

use Illuminate\Database\Seeder;

class HandphonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand = ["Xiaomi","Samsung"];
        $type = ["Mi 5","Mi Max","Redmi 3s","Galaxy Note 8","Galaxy Note 5","Galaxy S8+"];
        $price = [456, 402, 134, 950, 840, 825];

        for($count = 0; $count < 6; $count++) {
            DB::table('handphones')->insert([
                'id' => rand(1,1000),
                'brand' => $brand[intdiv($count,3)],
                'type' => $type[$count],
                'price' => $price[$count]
            ]);
        }
    }
}
