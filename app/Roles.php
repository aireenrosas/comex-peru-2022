<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
  protected $table = "roles";
  public $primaryKey = "id";
  protected $fillable = [
    'name'
  ];
  public $timestamps = false;
}
