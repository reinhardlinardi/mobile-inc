<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('trends', function (Blueprint $table) {
            $table->integer('phone_id')->unsigned();
            $table->integer('orders')->unsigned();
            $table->timestamps();

            $table->primary('phone_id');
            $table->foreign('phone_id')->references('id')->on('handphones')->onDelete('cascade');
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
        Schema::dropIfExists('trends');
        Schema::enableForeignKeyConstraints();
    }
}
