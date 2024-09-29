<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMo3amlaNotesTable extends Migration {

	public function up()
	{
		Schema::create('mo3amla_notes', function(Blueprint $table) {
            $table->increments('id');
            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('vendor_id')->unsigned()->nullable();
            $table->foreign('vendor_id')->references('id')->on('users');

            $table->integer('mo3amla_id')->unsigned();
            $table->foreign('mo3amla_id')->references('id')->on('order_mo3amlas');

            $table->integer('need_files')->nullable();
            $table->integer('need_text')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->text('content')->nullable();
            $table->string('answer')->nullable();

            $table->string('status')->default('0');
            $table->timestamps();

	      });
	}

	public function down()
	{
		Schema::drop('mo3amla_notes');
	}
}
