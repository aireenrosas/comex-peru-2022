<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyType extends Model
{
  protected $table = "companies_type";
  public $primaryKey = "id";
  protected $fillable = [
    'name'
  ];
  public $timestamps = false;
}
