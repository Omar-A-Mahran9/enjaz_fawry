<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingTable extends Migration {

	public function up()
	{
		Schema::create('setting', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->text('description');
			$table->string('facebook')->nullable();
			$table->string('twitter')->nullable();
			$table->string('instagram')->nullable();
			$table->string('youtube')->nullable();
			$table->string('linkedin')->nullable();
			$table->string('snapchat')->nullable();
			$table->string('email');
			$table->string('phone');
			$table->string('slogan');
			$table->string('general_whats');
			$table->string('tameed_percentage')->default(10);
			$table->text('keywords');
			$table->integer('estfsar_price')->default(100);
			$table->integer('ta3med_price')->default(10);
			$table->integer('paginate')->default(10);
			$table->integer('bankPayment')->default(1);
			$table->integer('onlinePayment')->default(1);
			$table->string('logo');
			$table->string('address');
			$table->string('small_logo');
		});
	}

	public function down()
	{
		Schema::drop('setting');
	}
}
