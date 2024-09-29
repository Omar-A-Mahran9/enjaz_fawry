<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactTable extends Migration {

	public function up()
	{
		Schema::create('contact', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email')->nullable();
			$table->string('phone')->nullable();
			$table->string('message');
			$table->integer('user_id')->nullable();
			$table->integer('status')->default('-1');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('contact');
	}
}