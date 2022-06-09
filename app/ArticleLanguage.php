<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleLanguage extends Model
{
  protected $table = "article_languages";
  public $primaryKey = "id";
  protected $fillable = [
    'article_id',
    'language_id',
    'title',
    'abstract',
    'theme',
    'content',
    'leyend',
    'source',
    'file',
    'document',
    'slug'
  ];
  public $timestamps = true;

  public function scopeEnglish($query, $data)
  {
      if($data){
        $query->where('language_id', '=',2)
        ->where('id', '!=', $data->id);
      }
  }
}
