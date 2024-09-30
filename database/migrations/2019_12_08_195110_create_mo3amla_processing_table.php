<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMo3amlaProcessingTable extends Migration {

	public function up()
	{
		Schema::create('mo3amla_processing', function(Blueprint $table) {
            $table->increments('id');
            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('mo3amla_id')->unsigned();
            $table->foreign('mo3amla_id')->references('id')->on('order_mo3amlas');

            $table->string('status')->default('-1');
            $table->integer('price')->nullable();
            $table->text('requirement')->nullable();
            $table->string('days')->nullable();
            $table->integer('choosen')->nullable();

            $table->timestamps();
            
		});
	}

	public function down()
	{
		Schema::drop('mo3amla_processing');
	}
}
