<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    protected $fillable = [
        'no_ptk',
        'tanggal_ptk',
        'jenis_ptk',
        'tanggal_interview_hr',
        'status_interview_hr',
        'tanggal_test_bidang',
        'status_test_bidang',
        'tanggal_psikotest',
        'ist',
        'pauli',
        'hasil_psikotest',
        'tanggal_interview_user',
        'status_interview_user',
        'tanggal_offering',
        'status_offering',
        'jabatan_final',
        'created_by',
        'updated_by',
    ];
}