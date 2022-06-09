<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\ArticleLanguage;
use App\Publication;
use App\ArticleTag;
use App\ArticleColumn;
use App\Tag;
use Auth;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Funciones;
use App;
use DB;

class adminArticulosController extends Controller
{
  public $language_id = 1;
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('admin');

  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $language_id = $this->language_id;
      $articles = Article::join('article_languages', 'article_languages.article_id', 'articles.id')
        ->join('publications', 'publications.id', '=','articles.publication_id')
        ->filterByName($request->input('filtro_article'))
        ->filterByEdition($request->input('filtro_edicion'))
        ->filterByPublication($request->input('filtro_publicacion'))
        ->select('articles.id','article_languages.title', 'articles.published_at', 'articles.autor','articles.edition', 'articles.created_at', 'articles.is_open', 'publications.name_es', 'articles.privacity')
        ->where('article_languages.language_id', '=', $language_id)
        ->orderBy('articles.created_at','desc')
        ->orderBy('articles.published_at','desc')
        ->orderBy('articles.id','desc')
        ->paginate(25);

      $publicaciones = Publication::pluck('name_es', 'id');

      return view('admin.articles.articles')
        ->with('articles', $articles)
        ->with('publicaciones', $publicaciones)
        ->with('request', $request);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $publicaciones = Publication::get();
      $tags = Tag::get();
      $columnas = ArticleColumn::get();


        $full_path = ('./upload/images');
        $url = url('/upload/images');



      return view('admin.articles.newarticle')
        ->with('publicaciones', $publicaciones)
        ->with('tags', $tags)
        ->with('columnas', $columnas);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $id_publication = $request->input('publication');

      $publi = Publication::where('id', '=', $id_publication)->first();

      $path = 'upload/articles/'.$publi->directory.'/';
      $path_image = 'upload/images/';
      $user = Auth::user()->id;
      $item = new Article();
      $id_article = $item->createArticle($request, $user, $path, $path_image);

      return redirect('admin/articulos');


  }
  /**
   * Publish article.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function publishArticle(Request $request)
  {
      $id_article = $request->input('article');
      $fecha = $request->input('fecha_publicacion');

      $item = Article::find($id_article);
      $item->is_open = true;
      $item->published_at = $fecha;
      $item->save();

      return redirect('admin/articulos');


  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }
  public function getImagenesFolder()
  {
    $files = array();
      $full_path = ('./upload/images');
      $url = url('/upload/images');

      $pDir = opendir($full_path);

      while(false !== ($current_file = readdir($pDir))) {
        if($current_file!='.' && $current_file!='..'){
          $files[] = $url . '/'.$current_file;
        }
      }
      closedir($pDir);

      return array('imagenes'=>$files);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      $publicaciones = Publication::get();
      $tags = Tag::get();
      $columnas = ArticleColumn::get();

      $articulo = Article::where('id', '=', $id)->first();

      if($articulo){
        $articulo_es = ArticleLanguage::where('article_id', '=',$articulo->id)
          ->where('language_id', '=',1)
          ->first();

        $articulo_en = ArticleLanguage::where('article_id', '=',$articulo->id)
          ->where('language_id', '=',2)
          ->first();

        $publicacion = Publication::where('id', '=', $articulo->publication_id)->first();

        $articulo_tags = ArticleTag::where('article_id', '=', $articulo->id)
          ->select('tag_id')
          ->get();

        $tags_selected = [];

        foreach ($articulo_tags as $key) {
          array_push($tags_selected, $key->tag_id);
        }

      }
      else{
        return redirect()->back();
      }

      return view('admin.articles.editarticle')
        ->with('publicaciones', $publicaciones)
        ->with('tags', $tags)
        ->with('articulo', $articulo)
        ->with('articulo_es', $articulo_es)
        ->with('articulo_en', $articulo_en)
        ->with('publicacion', $publicacion)
        ->with('tags_selected', $tags_selected)
        ->with('columnas', $columnas);;
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
    $id_publication = $request->input('publication');

    $publi = Publication::where('id', '=', $id_publication)->first();

    $path = 'upload/articles/'.$publi->directory.'/';
    $path_image = 'upload/images/';

    $user = Auth::user()->id;

    $item =Article::find($id);
    $id_article = $item->updateArticle($request, $user, $path, $path_image);

    return redirect('admin/articulos');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function deleteArticle(Request $request)
  {
      $id = $request->input('id');
      $item =Article::find($id);
      $item->is_open = false;
      $item->save();

      return 'success';
  }
  public function newimageftp(Request $request)
    {
        $filename = 'file';
        $directory = 'upload/images/';
        if (Input::hasFile($filename))
        {

            $fullName = Input::file($filename)->getClientOriginalName();
            $extension = Input::file($filename)->getClientOriginalExtension();

            $fullNameLength = strlen($fullName);

            $extensionLength = strlen($extension);
            $nameLength = $fullNameLength - ($extensionLength + 1);
            $onlyName = substr($fullName, 0, $nameLength);
            //$onlyName = Funciones::simplicar_string($onlyName);
            $maxlength = 180 - ($extensionLength+1);
            $name_of_file = substr($onlyName,0,$maxlength). '-' .date('dmy') . '-' . date('his'). '.' .$extension;
            $name = $directory.$name_of_file;
            $f = Input::file($filename)->move($directory, $name);

            return url('upload/images/'.$name_of_file);
        }
        else{
            return '';
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteImg(Request $request)
    {
        $id = $request->input('id');
        $item =Article::find($id);
        $publi = Publication::where('id', '=', $item->publication_id)->first();

        $path = 'upload/images/';

        File::delete($path.$item->cover);

        $item->cover = "";
        $item->save();

        return 'success';
    }
    /**
     * Change privacity of an article, massive form
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePrivacity(Request $request)
    {
        $articles = implode(',' , $request->input('articles'));
        $privacidad = $request->input('privacidad');

        $update = DB::statement("UPDATE articles SET privacity=$privacidad WHERE articles.id IN ($articles);");

        return 'success';
    }
    /**
     * Update date of publication of an article, massive form
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePublicationDate(Request $request)
    {
        $articulos_ids = implode(',' , $request->input('articles'));
        $articles = $request->input('articles');
        $fecha = $request->input('fecha');

        $update = DB::statement("UPDATE articles SET published_at='$fecha' WHERE articles.id IN ($articulos_ids);");

        foreach ($articles as $key => $value) {
          $languages = ArticleLanguage::where('article_id', '=', $value)->select('document', 'id')->get();
          foreach ($languages as $lang) {
            $document = json_decode($lang->document);
            $document->published_at = $fecha;
            $document = json_encode($document);

            $item = ArticleLanguage::find($lang->id);
            $item->document = $document;
            $item->save();
          }
        }

        return 'success';
    }
}
