<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeminarLanguage extends Model
{
  protected $table = "seminars_languages";
  public $primaryKey = "id";
  protected $fillable = [
    'seminar_id',
    'name',
    'language_id',
    'file',
    'place'

  ];
  public $timestamps = false;
}
