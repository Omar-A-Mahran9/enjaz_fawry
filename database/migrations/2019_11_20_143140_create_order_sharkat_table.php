<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderSharkatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_sharkat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no')->unique()->nullable();
            $table->string('name');
            $table->string('type');
            $table->string('mobile');
            $table->string('status')->default('-1');
            $table->string('statusReason')->nullable();
            $table->integer('processing_id')->nullable()->unsigned();
            $table->foreign('processing_id')->references('id')->on('statuses')->onDelete('set null');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('service');
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
        Schema::dropIfExists('order_sharkat');
    }
}
