<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Article;
use App\ArticleTag;
use Funciones;
use App\Tag;
use App\User;
use App;
use App\Publication;
class articulosController extends Controller
{
    public $language_id = 1;
    public $ruta_idioma = '';
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idioma='es',Request $request)
    {
        $rol = 0;
        if(Auth::check()){
          $rol = Auth::user()->rol_id;
        }
        $language_id = Funciones::getIdIdioma($idioma);
        $ruta = Funciones::getRuta($idioma);
        $this->language_id = $language_id;
        $this->ruta_idioma = $ruta;

        $tags_selected = explode(',', $request->input('tags'));
        $publicaciones_selected = explode(',', $request->input('categorias'));
        $all_tags = Funciones::getTags($language_id, $tags_selected);
        $all_publicaciones = Funciones::getPublicaciones($language_id, $publicaciones_selected, $rol);

        return view('front.ver.articulos')
          ->with('tags', $all_tags)
          ->with('categories', $all_publicaciones)
          ->with('request', $request)
          ->with('ruta', $ruta);
    }
    /**
     * get articulos via post
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getArticles(Request $request)
    {
        $rol = 0;
        if(Auth::check()){
          $rol = Auth::user()->rol_id;

        }
        $idioma = $request->input('idioma');
        $language_id = Funciones::getIdIdioma($idioma);
        $language_id_espanol = 1;
        $keyword = $request->input('keyword');
        $tags = $request->input('tags');
        $fecha = $request->input('fecha');
        $campo = Funciones::getCampoLang($language_id);
        //\Session::put('tags', $tags);

        $publicaciones = $request->input('categorias');
        //\Session::put('categories', $categories);

        $articles = Article::join('article_languages', 'article_languages.article_id' ,'=', 'articles.id')
          ->join('publications', 'publications.id', '=', 'articles.publication_id')
          ->leftjoin('article_columns', 'article_columns.id', '=', 'articles.column_id')
          ->filterByWord($keyword)
          ->filterByTags($tags)
          ->filterByPublication($publicaciones)
          ->filterByDay($fecha)
          ->accessprivate($rol)
          ->where('article_languages.language_id', '=', $language_id_espanol)
          ->where('articles.is_open', '=', true)
          ->select('article_languages.document', 'article_languages.title','articles.id', 'articles.autor','article_languages.slug', 'articles.published_at',
          'articles.only_file', 'articles.edition','publications.id as idpubli','publications.name_es', 'publications.name_en', 'publications.directory', 'article_columns.'.$campo.' as columna')
          ->orderBy('articles.published_at','desc')
          ->orderBy('articles.id','desc')
          ->simplePaginate(7);


        $pages = $articles->toArray();

        $json['data']=[];


        foreach ($articles as $key) {
          $doc =json_decode($key->document);

          if($key->only_file==1){
              $data['link'] = url('upload/articles/'.$key->directory.'/'.$doc->file);
          }
          else{
            $data['link'] = url($idioma.'/articulo/'.$key->slug);
          }
          $data['title'] = $key->title;
          if($doc->abstract && $doc->abstract!='null'){
            $data['content'] = $doc->abstract;
          }
          else{
            $data['content'] = '';
          }
          if($doc->cover && $doc->cover!='')
          {
            $data['image'] = url('upload/images/'.$doc->cover);
          }
          else{
            $data['image'] = "";
          }

          // if((!$doc->cover || $doc->cover='') && $key->only_file==1){
          //   $data['image'] = Funciones::tipoArchivo($doc->file);
          // }
          $data['id'] = $key->id;
          $data['edition'] = $key->edition;
          $data['id_publications'] = $key->idpubli;

          $data['columna'] = '';
          if($key->columna){
            $data['columna'] = ' - '.$key->columna;
          }

          $data['id_publications'] = $key->idpubli;


          if($language_id==1){
            $data['publications'] = $key->name_es;
            $data['linkpublic'] = url('/publicaciones?id='.$data['id_publications'].'&publicacion='.  $data['publications'].'&edicion='.$data['edition']);
          }else{
            $data['publications'] = $key->name_en;
            $data['linkpublic'] = url('en/publicaciones?id='.$data['id_publications'].'&publicacion='.  $data['publications'].'&edicion='.$data['edition']);
          }

          // $data['linkpublic'] = url($language_id.'/publicaciones?id='.$data['id_publications'].'&publicacion='.  $data['publications'].'&edicion='.$data['edition']);


          if($key->autor){
            $data['creado_por'] = $key->autor;
          }
          else{
            $data['creado_por'] = '';
          }

          $data['fecha'] = Funciones::getDateString($key->published_at, $language_id);
          $data['tags'] = [];

          $tags = ArticleTag::join('tags', 'tags.id', '=', 'article_tags.tag_id')
            ->where('article_id', '=', $key->id)
            ->select('article_tags.tag_id', 'tags.'.$campo.' as name')
            ->get();

          foreach ($tags as $tag) {
            if($tag){
              $data['tags'][] = $tag->name;
            }
          }
          $json['data'][]=$data;
        }
        if(isset($pages['next_page_url'])){
          $json['next_page']=$pages['current_page']+1;
        }
        else{
          $json['next_page']=null;
        }
        $json['idioma']=$idioma;

        //dd($json);
        return $json;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * select tags
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function selectTags(Request $request)
    {
        $tags_selected = $request->input('tags');
        \Session::put('tags',$tags_selected);
    }
    /**
     * select categories
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function selectCategories(Request $request)
    {
        $categories_selected = $request->input('categories');
        \Session::put('categories',$categories_selected);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($idioma= 'es', $slug='1')
    {
      if($slug=='1'){
        $slug = $idioma;
        $idioma = 'es';
      }
      $rol = 0;
      if(Auth::check()){
        $rol = Auth::user()->rol_id;
      }

      $language_id = Funciones::getIdIdioma($idioma);
      $language_id_espanol = 1;
      $ruta = Funciones::getRuta($idioma);

      $tags_selected = [];
      $publicaciones_selected = [];
      $all_tags = Funciones::getTags($language_id, $tags_selected);
      $all_publicaciones = Funciones::getPublicaciones($language_id, $publicaciones_selected, $rol);
      $campo = Funciones::getCampoLang($language_id);

      $article = Article::join('article_languages', 'article_languages.article_id' ,'=', 'articles.id')
        ->leftjoin('article_columns', 'article_columns.id', '=', 'articles.column_id')
        ->where('article_languages.language_id', '=', $language_id_espanol)
        ->where('article_languages.slug', '=', $slug)
        ->select('article_languages.document','articles.privacity','article_columns.'.$campo.' as columna','articles.edition','article_languages.title', 'articles.id', 'article_languages.slug', 'articles.only_file', 'articles.autor', 'articles.publication_id')
        ->first();

      if(!$article){
        return redirect($ruta.'/articulos');
      }

      if($article->privacity==1){
        if(!\Auth::check()){
          return redirect($ruta)->with('login', 'Por favor inicie sesión');
        }
      }


      $data = [];

      $tags_relacionados = [];
      $articulos_relacionados = [];

      if($article){
        $publicacion = Publication::where('id', '=', $article->publication_id)->first();

        $doc =json_decode($article->document);
        $data['title'] = $article->title;
        $data['slug'] = $article->slug;
        $data['content'] = $doc->content;
        $data['abstract'] = $doc->abstract;
        $data['leyend'] = $doc->leyend;
        $data['source'] = $doc->source;
        if(isset($doc->cover) && $doc->cover!=''){
          $data['image'] = url('upload/images/'.$doc->cover);
        }
        else{
          $data['image'] = '';
        }
        if(isset($doc->file) && $doc->file!=''){
          $data['file'] = url('upload/articles/'.$publicacion->directory.'/'.$doc->file);
        }
        else{
          $data['file'] = '';
        }

        $data['id'] = $doc->id;
        $data['creado_por'] = $article->autor;
        $data['fecha'] = Funciones::getDateString($doc->published_at, $language_id);
        $data['publication'] = $publicacion->$campo;
        $data['edition'] = $article->edition;
        $data['columna'] = $article->columna;
        $data['tags'] = [];
        $data['url_publicacion'] =  url('/publicaciones?id='.$publicacion->id.'&publicacion='.$publicacion->$campo.'&edicion='.$article->edition);

        $tags = ArticleTag::join('tags', 'tags.id', '=', 'article_tags.tag_id')
          ->where('article_id', '=', $article->id)
          ->select('article_tags.tag_id', 'tags.'.$campo.' as name')
          ->get();

        foreach ($tags as $tag) {
          if($tag){
            $data['tags'][] = $tag->name;
            $data['id_tags'][] = $tag->tag_id;
            $tags_relacionados[]=$tag->tag_id;
          }

        }
        $articles_relacionados = Article::join('article_languages', 'article_languages.article_id' ,'=', 'articles.id')
          ->join('publications', 'publications.id', '=', 'articles.publication_id')
          ->join('article_tags', 'article_tags.article_id', '=', 'articles.id')
          ->leftjoin('article_columns', 'article_columns.id', '=', 'articles.column_id')
          ->accessprivate($rol)
          ->where('article_languages.language_id', '=', $language_id_espanol)
          ->where('articles.is_open', '=', true)
          ->whereIn('article_tags.tag_id', $tags_relacionados)
          ->where('articles.id','!=', $article->id)
          ->select('article_languages.document', 'article_languages.title','article_columns.'.$campo.' as columna', 'articles.id', 'articles.autor','article_languages.slug', 'articles.only_file', 'articles.edition','publications.id as idpubli','publications.name_es', 'publications.name_en', 'publications.directory','articles.published_at')
          ->groupBy('article_languages.document', 'article_languages.title','article_columns.'.$campo, 'articles.id', 'articles.autor','article_languages.slug', 'articles.only_file','articles.edition','idpubli','publications.name_es', 'publications.name_en', 'publications.directory','articles.published_at')
          ->orderBy('articles.published_at','desc')
          ->orderBy('articles.id','desc')
          ->take(2)
          ->get();

        $articulos_relacionados = Funciones::armarArticulo($articles_relacionados, $campo, $ruta, $language_id);

      }


      return view('front.ver.detallearticulo')
            ->with('tags', $all_tags)
            ->with('categories', $all_publicaciones)
            ->with('articulo', $data)
            ->with('articulos_relacionados', $articulos_relacionados)
            ->with('ruta', $ruta);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
