<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleColumn extends Model
{
  protected $table = "article_columns";
  public $primaryKey = "id";
  protected $fillable = [
    'type_id',
    'name_es',
    'name_en'
  ];
  public $timestamps = false;
}
