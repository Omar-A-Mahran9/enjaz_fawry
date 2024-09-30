<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title_en');
			$table->string('title_ar');
			$table->string('content_en');
			$table->string('content_ar');
			$table->timestamps();
			$table->enum('type', array('general', 'car', 'inner_car'));
			$table->integer('notifiable_id');
			$table->string('notifiable_type');
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}