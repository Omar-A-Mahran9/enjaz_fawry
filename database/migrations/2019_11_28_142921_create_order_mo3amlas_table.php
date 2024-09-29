<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderMo3amlasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_mo3amlas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no')->unique()->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services');
            $table->string('mo3amla_subject');
            $table->string('mo3amla_details');
            $table->text('attachments')->nullable();
            $table->string('status')->default('-1');
            $table->integer('processing_id')->nullable()->unsigned();
            $table->foreign('processing_id')->references('id')->on('statuses')->onDelete('set null');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('m_processType')->nullable();
            $table->integer('m_processVendorSelected')->nullable()->unsigned();
            $table->foreign('m_processVendorSelected')->references('id')->on('users');
            $table->string('m_processRequirment')->nullable();
            $table->string('m_processNeedUploadNewFiles')->nullable();
            $table->string('m_processNeedTextNotes')->nullable();
            $table->string('m_processNewFilesStatus')->default('-2');
            $table->string('m_processDays')->nullable();
            $table->string('m_enjazPrice')->nullable();
            $table->string('m_processThirdPartyPrice')->nullable();
            $table->string('m_processGovPrice')->nullable();
            $table->integer('m_have_notes')->nullable();
            $table->string('price')->nullable();
            $table->integer('reviewed')->default('0');
            $table->string('statusReason')->nullable();
            $table->string('payment_method')->default('0');
            $table->integer('bank_id')->unsigned()->nullable();
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->string('transfer_prove')->default('0');
            $table->string('prove_status')->default('0');
            $table->string('closed')->nullable();
            $table->string('enjaz_prove')->nullable();
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
        Schema::dropIfExists('order_mo3amlas');
    }
}
