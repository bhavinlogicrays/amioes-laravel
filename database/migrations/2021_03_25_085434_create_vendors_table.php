<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vendor_code')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company')->nullable();
            $table->date('joined_date')->useCurrent();
            $table->string('abn')->nullable();
            $table->string('gst_status');
            $table->string('payment_method');
            $table->integer('commission');
            $table->string('address');
            $table->string('suburb');
            $table->string('state');
            $table->integer('postcode')->unsigned();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->text('comments')->nullable();
            $table->string('a/c_no')->nullable();
            $table->string('bsb_no')->nullable();
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
        Schema::dropIfExists('vendors');
    }
}
