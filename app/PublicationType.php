<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicationType extends Model
{
  protected $table = "publications_type";
  public $primaryKey = "id";
  protected $fillable = [
    'name'
  ];
  public $timestamps = false;
}
