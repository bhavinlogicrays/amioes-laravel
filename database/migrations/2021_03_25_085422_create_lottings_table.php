<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLottingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lottings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stock_id')->unsigned()->index();
            $table->integer('auction_id')->unsigned()->index();
            $table->integer('vendor_id')->unsigned()->index();
            $table->integer('lot_no')->unsigned();
            $table->string('form_no');
            $table->string('item_no');
            $table->string('description');
            $table->integer('quantity');
            $table->integer('reserve');
            $table->integer('sold')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lottings');
    }
}
