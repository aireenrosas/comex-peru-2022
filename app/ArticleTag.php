<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
  protected $table = "article_tags";
  public $primaryKey = "id";
  protected $fillable = [
    'article_id',
    'tag_id'
  ];
  public $timestamps = false;
}
