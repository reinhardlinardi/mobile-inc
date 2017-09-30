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
        $type = ["Mi_5","Mi_Max","Redmi_3s","Galaxy_Note_8","Galaxy_Note_5","Galaxy_S8+"];
        $price = [460, 400, 140, 950, 840, 820];

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
