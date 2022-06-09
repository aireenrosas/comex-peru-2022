<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Article;
use App\ArticleLanguage;
use App\ArticleCategory;
use App\Publication;
use App\ArticleTag;
use App\Category;
use App\Tag;
use Auth;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Funciones;


class Article extends Model
{
    protected $table = "articles";
    public $primaryKey = "id";
    protected $fillable = [
      'publication_id',
      'cover',
      'is_open',
      'privacity',
      'has_languages',
      'edition',
      'tema',
      'autor',
      'observacion',
      'created_by',
      'updated_by',
      'published_at',
      'only_file',
      'column_id'
    ];
    public $timestamps = true;

    public function createArticle(Request $request, $user, $path, $path_image){

      if($request->input('open')=='1'){
        $this->is_open = true;
      }
      else{
        $this->is_open = false;
      }

      if($request->input('has_language')=='1'){
        $this->has_languages = true;
      }
      else{
        $this->has_languages = false;
      }

      if($request->input('only_file')=='1'){
        $this->only_file = true;
      }
      else{
        $this->only_file = false;
      }

      if(!$request->input('privacity')){
        $this->privacity = false;
      }else{
        $this->privacity = true;
      }

      $this->publication_id = $request->input('publication');
      $this->column_id = $request->input('column_id');
      $this->edition = $request->input('edition');
      $this->autor = $request->input('autor');
      $this->created_by = $user;
      $this->updated_by = $user;
      $this->published_at = $request->input('fecha_publicacion');
      $this->cover = Funciones::saveImage('cover-articulo', $path_image);
      $this->save();

      $tags = $request->input('tags');

      if(count((array)$tags)>0){
        foreach ($tags as $key => $value) {
          $categ = new ArticleTag();
          $categ->tag_id = $value;
          $categ->article_id = $this->id;
          $categ->save();
        }
      }

      $title_es = $request->input('title_es');
      $content_es = $request->input('content_es');
      $abstract_es = $request->input('abstract_es');
      $leyend_es = $request->input('leyend_es');
      $source_es = $request->input('source_es');

      if($request->input('archivo_manual_es')=='1' && trim($request->input('name_file_es'))){
        $file_es =trim($request->input('name_file_es'));
      }
      else{
        $file_es = Funciones::saveFile('file_es', $path);
      }


      $slug = Funciones::simplicar_string($request->input('title_es'));
      $existeslug = ArticleLanguage::where('slug', '=', $slug)->first();

      if($existeslug)
      {
        $slug = Funciones::simplicar_string($request->input('title_es')).'-'.strtotime(date('Y-m-d h:i:s'));
      }

      $item_es = new ArticleLanguage();
      $item_es->article_id = $this->id;
      $item_es->language_id = 1;//spanish
      $item_es->title = $title_es;
      $item_es->content = $content_es;
      $item_es->abstract = $abstract_es;
      $item_es->leyend = $leyend_es;
      $item_es->source = $source_es;
      $item_es->file = $file_es;
      $item_es->document = Funciones::generateDocumentArticle($this->id, 1, $item_es->id, $title_es, $content_es, $abstract_es, $leyend_es, $source_es, $file_es);
      $item_es->slug = $slug;
      $item_es->save();


      if($request->input('has_language')=='1')
      {
        $title_en = $request->input('title_en');
        $content_en = $request->input('content_en');
        $abstract_en = $request->input('abstract_en');
        $leyend_en = $request->input('leyend_en');
        $source_en = $request->input('source_en');

        if($request->input('archivo_manual_en')=='1' && trim($request->input('name_file_en'))){
          $file_en =trim($request->input('name_file_en'));
        }
        else{
          $file_en = Funciones::saveFile('file_en', $path);
        }

        $item_en = new ArticleLanguage();
        $item_en->article_id = $this->id;
        $item_en->language_id = 2;//english
        $item_en->title = $title_en;
        $item_en->abstract = $abstract_en;
        $item_en->content = $content_en;
        $item_en->leyend = $leyend_en;
        $item_en->source = $source_en;
        $item_en->file = $file_en;
        $item_en->document = Funciones::generateDocumentArticle($this->id, 2, $item_en->id, $title_en, $content_en, $abstract_en, $leyend_en, $source_en, $file_en);
        $item_en->slug = $slug;
        $item_en->save();

      }
      return $this->id;
    }
    public function updateArticle(Request $request, $user, $path, $path_image){

      if($request->input('open')=='1'){
        $this->is_open = true;
      }
      else{
        $this->is_open = false;
      }

      if($request->input('has_language')=='1'){
        $this->has_languages = true;
      }
      else{
        $this->has_languages = false;
      }

      if($request->input('only_file')=='1'){
        $this->only_file = true;
      }
      else{
        $this->only_file = false;
      }

      if(!$request->input('privacity')){
        $this->privacity = false;
      }else{
        $this->privacity = true;
      }

      $this->updated_by = $user;
      $this->published_at = $request->input('fecha_publicacion');

      if (Input::hasFile('cover-articulo'))
      {
        $this->cover = Funciones::saveImage('cover-articulo', $path_image);
      }

      $this->publication_id = $request->input('publication');
      $this->column_id = $request->input('column_id');
      $this->edition = $request->input('edition');
      $this->autor = $request->input('autor');
      $this->save();

      $tags = $request->input('tags');

      ArticleTag::where('article_id', '=', $this->id)->delete();

      if(count((array)$tags)>0){
        foreach ($tags as $key => $value) {
          $categ = new ArticleTag();
          $categ->tag_id = $value;
          $categ->article_id = $this->id;
          $categ->save();
        }
      }


      $item_es = ArticleLanguage::where('article_id', '=',$this->id)
        ->where('language_id', '=',1)
        ->first();

      if($item_es){

        $item_es = ArticleLanguage::find($item_es->id);
        $file_es = $item_es->file;

        if($request->input('archivo_manual_es')=='1' && trim($request->input('name_file_es'))){
          $file_es =trim($request->input('name_file_es'));
          $item_es->file = $file_es;
        }
        else{
          if (Input::hasFile('file_es'))
          {
            $file_es = Funciones::saveFile('file_es', $path);
            $item_es->file = $file_es;
          }
        }

      }
      else{
        if($request->input('archivo_manual_es')=='1' && trim($request->input('name_file_es'))){
          $file_es =trim($request->input('name_file_es'));
        }
        else{
          $file_es = Funciones::saveFile('file_es', $path);
        }
        $item_es = new ArticleLanguage();
        $item_es->article_id = $this->id;
        $item_es->language_id = 1;//spanish
        $item_es->file = $file_es;
      }

      $title_es = $request->input('title_es');
      $content_es = $request->input('content_es');
      $abstract_es = $request->input('abstract_es');
      $leyend_es = $request->input('leyend_es');
      $source_es = $request->input('source_es');

      $slug = Funciones::simplicar_string($request->input('title_es'));

      $item_en = ArticleLanguage::where('article_id', '=',$this->id)
        ->where('language_id', '=',2)
        ->first();

      $existeslug = ArticleLanguage::where('slug', '=', $slug)
        ->english($item_en)
        ->where('id', '!=', $item_es->id)
        ->first();

      if($existeslug)
      {
        $slug = Funciones::simplicar_string($request->input('title_es')).'-'.strtotime(date('Y-m-d h:i:s'));
      }

      $item_es->title = $title_es;
      $item_es->abstract = $abstract_es;
      $item_es->content = $content_es;
      $item_es->leyend = $leyend_es;
      $item_es->source = $source_es;
      $item_es->document = Funciones::generateDocumentArticle($this->id, 1,$item_es->id, $title_es, $content_es, $abstract_es, $leyend_es, $source_es, $file_es);
      $item_es->slug = $slug;
      $item_es->save();


      if($request->input('has_language')=='1')
      {

        if($item_en){
          $item_en = ArticleLanguage::find($item_en->id);
          $file_en = $item_en->file;

          if($request->input('archivo_manual_en')=='1' && trim($request->input('name_file_en'))){
            $file_en =trim($request->input('name_file_en'));
            $item_en->file = $file_es;
          }
          else{
            if (Input::hasFile('file_en'))
            {
              $file_en = Funciones::saveFile('file_en', $path);
              $item_en->file = $file_es;
            }
          }

        }
        else{
          if($request->input('archivo_manual_en')=='1' && trim($request->input('name_file_en'))){
            $file_en =trim($request->input('name_file_en'));
          }
          else{
            $file_en = Funciones::saveFile('file_en', $path);
          }

          $item_en = new ArticleLanguage();
          $item_en->article_id = $this->id;
          $item_en->language_id = 2;//english
          $item_en->file = $file_es;
        }

        $title_en = $request->input('title_en');
        $content_en = $request->input('content_en');
        $abstract_en = $request->input('abstract_en');
        $leyend_en = $request->input('leyend_en');
        $source_en = $request->input('source_en');

        $item_en->title = $title_en;
        $item_en->abstract = $abstract_en;
        $item_en->content = $content_en;
        $item_en->leyend = $leyend_en;
        $item_en->source = $source_en;
        $item_en->document = Funciones::generateDocumentArticle($this->id, 2,$item_en->id, $title_en, $content_en, $abstract_en, $leyend_en, $source_en, $file_en);
        $item_en->slug = $slug;
        $item_en->save();

      }
      return $this->id;
    }
    public function scopeOrderbyEdition($query, $data)
    {
      if($data){
        $query->orderBy('articles.published_at','asc')
        ->orderBy('articles.id','asc');
      }
      else{
        $query->orderBy('articles.published_at','desc')
        ->orderBy('articles.id','desc');
      }

    }
    public function scopeFilterByName($query, $data)
    {
      if($data){
        $query->whereRaw("(LOWER(article_languages.title) like LOWER('%".$data."%'))");
      }
    }
    public function scopeFilterByTags($query, $data)
    {
        if($data){
          $query->whereRaw("articles.id IN (SELECT at.article_id
                  FROM article_tags AS at
                  WHERE at.tag_id IN ($data)
                )");
        }
    }
    public function scopeFilterByPublication($query, $data)
    {
        if($data){
          $query->whereRaw("articles.publication_id IN ($data)");
        }
    }
    public function scopeFilterByWord($query, $data)
    {
      if($data){
        $query->whereRaw("(article_languages.slug like LOWER('%".$data."%'))")
              ->orwhereRaw("(LOWER(article_languages.title) like LOWER('%".$data."%'))")
              ->orwhereRaw("(LOWER(article_languages.content) like LOWER('%".$data."%'))")
              ->orwhereRaw("(LOWER(article_languages.theme) like LOWER('%".$data."%'))")
              ->orwhereRaw("(LOWER(articles.observacion) like LOWER('%".$data."%'))")
              ->orwhereRaw("(LOWER(article_languages.abstract) like LOWER('%".$data."%'))")
              ->orwhereRaw("LOWER(concat(publications.name_es,' ', TRIM(articles.edition))) like LOWER('%".$data."%')")
              ->orwhereRaw("LOWER(concat(publications.name_en,' ', TRIM(articles.edition))) like LOWER('%".$data."%')");
      }
    }
    public function scopeFilterByEdition($query, $data)
    {
      if($data && $data!=''){
        $data = trim($data);
        $query->whereRaw("(LOWER(TRIM(articles.edition)) like LOWER('".$data."'))");
      }
    }
    public function scopeAccessprivate($query, $data)
    {
      if($data<1){
        $query->where('articles.privacity', '=', 0);
      }
    }
    public function scopeFilterByDay($query, $data)
    {

      if($data && $data!=''){
        $fecha = date('Y-m-d');

        switch ($data) {
          case 'semana':
              $nuevafecha = strtotime ( '-7 day' , strtotime ( $fecha ) ) ;
              $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
              $query->whereBetween("articles.published_at", [$nuevafecha, $fecha]);
            break;
          case 'mes':
              $nuevafecha = strtotime ( '-30 day' , strtotime ( $fecha ) ) ;
              $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
              $query->whereBetween("articles.published_at", [$nuevafecha, $fecha]);
            break;
          case 'annio':
              $nuevafecha = strtotime ( '-365 day' , strtotime ( $fecha ) ) ;
              $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
              $query->whereBetween("articles.published_at", [$nuevafecha, $fecha]);
            break;

          default:
            break;
        }
      }


    }
}
