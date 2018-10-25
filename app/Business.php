<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
  protected $fillable = [
    'name', 'ruc', 'address'
  ];

  public function offices()
  {
    return $this->hasMany('App\Office');
  }

  public function jobs()
  {
    return $this->hasMany('App\Job');
  }
}
