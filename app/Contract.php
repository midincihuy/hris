<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'recruitment_id',
    'employee_id',
    'nik',
    'name',
    'gender',
    'contract_number',
    'contract_date',
    'employee_status',
    'status_active',
    'status_contract',
    'contract_duration',

    'head_1',
    'email_head_1',
    'head_2',
    'email_head_2',
    
    'division',
    'department',
    'position',
    'reminder',
    'upload_by',
    'contract_type',
    'contract_expire_date',
    'contract_reference_no',

  ];

  protected $dates = [
    'contract_date',
    'contract_expire_date',
];

  public function employee()
  {
      return $this->belongsTo('App\Employee');
  }

  public function position_role()
  {
      return $this->belongsTo('App\Position','position', 'id');
  }

  public function getJabatanAttribute()
  {
      if( ! array_key_exists('position_role', $this->relations)){
          $this->load('position_role');
      }
      $position = $this->getRelation('position_role');
      return $position->name ? $position->name : "";
  }

  public function parent()
  {
    return $this->hasOne('App\Contract', 'contract_number', 'contract_reference_no');
  }

}
