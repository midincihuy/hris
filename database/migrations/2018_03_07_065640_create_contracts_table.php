<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recruitment_id');
            $table->string('nik');
            $table->string('name');
            $table->string('gender');
            $table->string('contract_number')->comment('Nomor Kontrak');
            $table->date('contract_date')->comment('Tanggal Mulai Kontrak');
            $table->string('employee_status');
            $table->string('status_active');
            $table->string('contract_duration')->default(12)->comment('Jangka Waktu Kontrak')->nullable();
            $table->string('status_contract')->default('New');
            $table->string('head_1')->nullable();
            $table->string('email_head_1')->nullable();
            $table->string('head_2')->nullable();
            $table->string('email_head_2')->nullable();
            $table->string('division')->nullable();
            $table->string('department')->nullable();
            $table->string('section')->nullable();
            $table->string('position')->nullable();
            $table->string('reminder')->nullable();
            $table->string('reminder_hr')->default('0');
            $table->string('reminder_user')->default('0');
            $table->string('upload_by')->nullable();
            $table->string('reason_not_active')->nullable();
            $table->string('contract_type')->nullable();
            $table->string('contract_expire_date')->nullable();
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
        Schema::dropIfExists('contracts');
    }
}
