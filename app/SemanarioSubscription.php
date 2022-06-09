<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SemanarioSubscription extends Model
{
  protected $table = "subscription_semanario";
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
      $query->whereRaw("(LOWER(subscription_semanario.name) like LOWER('%".$data."%'))");

    }
  }
}
