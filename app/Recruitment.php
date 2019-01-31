<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    protected $fillable = [
        'applicant_id',
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

    public function applicant()
    {
        return $this->belongsTo('App\Applicant');
    }

    public function contract()
    {
        return $this->hasOne('App\Contract');
    }

    public function position()
    {
        return $this->belongsTo('App\Position','jabatan_final', 'id');
    }

    public function getJabatanAttribute()
    {
        if( ! array_key_exists('position', $this->relations)){
            $this->load('position');
        }
        $position = $this->getRelation('position');
        return $position->name ? $position->name : "";
    }
}
