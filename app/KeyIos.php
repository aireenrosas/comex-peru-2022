<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeyIos extends Model
{
    protected $table = "key_comex_ios";
    public $primaryKey = "id";
    protected $fillable = [
      'token'
    ];
    public $timestamps = true;

}
