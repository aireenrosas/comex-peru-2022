<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
  protected $table = "subscribers";
  public $primaryKey = "id";
  protected $fillable = [
    'email'
  ];

  public function scopeFilterByName($query, $data)
  {
    if($data){
      $query->whereRaw("(LOWER(subscribers.email) like LOWER('%".$data."%'))");

    }
  }
}
