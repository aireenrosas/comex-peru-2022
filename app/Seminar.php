<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
  protected $table = "seminars";
  public $primaryKey = "id";
  protected $fillable = [
    'month',
    'day',
    'year',
    'date',
    'active',
    'state',
    'created_by',
    'updated_by'

  ];
  public function scopeFilterByWord($query, $data)
  {
    if($data){
      $query->whereRaw("(LOWER(seminars_languages.name) like LOWER('%".$data."%'))")
            ->orwhereRaw("(LOWER(seminars_presentations.title) like LOWER('%".$data."%'))")
            ->orwhereRaw("(LOWER(seminars_presentations.observation) like LOWER('%".$data."%'))")
            ->orwhereRaw("(LOWER(seminars_presentations.theme) like LOWER('%".$data."%'))");

    }
  }
  public function scopeFilterByName($query, $data)
  {
    if($data){
      $query->whereRaw("(LOWER(seminars_languages.name) like LOWER('%".$data."%'))");

    }
  }

}
