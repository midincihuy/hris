<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
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
        'nip',
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
        'last_day',
        'nik',
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
        'position_id',
        'avatar',
        'tmt',
        'employee_status',
        'status_active',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'head_nik',
    ];

    protected $dates = [
        'tanggal_lahir',
        'tanggal_berhenti',
        'last_day',
        'tanggal_efektif_asuransi',
        'tmt',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date:Y-m-d',
    ];

    public function family()
    {
        return $this->hasMany('App\Family');
    }

    public function contract()
    {
        return $this->hasMany('App\Contract')->orderBy('id','desc');
    }

    public function sk()
    {
        return $this->hasMany('App\Sk')->orderBy('id','desc');
    }

    public function position()
    {
        return $this->belongsTo('App\Position');
    }

    public function documents()
    {
        return $this->hasMany('App\Document');
    }

    public function head(){
        return $this->hasOne('App\Employee', 'nik', 'head_nik');
    }

    public function staff(){
        return $this->hasMany('App\Employee', 'head_nik', 'nik');
    }

    public function getAlamatAttribute()
    {
        $alamat = $this->alamat_ktp;
        $alamat .= " RT ".$this->rt;
        $alamat .= " RW ".$this->rw;
        $alamat .= "<br/> Kel. ".$this->kelurahan;
        $alamat .= "<br/> Kec. ".$this->kecamatan;
        $alamat .= "<br/> Kab/Kota ".$this->kota;
        $alamat .= " ".$this->kode_pos;




        return $alamat;
    }

    public function getTanggalLahirAttribute($value)
    {
        setLocale(LC_TIME, 'id_ID.utf8');
        $data = new Carbon($value);
        return $data;
    }

    public function getTmtAttribute($value)
    {
        setLocale(LC_TIME, 'id_ID.utf8');
        $data = new Carbon($value);
        return $data;
    }
    
}
