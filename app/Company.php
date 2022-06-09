<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
  protected $table = "companies";
  public $primaryKey = "id";
  protected $fillable = [
    'RUC',
    'name',
    'type'
  ];
  public $timestamps = false;

  public function scopeFilterByName($query, $data)
  {
    if($data){
      $query->orwhereRaw("(LOWER(companies.name) like LOWER('%".$data."%'))");
    }
  }
}
