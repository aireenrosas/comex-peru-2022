<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatacomexSubscription extends Model
{
  protected $table = "subscription_datacomex";
  public $primaryKey = "id";
  protected $fillable = [
    'company',
    'email',
    'phone',
    'name',
    'position',
    'state',
    'authorize'
  ];

  public function scopeFilterByName($query, $data)
  {
    if($data){
      $query->whereRaw("(LOWER(subscription_datacomex.name) like LOWER('%".$data."%'))");

    }
  }
}
