<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = [
        'name',
        'company',
    ];

    public function departments()
    {
        return $this->hasMany('App\Department');
    }

    public function positions()
    {
        return $this->hasMany('App\Position')->whereNull('department_id')->whereNull('section_id');
    }
}
