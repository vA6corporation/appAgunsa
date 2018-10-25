<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  //
  protected $fillable = [
    'name', 'father_surname', 'mother_surname', 'dni', 'business_id', 'office_id', 'job_id'
  ];

  public function business()
  {
    return $this->belongsTo('App\Business');
  }

  public function office()
  {
    return $this->belongsTo('App\Office');
  }

  public function job()
  {
    return $this->belongsTo('App\Job');
  }
}
