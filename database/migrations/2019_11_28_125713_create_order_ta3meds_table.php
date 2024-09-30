<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTa3medsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_ta3meds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no')->unique()->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('phone_client');
            $table->string('phone_mo3akeb');
            $table->string('days');
            $table->string('ta3med_value');
            $table->string('ta3med_price');
            $table->string('total_price');
            $table->string('ta3med_details');
            $table->integer('reviewed')->default('0');
            $table->string('payment_method');
            $table->string('transfer_prove')->default('0');
            $table->string('prove_status')->default('0');
            $table->string('status')->default('-1');
            $table->string('statusReason')->nullable();
            $table->integer('processing_id')->nullable()->unsigned();
            $table->foreign('processing_id')->references('id')->on('statuses')->onDelete('set null');

            $table->integer('bank_id')->unsigned()->nullable();
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->string('attachment')->nullable();
            $table->string('closed')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_ta3meds');
    }
}
