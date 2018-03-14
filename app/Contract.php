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
    'nik', 'name', 'gender', 'contract_date',
    'employee_status', 'status_active',
    'status_contract', 'contract_duration', 'head_1', 'email_head_1',
    'head_2', 'email_head_2', 'division',
    'department', 'position',
    'reminder', 'upload_by'
  ];

}