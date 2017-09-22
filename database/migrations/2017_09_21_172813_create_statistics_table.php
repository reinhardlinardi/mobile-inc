<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('statistics', function (Blueprint $table) {
            $table->string('city'); // City name from Google Location Services
            $table->integer('orders')->unsigned(); // How many orders come from each city
            $table->timestamps();

            $table->primary('city');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('statistics');
        Schema::enableForeignKeyConstraints();
    }
}
