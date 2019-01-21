<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'no_kk',
        'no_bpjs_ketenagakerjaan',
        'no_bpjs_kesehatan',
        'no_bpjs_pensiun',
        'no_npwp',
        'no_rek_bca',
        'no_va_dana',
        'alamat',
        'nama_ayah',
        'nama_ibu',
        'nik',
        'golongan',
        'kelas',
        'status_karyawan',
        'lokasi_kerja',
        'tanggal_penetapan',
        'status_kawin',
        'status_pajak',
        'kode_kecamatan',
        'nama_kecamatan',
        'kode_desa',
        'nama_desa',
        'kode_faskes_tk_1',
        'faskes_tk_1',
        'plan_asuransi',
        'tanggal_efektif_asuransi',
        'tanggal_berhenti',
        'alasan_berhenti',
        'no_ktp',
        'alamat_ktp',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'kota',
        'kode_pos',
        'telephone_rumah',
        'handphone',
        'email',
        'skype_id',
        'agama',
        'golongan_darah',
        'pendidikan_terakhir',
        'institusi_pendidikan',
        'jurusan',
        'tahun_masuk',
        'tahun_keluar',
        'informasi_lowongan',
    ];

    public function family()
    {
        return $this->hasMany('App\Family');
    }
    
}
