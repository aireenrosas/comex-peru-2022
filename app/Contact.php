<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
  protected $table = "contact";
  public $primaryKey = "id";
  protected $fillable = [
    'name',
    'company',
    'email',
    'phone',
    'message',
    'authorize'
  ];

  public function scopeFilterByName($query, $data)
  {
    if($data){
      $query->whereRaw("(LOWER(contact.name) like LOWER('%".$data."%'))");

    }
  }
}
