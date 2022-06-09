<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
  protected $table = "log_users";
  public $primaryKey = "id";
  protected $fillable = [
    'id_users',
    'date'
  ];
  public $timestamps = false;
}
