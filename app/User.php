<?php

namespace App;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasPushSubscriptions;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password','rol_id', 'login', 'ruc', 'test_days','state','description', 'VeritradePass', 'password_no_encriptado'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeFilterByName($query, $data)
    {
      if($data){
        $query->whereRaw("(LOWER(users.name) like LOWER('%".$data."%'))")
              ->orwhereRaw("(LOWER(users.login) like LOWER('%".$data."%'))");
      }
    }

}
