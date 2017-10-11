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
            $table->integer('account_id')->unsigned();
            $table->string('player');
            $table->string('promo_code');
            $table->boolean('received'); // Android has received promotion code
            $table->boolean('used');
            $table->timestamps();

            $table->primary('id');
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
