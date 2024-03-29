<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lotting_id')->unsigned()->index();
            $table->integer('auction_id')->unsigned()->index();
            $table->integer('vendor_id')->unsigned()->index();
            $table->integer('buyer_id')->unsigned()->index();
            $table->integer('invoice_id')->unsigned()->index();
            $table->string('form_no');
            $table->string('item_no');
            $table->integer('lot_no')->unsigned();
            $table->integer('rate')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->integer('discount')->unsigned();
            $table->decimal('buyers_premium_amount',50,25)->unsigned();
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
        Schema::dropIfExists('sales');
    }
}
