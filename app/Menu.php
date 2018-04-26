<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

  public function submenu()
  {
    return $this->hasMany('App\Menu', 'parent_id')->select(['id','text','label','can','url','icon']);
  }
}
