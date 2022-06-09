<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
  protected $table = "sliders";
  public $primaryKey = "id";
  protected $fillable = [
    'image',
    'created_by',
    'updated_by'
  ];
}
