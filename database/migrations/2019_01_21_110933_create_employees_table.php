<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contract_id');
            $table->string('no_kk')->default('-');
            $table->string('no_bpjs_ketenagakerjaan')->nullable();
            $table->string('no_bpjs_kesehatan')->nullable();
            $table->string('no_bpjs_pensiun')->nullable();
            $table->string('no_npwp')->default('-');
            $table->string('no_rek_bca')->default('-');
            $table->string('no_va_dana')->default('-');
            $table->string('alamat')->default('-');
            $table->string('nama_ayah')->default('-');
            $table->string('nama_ibu')->default('-');
            $table->string('nik');
            $table->string('golongan');
            $table->string('kelas');
            $table->string('status_karyawan');
            $table->string('lokasi_kerja');
            $table->string('tanggal_penetapan');
            $table->string('status_kawin');
            $table->string('status_pajak');
            $table->string('kode_kecamatan');
            $table->string('nama_kecamatan');
            $table->string('kode_desa');
            $table->string('nama_desa');
            $table->string('kode_faskes_tk_1');
            $table->string('faskes_tk_1');
            $table->string('plan_asuransi');
            $table->string('tanggal_efektif_asuransi')->nullable();
            $table->string('tanggal_berhenti')->nullable();
            $table->string('alasan_berhenti')->nullable();

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
        Schema::dropIfExists('employees');
    }
}
