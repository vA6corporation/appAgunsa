<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
  public function customer()
  {
    return $this->belongsTo('App\Customer');
  }

  protected $fillable = [
    'customer_id', 'type', 'entry', 'option', 'observation'
  ];
}
