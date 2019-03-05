<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sk extends Model
{
    protected $fillable = [
        'employee_id',
        'no_surat',
        'jenis_surat',
        'ref_no',
        'start_date',
        'end_date',
      ];

      protected $dates = [
        'start_date',
        'end_date',
      ];

      public function employee()
      {
          return $this->belongsTo('App\Employee');
      }
}
