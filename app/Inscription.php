<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
  protected $table = "inscriptions";
  public $primaryKey = "id";
  protected $fillable = [
    'seminar_id',
    'company',
    'RUC',
    'sector',
    'address',
    'email',
    'phone',
    'fax',
    'name',
    'lastname',
    'document_type',
    'document',
    'position',
    'state',
    'authorize'
  ];

  public function scopeFilterByName($query, $data)
  {
    if($data){
      $query->whereRaw("(LOWER(seminars_languages.name) like LOWER('%".$data."%'))");

    }
  }
}
