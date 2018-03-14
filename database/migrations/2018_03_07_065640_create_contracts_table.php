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
            $table->string('nik');
            $table->string('name');
            $table->string('gender');
            $table->date('contract_date');
            $table->string('employee_status');
            $table->string('status_active');
            $table->string('contract_duration')->default(12);
            $table->string('status_contract')->default('New');
            $table->string('head_1')->nullable();
            $table->string('email_head_1')->nullable();
            $table->string('head_2')->nullable();
            $table->string('email_head_2')->nullable();
            $table->string('division')->nullable();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->string('reminder')->nullable();
            $table->string('upload_by')->nullable();
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
