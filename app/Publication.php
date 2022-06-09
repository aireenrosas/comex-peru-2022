<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
  protected $table = "publications";
  public $primaryKey = "id";
  protected $fillable = [
    'name_es',
    'name_en',
    'directory',
    'privacity',
    'type_id'
  ];
  public $timestamps = false;
  public function scopeAccessprivate($query, $data)
  {
    if($data==0){
      $query->where('publications.privacity', '=', 0);
    }
  }
}
