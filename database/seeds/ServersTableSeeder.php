<?php

use Illuminate\Database\Seeder;

class ServersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('servers')->insert([
            'server_key' => env('SERVER_KEY'),
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now()
        ]);
    }
}
