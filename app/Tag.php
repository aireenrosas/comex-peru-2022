<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  protected $table = "tags";
  public $primaryKey = "id";
  protected $fillable = [
    'name_es',
    'name_en'
  ];
  public $timestamps = false;
}
