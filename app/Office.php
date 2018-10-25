<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
  protected $fillable = [
    'business_id', 'name'
  ];
}
