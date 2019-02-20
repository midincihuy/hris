<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'department_id',
        'name',
    ];

    public function department()
    {
        return $this->belongsTo('App\Department');
    }
    
    public function positions()
    {
        return $this->hasMany('App\Position');
    }
}
