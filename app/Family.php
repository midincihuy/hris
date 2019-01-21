<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $fillable = [
        'employee_id',
        'relation',
        'nik',
        'name',
        'gender',
        'place_of_birth',
        'date_of_birth',
    ];

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }
}
