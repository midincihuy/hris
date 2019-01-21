<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('applicant_id');
            $table->string('no_ptk');
            $table->string('tanggal_ptk');
            $table->string('jenis_ptk');
            $table->string('tanggal_interview_hr')->nullable();
            $table->string('status_interview_hr')->nullable();
            $table->string('tanggal_test_bidang')->nullable();
            $table->string('status_test_bidang')->nullable();
            $table->string('tanggal_psikotest')->nullable();
            $table->string('ist')->nullable();
            $table->string('pauli')->nullable();
            $table->string('hasil_psikotest')->nullable();
            $table->string('tanggal_interview_user')->nullable();
            $table->string('status_interview_user')->nullable();
            $table->string('tanggal_offering')->nullable();
            $table->string('status_offering')->nullable();
            $table->string('jabatan_final')->nullable();
            $table->string('created_by');
            $table->string('updated_by');
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
        Schema::dropIfExists('recruitments');
    }
}
