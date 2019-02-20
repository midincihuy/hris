<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'division_id',
        'name'
    ];

    public function division()
    {
        return $this->belongsTo('App\Division');
    }

    public function sections()
    {
        return $this->hasMany('App\Section');
    }
    
    public function positions()
    {
        return $this->hasMany('App\Position')->whereNull('section_id');
    }
}
