<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubServiceTable extends Migration {

	public function up()
	{
		Schema::create('sub_service', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
			$table->integer('status');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('sub_service');
	}
}