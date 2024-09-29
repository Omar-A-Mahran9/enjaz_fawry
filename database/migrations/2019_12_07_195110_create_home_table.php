<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHomeTable extends Migration {

	public function up()
	{
		Schema::create('home', function(Blueprint $table) {
			$table->increments('id');
            $table->string('sitWork_icon1');
            $table->text('sitWork_text1');
            $table->string('sitWork_icon2');
            $table->text('sitWork_text2');
            $table->string('sitWork_icon3');
            $table->text('sitWork_text3');
            $table->string('counter1_icon');
            $table->string('counter1_no');
            $table->string('counter1_title');
            $table->string('counter2_icon');
            $table->string('counter2_no');
            $table->string('counter2_title');
            $table->string('counter3_icon');
            $table->string('counter3_no');
            $table->string('counter3_title');
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('home');
	}
}
