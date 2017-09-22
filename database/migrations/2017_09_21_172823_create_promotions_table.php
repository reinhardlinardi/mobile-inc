<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('promotions', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->integer('game_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('player');
            $table->string('promo_code');
            $table->boolean('used');

            $table->primary('id');
            $table->unique(['game_id','promo_code']);
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
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
        Schema::dropIfExists('promotions');
        Schema::enableForeignKeyConstraints();
    }
}
