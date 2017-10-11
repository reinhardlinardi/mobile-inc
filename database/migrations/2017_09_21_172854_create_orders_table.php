<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->string('player')->nullable(); // NULL at first
            $table->integer('phone_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->integer('subtotal')->unsigned();
            $table->boolean('sent'); // Order sent to Unity
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
        Schema::dropIfExists('orders');
        Schema::enableForeignKeyConstraints();
    }
}
