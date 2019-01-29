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
}
