<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TradeBarrier extends Model
{
  protected $table = "trade_barriers";
  public $primaryKey = "id";
  protected $fillable = [
    'name',
    'lastname',
    'email',
    'phone',
    'company',
    'description'
  ];

  public function scopeFilterByName($query, $data)
  {
    if($data){
      $query->whereRaw("(LOWER(trade_barriers.name) like LOWER('%".$data."%'))")
            ->orwhereRaw("(LOWER(trade_barriers.lastname) like LOWER('%".$data."%'))")
            ->orwhereRaw("(LOWER(trade_barriers.company) like LOWER('%".$data."%'))");
    }
  }
}
