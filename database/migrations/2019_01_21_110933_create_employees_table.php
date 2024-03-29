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
            $table->string('employee_status');
            $table->string('status_active');
            $table->string('no_kk')->nullable();
            $table->string('no_bpjs_ketenagakerjaan')->nullable();
            $table->string('no_bpjs_kesehatan')->nullable();
            $table->string('no_bpjs_pensiun')->nullable();
            $table->string('no_npwp')->nullable();
            $table->string('no_rek_bca')->nullable();
            $table->string('no_va_dana')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nik_ibu')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('nip')->comment('No Pegawai');
            $table->string('nik')->comment('No KTP');
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
            $table->string('last_day')->nullable()->comment('Last Work Day in Office');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('kewarganegaraan');
            // $table->string('nik');
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
            $table->string('position_id');
            $table->string('avatar');
            $table->date('tmt')->comment('Terhitung Mulai Tanggal');
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
