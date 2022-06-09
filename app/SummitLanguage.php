<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SummitLanguage extends Model
{
  protected $table = "summit_languages";
  public $primaryKey = "id";
  protected $fillable = [
    'summit_id',
    'name',
    'title',
    'place',
    'description',
    'language_id'
  ];
  public $timestamps = false;
}
