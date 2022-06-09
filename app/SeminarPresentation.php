<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeminarPresentation extends Model
{
  protected $table = "seminars_presentations";
  public $primaryKey = "id";
  protected $fillable = [
    'seminar_id',
    'title',
    'theme',
    'file',
    'observation'

  ];
  public $timestamps = false;
}
