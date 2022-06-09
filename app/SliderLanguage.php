<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderLanguage extends Model
{
  protected $table = "slider_languages";
  public $primaryKey = "id";
  protected $fillable = [
    'title',
    'text',
    'button_text',
    'url'
  ];
  public $timestamps= false;
}
