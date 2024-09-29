<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('category')->nullable();
            // $table->integer('cat_id')->unsigned();
            // $table->foreign('cat_id')->references('id')->on('blog_category')->onDelete('setNull');
            $table->longText('body');
            $table->integer('type');
            $table->text('meta_keyword')->nullable();
            $table->text('meta_desc')->nullable();
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
