<?php

use Illuminate\Database\Seeder;
use App\Handphone;

class TrendsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $handphone = Handphone::get();

        foreach($handphone as $phone) {
            DB::table('trends')->insert([
                'phone_id' => $phone['id'],
                'orders' => 0
            ]);
        }
    }
}
