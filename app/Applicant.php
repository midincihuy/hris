<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $fillable = [
        'id_pelamar',
        'posisi_yang_dilamar',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'kewarganegaraan',
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
        'upload_by',
    ];

    public function recruitment()
    {
        return $this->hasOne('App\Recruitment');
    }
}
