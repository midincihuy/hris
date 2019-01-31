<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'division_id',
        'department_id',
        'section_id',
        'name',
    ];

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function division()
    {
        return $this->belongsTo('App\Division');
    }

    public function getCompanyAttribute()
    {
        if( ! array_key_exists('division', $this->relations)){
            $this->load('division');
        }
        $division = $this->getRelation('division');
        return $division->company ? $division->company : "";
    }
}
