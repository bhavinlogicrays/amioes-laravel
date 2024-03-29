<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id')->unsigned()->index();
            $table->integer('commission');
            $table->string('form_no');
            $table->string('item_no');
            $table->string('lot_no')->nullable(); // Confusion
            $table->integer('quantity');
            $table->string('description');
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
        Schema::dropIfExists('stocks');
    }
}
