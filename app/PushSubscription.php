<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PushSubscription extends Model
{
  protected $table = "push_subscriptions";
  public $primaryKey = "id";
  protected $fillable = [
    'user_id',
    'endpoint',
    'public_key',
    'auth_token'
  ];
  public $timestamps = true;
}
