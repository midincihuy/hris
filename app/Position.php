<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Division;
class Position extends Model
{
    protected $fillable = [
        'division_id',
        'department_id',
        'section_id',
        'parent_id',
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

    public function parent()
    {
        return $this->belongsTo('App\Position', 'parent_id');
    }

    public static function list_position()
    {
        foreach(Division::all() as $division){
            $value = Position::where('division_id',$division->id)->orderBy('name')->get()->each(function($x){
                $department_name = isset($x->department) ? $x->department->name." " : "";
                $section_name = isset($x->section) ? " / ".$x->section->name." " : "";
                $additional_info = $department_name.$section_name;
                $x->position_name = "[".$x->name."] ".$additional_info;
            })->pluck('position_name', 'id')->toArray();
            $list_jabatan[$division->company." | ".$division->name] = $value;
        }
        return $list_jabatan;
    }

    public function person()
    {
        return $this->hasMany('App\Employee')->where('status_active', 'Aktif');
    }
}
