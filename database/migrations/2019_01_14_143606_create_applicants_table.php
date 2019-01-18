<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_pelamar');
            $table->string('posisi_yang_dilamar');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('kewarganegaraan');
            $table->string('no_ktp');
            $table->string('alamat_ktp');
            $table->string('rt');
            $table->string('rw');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kota');
            $table->string('kode_pos');
            $table->string('telephone_rumah')->nullable();
            $table->string('handphone');
            $table->string('email');
            $table->string('skype_id')->nullable();
            $table->string('agama');
            $table->string('golongan_darah');
            $table->string('pendidikan_terakhir');
            $table->string('institusi_pendidikan');
            $table->string('jurusan');
            $table->string('tahun_masuk');
            $table->string('tahun_keluar');
            $table->string('informasi_lowongan');
            $table->string('upload_by');
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
        Schema::dropIfExists('applicants');
    }
}
