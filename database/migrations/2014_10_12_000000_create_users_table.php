<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_no')->unique()->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->enum('type', ['individual', 'vendor', 'vendorC']);	
            $table->string('phone_status')->default(0);
            $table->string('verification_code')->nullable();
            $table->string('identity_no')->unique();
            $table->string('status')->default(0);
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('vendor_image')->nullable();
            $table->string('gender')->nullable();
            $table->string('identity_file')->nullable();
            $table->string('identity_file_reject_reason')->nullable();
            $table->string('identity_status')->nullable()->default(0);
            $table->string('blacklist_reson')->nullable()->default(0);
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
