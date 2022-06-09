<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NegociosSubscription extends Model
{
  protected $table = "subscription_negocios";
  public $primaryKey = "id";
  protected $fillable = [
    'institution',
    'ruc',
    'address',
    'address_institution',
    'email',
    'phone',
    'fax',
    'name',
    'anual_peru',
    'anual_latinoamerica',
    'anual_continentes',
    'position',
    'semestral_continentes',
    'semestral_latinoamerica',
    'semestral_peru',
    'state',
    'authorize'
  ];

  public function scopeFilterByName($query, $data)
  {
    if($data){
      $query->whereRaw("(LOWER(subscription_negocios.name) like LOWER('%".$data."%'))");

    }
  }
}
