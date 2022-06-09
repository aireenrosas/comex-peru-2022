<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summit extends Model
{
  protected $table = "summits";
  public $primaryKey = "id";
  protected $fillable = [
    'month',
    'day',
    'year',
    'date',
    'time',
    'url',
    'created_by',
    'updated_by'

  ];

  public function scopeFilterByWord($query, $data)
  {
    if($data){
      $query->whereRaw("(LOWER(summit_languages.name) like LOWER('%".$data."%'))")
            ->orwhereRaw("(LOWER(summit_languages.title) like LOWER('%".$data."%'))")
            ->orwhereRaw("(LOWER(summit_languages.place) like LOWER('%".$data."%'))")
            ->orwhereRaw("(LOWER(summit_languages.description) like LOWER('%".$data."%'))");

    }
  }
}
