<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderEstfsarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_estfsars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no')->unique()->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->string('phone');
            $table->string('type');            
            $table->string('service');
            $table->integer('price');
            $table->string('payment_method');
            $table->integer('processing_id')->nullable()->unsigned();
            $table->foreign('processing_id')->references('id')->on('statuses')->onDelete('set null');
            $table->string('transfer_prove')->default('0');
            $table->integer('reviewed')->default('0');
            $table->string('prove_status')->default('0');
            $table->string('status')->default('-1');
            $table->string('statusReason')->nullable();
            $table->integer('bank_id')->unsigned()->nullable();
            $table->foreign('bank_id')->references('id')->on('banks');
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
        Schema::dropIfExists('order_estfsars');
    }
}
