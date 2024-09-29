<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTermsTable extends Migration {

	public function up()
	{
		Schema::create('terms', function(Blueprint $table) {
			$table->increments('id');
			$table->longText('terms_ta3med');
			$table->longText('terms_mo3amla');
			$table->longText('terms_estfsar');
			$table->longText('terms_shrkat');
			$table->longText('terms_vendor');
			$table->longText('terms_client');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('terms');
	}
}
