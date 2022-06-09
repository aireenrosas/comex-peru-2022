<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Conexiones;
use DB;
use Auth;
use App\CompanyItemSearched;
use App\CompanyHomeCategory;
use App\Companies;
use App\JobOpening;
use App\Tag;
use Funciones;
use App;
use App\Article;
use App\User;
use App\Slider;
use App\Seminar;
use App\Subscriber;
use Mail;
use App\Summit;
use App\SummitLanguage;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use App\Contact;

use Validator;

class FrontController extends Controller
{

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
      if($idioma!='es' && $idioma!='en')
      {
        return redirect('/');
      }

      $language_id = Funciones::getIdIdioma($idioma);
      $language_id_espanol = 1;
      $ruta = Funciones::getRuta($idioma);
      $tags_selected = explode(',', $request->input('tags'));
      $publicaciones_selected = explode(',', $request->input('categorias'));
      $all_tags = Funciones::getTags($language_id, $tags_selected);
      $all_publicaciones = Funciones::getPublicaciones($language_id, $publicaciones_selected, $rol);

      $campo = Funciones::getCampoLang($language_id);

      $articles = Article::join('article_languages', 'article_languages.article_id' ,'=', 'articles.id')
        ->join('publications', 'publications.id', '=', 'articles.publication_id')
        ->leftjoin('article_columns', 'article_columns.id', '=', 'articles.column_id')
        ->accessprivate($rol)
        ->where('article_languages.language_id', '=', $language_id_espanol)
        ->where('articles.is_open', '=', true)
        ->select('article_languages.document', 'articles.id', 'article_languages.slug', 'articles.only_file',
          'articles.edition','publications.id as idpubli','publications.name_es', 'publications.name_en',
          'articles.autor','article_languages.title','articles.published_at', 'article_columns.'.$campo.' as columna', 'publications.directory')
        ->orderBy('articles.published_at','desc')
        ->orderBy('articles.id','desc')
        ->take(7)
        ->get();

      $tags_relacionados = [];
      $ids_articulos_recientes = [];

      foreach ($articles as $key) {
          $doc =json_decode($key->document);
          foreach ($doc->tags as $tag) {
            $tags_relacionados[] = $tag->tag_id;
          }
          $ids_articulos_recientes[] = $key->id;
      }

      $articles_recomendados = Article::join('article_languages', 'article_languages.article_id' ,'=', 'articles.id')
        ->join('article_tags', 'article_tags.article_id', '=', 'articles.id')
        ->join('publications', 'publications.id', '=', 'articles.publication_id')
        ->leftjoin('article_columns', 'article_columns.id', '=', 'articles.column_id')
        ->accessprivate($rol)
        ->where('article_languages.language_id', '=', $language_id_espanol)
        ->where('articles.is_open', '=', true)
        ->whereIn('article_tags.tag_id', $tags_relacionados)
        ->whereNotIn('articles.id', $ids_articulos_recientes)
        ->select('article_languages.document', 'article_languages.title', 'articles.id','article_columns.'.$campo.' as columna', 'articles.autor','article_languages.slug', 'articles.only_file', 'articles.edition','publications.id as idpubli','publications.name_es', 'publications.name_en', 'publications.directory','articles.published_at')
        ->groupBy('article_languages.document', 'article_languages.title', 'articles.id','article_columns.'.$campo, 'articles.autor','article_languages.slug', 'articles.only_file', 'articles.edition','idpubli','publications.name_es', 'publications.name_en', 'publications.directory','articles.published_at')
        ->orderBy('articles.published_at','desc')
        ->orderBy('articles.id','desc')
        ->take(2)
        ->get();



      $articulos = Funciones::armarArticulo($articles, $campo, $ruta, $language_id);

      $articulos_recomendados = Funciones::armarArticulo($articles_recomendados, $campo, $ruta, $language_id);

      $sliders = Slider::leftjoin('slider_languages', 'slider_languages.slider_id', '=','sliders.id')
        ->where('slider_languages.language_id', '=', $language_id)
        ->orwhere('slider_languages.language_id', '=', null)
        ->orderBy('sliders.id')
        ->get();

      return view('front.index')
        ->with('tags', $all_tags)
        ->with('categories', $all_publicaciones)
        ->with('articulos', $articulos)
        ->with('articulos_recomendados', $articulos_recomendados)
        ->with('sliders', $sliders)
        ->with('ruta', $ruta);
    }
    /**
     * Remove floating boletin in the active session
     *
     * @return \Illuminate\Http\Response
     */
    public function removeboletin(Request $request)
    {
      \Session::put('boletin', 1);

    }
    /**
     * Remove floating notification type of cellphone in the active session
     *
     * @return \Illuminate\Http\Response
     */
    public function removenotification(Request $request)
    {
      \Session::put('notificationalert', 1);

    }
    /**
     * busqueda general por secciones - segunda versión
     *
     * @return \Illuminate\Http\Response
     */
    public function search($idioma='es',Request $request)
    {
      $language_id = Funciones::getIdIdioma($idioma);
      $language_id_espanol = 1;
      $ruta = Funciones::getRuta($idioma);
      $busqueda = $request->input('busqueda');
      $section = $request->input('section');
      $campo = Funciones::getCampoLang($language_id);
      $page = $request->input('page');

      $consulta_privacidad=' AND a.privacity = false';
      if(Auth::check()){
        $consulta_privacidad='';
      }


        switch ($section) {
          case 'foro':
            $data_foro = DB::table('seminars as s')->join('seminars_languages as sl', 'sl.seminar_id', '=', 's.id')
                      ->join('seminars_presentations as sp', 'sp.seminar_id', '=', 's.id')
                      ->where('sl.language_id', '=', 1)
                      ->where(function ($query) use($busqueda) {
                          $query->whereRaw("(LOWER(sl.title) like LOWER('%".$busqueda."%')")
                          ->orwhereRaw("(LOWER(sp.title) like LOWER('%".$busqueda."%'))")
                          ->orwhereRaw("(LOWER(sp.observation) like LOWER('%".$busqueda."%'))")
                          ->orwhereRaw("(LOWER(sp.theme) like LOWER('%".$busqueda."%')))");
                      })
                      ->select('s.id as id', DB::raw('1 as tipo'), DB::raw('0 as idpubli'), 'sp.file as ruta', 'sp.title as titulo', 'sp.theme as detalle', 's.date as fecha')
                      ->orderBy('fecha', 'DESC')
                      ->orderBy('id', 'DESC')
                      ->get();
                      // ->paginate(10);

            $data_secciones = [];
            $data_revistas = [];
            $data_semanarios = [];
            $data_active = array('foro'=>1,'web'=>0,'revista'=>0,'semanario'=>0, 'completo'=>1, );
            break;
          case 'revistas':
          $data_secciones = [];
          $data_foro=[];
          $data_revistas = DB::select("(SELECT a.id as id, 3 as tipo, a.publication_id as idpubli, al.file as ruta, al.title as titulo, al.abstract as detalle, a.published_at as fecha, acol.".$campo." as columna, p.".$campo." as publicacion, a.edition  FROM articles as a
                              JOIN article_languages as al ON a.id=al.article_id
                              JOIN publications as p ON p.id=a.publication_id
                              LEFT JOIN article_columns AS acol ON a.column_id=acol.id
                              WHERE al.language_id = ".$language_id_espanol."
                              and p.type_id = 3
                              and a.only_file = 1
                              and a.is_open = 1".$consulta_privacidad."
                              and ((LOWER(al.slug) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.title) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.content) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.theme) like LOWER('%".$busqueda."%'))
                              or (LOWER(a.observacion) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.abstract) like LOWER('%".$busqueda."%'))
                              or LOWER(concat(p.name_es,' ', a.edition)) like LOWER('%".$busqueda."%')
                              or LOWER(concat(p.name_en,' ', a.edition)) like LOWER('%".$busqueda."%')))

                    UNION ALL

                    (SELECT a.id as id, 4 as tipo, a.publication_id as idpubli,  al.slug as ruta, al.title as titulo, al.abstract as detalle, a.published_at as fecha, acol.".$campo." as columna, p.".$campo." as publicacion, a.edition  FROM articles as a
                              JOIN article_languages as al ON a.id=al.article_id
                              JOIN publications as p ON p.id=a.publication_id
                              LEFT JOIN article_columns AS acol ON a.column_id=acol.id
                              WHERE al.language_id = ".$language_id_espanol."
                              and p.type_id = 3
                              and a.only_file = 0
                              and a.is_open = 1".$consulta_privacidad."
                              and ((LOWER(al.slug) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.title) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.content) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.theme) like LOWER('%".$busqueda."%'))
                              or (LOWER(a.observacion) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.abstract) like LOWER('%".$busqueda."%'))
                              or LOWER(concat(p.name_es,' ', a.edition)) like LOWER('%".$busqueda."%')
                              or LOWER(concat(p.name_en,' ', a.edition)) like LOWER('%".$busqueda."%')))


                    ORDER BY fecha DESC, id DESC
                    ");
          // $slice = array_slice($data_revistas_all, $paginate * ($page - 1), $paginate);
          // // $result = new Paginator($slice , $paginate);
          //
          // $data_revistas = new Paginator($slice , $paginate);
          // $data_revistas->setPath(url('/busquedageneral'));
          // dd($data_revistas->toArray());
          $data_semanarios = [];
          $data_active = array('foro'=>0,'web'=>0,'revista'=>1,'semanario'=>0, 'completo'=>1);
            break;
          case 'web':
            $data_secciones = DB::select("(SELECT su.id as id, 2 as tipo, 0 as idpubli, 'eventos' as ruta, sul.name as titulo, sul.description as detalle, su.date as fecha, 1 as columna, 1 as publicacion, 1 as edition FROM summits as su
                      JOIN summit_languages as sul ON su.id=sul.summit_id
                      WHERE sul.language_id = ".$language_id_espanol."
                      and ((LOWER(sul.name) like LOWER('%".$busqueda."%'))
                      or (LOWER(sul.title) like LOWER('%".$busqueda."%'))
                      or (LOWER(sul.place) like LOWER('%".$busqueda."%'))
                      or (LOWER(sul.description) like LOWER('%".$busqueda."%'))))

                      UNION ALL

                      (SELECT a.id as id, 3 as tipo, a.publication_id as idpubli, al.file as ruta, al.title as titulo, al.abstract as detalle, a.published_at as fecha, acol.".$campo." as columna, p.".$campo." as publicacion, a.edition  FROM articles as a
                                JOIN article_languages as al ON a.id=al.article_id
                                JOIN publications as p ON p.id=a.publication_id
                                LEFT JOIN article_columns AS acol ON a.column_id=acol.id
                                WHERE al.language_id = ".$language_id_espanol."
                                and p.type_id=1
                                and a.only_file = 1
                                and a.is_open = 1".$consulta_privacidad."
                                and ((LOWER(al.slug) like LOWER('%".$busqueda."%'))
                                or (LOWER(al.title) like LOWER('%".$busqueda."%'))
                                or (LOWER(al.content) like LOWER('%".$busqueda."%'))
                                or (LOWER(al.theme) like LOWER('%".$busqueda."%'))
                                or (LOWER(a.observacion) like LOWER('%".$busqueda."%'))
                                or (LOWER(al.abstract) like LOWER('%".$busqueda."%'))
                                or LOWER(concat(p.name_es,' ', a.edition)) like LOWER('%".$busqueda."%')
                                or LOWER(concat(p.name_en,' ', a.edition)) like LOWER('%".$busqueda."%')))

                      UNION ALL

                      (SELECT a.id as id, 4 as tipo, a.publication_id as idpubli,  al.slug as ruta, al.title as titulo, al.abstract as detalle, a.published_at as fecha, acol.".$campo." as columna, p.".$campo." as publicacion, a.edition  FROM articles as a
                                JOIN article_languages as al ON a.id=al.article_id
                                JOIN publications as p ON p.id=a.publication_id
                                LEFT JOIN article_columns AS acol ON a.column_id=acol.id
                                WHERE al.language_id = ".$language_id_espanol."
                                and p.type_id=1
                                and a.only_file = 0
                                and a.is_open = 1".$consulta_privacidad."
                                and ((LOWER(al.slug) like LOWER('%".$busqueda."%'))
                                or (LOWER(al.title) like LOWER('%".$busqueda."%'))
                                or (LOWER(al.content) like LOWER('%".$busqueda."%'))
                                or (LOWER(al.theme) like LOWER('%".$busqueda."%'))
                                or (LOWER(a.observacion) like LOWER('%".$busqueda."%'))
                                or (LOWER(al.abstract) like LOWER('%".$busqueda."%'))
                                or LOWER(concat(p.name_es,' ', a.edition)) like LOWER('%".$busqueda."%')
                                or LOWER(concat(p.name_en,' ', a.edition)) like LOWER('%".$busqueda."%')))

                      ORDER BY fecha DESC, id DESC
                              ");
            $data_foro=[];
            $data_revistas = [];
            $data_semanarios = [];
            $data_active = array('foro'=>0,'web'=>1,'revista'=>0,'semanario'=>0, 'completo'=>1);
            break;
          case 'semanarios':
            $data_semanarios = DB::select("(SELECT a.id as id, 3 as tipo, a.publication_id as idpubli, al.file as ruta, al.title as titulo, al.abstract as detalle, a.published_at as fecha, acol.".$campo." as columna, p.".$campo." as publicacion, a.edition  FROM articles as a
                                JOIN article_languages as al ON a.id=al.article_id
                                JOIN publications as p ON p.id=a.publication_id
                                LEFT JOIN article_columns AS acol ON a.column_id=acol.id
                                WHERE al.language_id = ".$language_id_espanol."
                                and p.type_id = 2
                                and a.only_file = 1
                                and a.is_open = 1".$consulta_privacidad."
                                and ((LOWER(al.slug) like LOWER('%".$busqueda."%'))
                                or (LOWER(al.title) like LOWER('%".$busqueda."%'))
                                or (LOWER(al.content) like LOWER('%".$busqueda."%'))
                                or (LOWER(al.theme) like LOWER('%".$busqueda."%'))
                                or (LOWER(a.observacion) like LOWER('%".$busqueda."%'))
                                or (LOWER(al.abstract) like LOWER('%".$busqueda."%'))
                                or LOWER(concat(p.name_es,' ', a.edition)) like LOWER('%".$busqueda."%')
                                or LOWER(concat(p.name_en,' ', a.edition)) like LOWER('%".$busqueda."%')))

                      UNION ALL

                      (SELECT a.id as id, 4 as tipo, a.publication_id as idpubli,  al.slug as ruta, al.title as titulo, al.abstract as detalle, a.published_at as fecha, acol.".$campo." as columna, p.".$campo." as publicacion, a.edition  FROM articles as a
                                JOIN article_languages as al ON a.id=al.article_id
                                JOIN publications as p ON p.id=a.publication_id
                                LEFT JOIN article_columns AS acol ON a.column_id=acol.id
                                WHERE al.language_id = ".$language_id_espanol."
                                and p.type_id = 2
                                and a.only_file = 0
                                and a.is_open = 1".$consulta_privacidad."
                                and ((LOWER(al.slug) like LOWER('%".$busqueda."%'))
                                or (LOWER(al.title) like LOWER('%".$busqueda."%'))
                                or (LOWER(al.content) like LOWER('%".$busqueda."%'))
                                or (LOWER(al.theme) like LOWER('%".$busqueda."%'))
                                or (LOWER(a.observacion) like LOWER('%".$busqueda."%'))
                                or (LOWER(al.abstract) like LOWER('%".$busqueda."%'))
                                or LOWER(concat(p.name_es,' ', a.edition)) like LOWER('%".$busqueda."%')
                                or LOWER(concat(p.name_en,' ', a.edition)) like LOWER('%".$busqueda."%')))


                      ORDER BY fecha DESC, id DESC
                      ");
            $data_secciones = [];
            $data_foro=[];
            $data_revistas = [];
            $data_active = array('foro'=>0,'web'=>0,'revista'=>0,'semanario'=>1, 'completo'=>1);
          break;

          default:
          $data_foro = DB::select("(SELECT s.id as id, 1 as tipo, 0 as idpubli, sp.file as ruta, sp.title as titulo, sp.theme as detalle, s.date as fecha FROM seminars as s
                    JOIN seminars_languages as sl ON s.id=sl.seminar_id
                    JOIN seminars_presentations as sp ON s.id=sp.seminar_id
                    WHERE sl.language_id = 1
                    and ((LOWER(sl.title) like LOWER('%".$busqueda."%'))
                    or (LOWER(sp.title) like LOWER('%".$busqueda."%'))
                    or (LOWER(sp.observation) like LOWER('%".$busqueda."%'))
                    or (LOWER(sp.theme) like LOWER('%".$busqueda."%')))

                    ORDER BY fecha DESC, id DESC
                    LIMIT 3
                    )");

          $data_secciones = DB::select("(SELECT su.id as id, 2 as tipo, 0 as idpubli, 'eventos' as ruta, sul.name as titulo, sul.description as detalle, su.date as fecha, 1 as columna, 1 as publicacion, 1 as edition FROM summits as su
                    JOIN summit_languages as sul ON su.id=sul.summit_id
                    WHERE sul.language_id = ".$language_id_espanol."
                    and ((LOWER(sul.name) like LOWER('%".$busqueda."%'))
                    or (LOWER(sul.title) like LOWER('%".$busqueda."%'))
                    or (LOWER(sul.place) like LOWER('%".$busqueda."%'))
                    or (LOWER(sul.description) like LOWER('%".$busqueda."%'))))

                    UNION ALL

                    (SELECT a.id as id, 3 as tipo, a.publication_id as idpubli, al.file as ruta, al.title as titulo, al.abstract as detalle, a.published_at as fecha, acol.".$campo." as columna, p.".$campo." as publicacion, a.edition FROM articles as a
                              JOIN article_languages as al ON a.id=al.article_id
                              JOIN publications as p ON p.id=a.publication_id
                              LEFT JOIN article_columns AS acol ON a.column_id=acol.id
                              WHERE al.language_id = ".$language_id_espanol."
                              and p.type_id=1
                              and a.only_file = 1
                              and a.is_open = 1".$consulta_privacidad."
                              and ((LOWER(al.slug) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.title) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.content) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.theme) like LOWER('%".$busqueda."%'))
                              or (LOWER(a.observacion) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.abstract) like LOWER('%".$busqueda."%'))
                              or LOWER(concat(p.name_es,' ', a.edition)) like LOWER('%".$busqueda."%')
                              or LOWER(concat(p.name_en,' ', a.edition)) like LOWER('%".$busqueda."%')))

                    UNION ALL

                    (SELECT a.id as id, 4 as tipo, a.publication_id as idpubli,  al.slug as ruta, al.title as titulo, al.abstract as detalle, a.published_at as fecha, acol.".$campo." as columna, p.".$campo." as publicacion, a.edition FROM articles as a
                              JOIN article_languages as al ON a.id=al.article_id
                              JOIN publications as p ON p.id=a.publication_id
                              LEFT JOIN article_columns AS acol ON a.column_id=acol.id
                              WHERE al.language_id = ".$language_id_espanol."
                              and p.type_id=1
                              and a.only_file = 0
                              and a.is_open = 1".$consulta_privacidad."
                              and ((LOWER(al.slug) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.title) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.content) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.theme) like LOWER('%".$busqueda."%'))
                              or (LOWER(a.observacion) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.abstract) like LOWER('%".$busqueda."%'))
                              or LOWER(concat(p.name_es,' ', a.edition)) like LOWER('%".$busqueda."%')
                              or LOWER(concat(p.name_en,' ', a.edition)) like LOWER('%".$busqueda."%')))

                    ORDER BY fecha DESC
                    LIMIT 3
          ");

          $data_revistas = DB::select("(SELECT a.id as id, 3 as tipo, a.publication_id as idpubli, al.file as ruta, al.title as titulo, al.abstract as detalle, a.published_at as fecha, acol.".$campo." as columna, p.".$campo." as publicacion, a.edition  FROM articles as a
                              JOIN article_languages as al ON a.id=al.article_id
                              JOIN publications as p ON p.id=a.publication_id
                              LEFT JOIN article_columns AS acol ON a.column_id=acol.id
                              WHERE al.language_id = ".$language_id_espanol."
                              and p.type_id = 3
                              and a.only_file = 1
                              and a.is_open = 1".$consulta_privacidad."
                              and ((LOWER(al.slug) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.title) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.content) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.theme) like LOWER('%".$busqueda."%'))
                              or (LOWER(a.observacion) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.abstract) like LOWER('%".$busqueda."%'))
                              or LOWER(concat(p.name_es,' ', a.edition)) like LOWER('%".$busqueda."%')
                              or LOWER(concat(p.name_en,' ', a.edition)) like LOWER('%".$busqueda."%')))

                    UNION ALL

                    (SELECT a.id as id, 4 as tipo, a.publication_id as idpubli,  al.slug as ruta, al.title as titulo, al.abstract as detalle, a.published_at as fecha, acol.".$campo." as columna, p.".$campo." as publicacion, a.edition  FROM articles as a
                              JOIN article_languages as al ON a.id=al.article_id
                              JOIN publications as p ON p.id=a.publication_id
                              LEFT JOIN article_columns AS acol ON a.column_id=acol.id
                              WHERE al.language_id = ".$language_id_espanol."
                              and p.type_id = 3
                              and a.only_file = 0
                              and a.is_open = 1".$consulta_privacidad."
                              and ((LOWER(al.slug) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.title) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.content) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.theme) like LOWER('%".$busqueda."%'))
                              or (LOWER(a.observacion) like LOWER('%".$busqueda."%'))
                              or (LOWER(al.abstract) like LOWER('%".$busqueda."%'))
                              or LOWER(concat(p.name_es,' ', a.edition)) like LOWER('%".$busqueda."%')
                              or LOWER(concat(p.name_en,' ', a.edition)) like LOWER('%".$busqueda."%')))


                    ORDER BY fecha DESC, id DESC
                    LIMIT 3
                    ");

              $data_semanarios = DB::select("(SELECT a.id as id, 3 as tipo, a.publication_id as idpubli, al.file as ruta, al.title as titulo, al.abstract as detalle, a.published_at as fecha, acol.".$campo." as columna, p.".$campo." as publicacion, a.edition  FROM articles as a
                                  JOIN article_languages as al ON a.id=al.article_id
                                  JOIN publications as p ON p.id=a.publication_id
                                  LEFT JOIN article_columns AS acol ON a.column_id=acol.id
                                  WHERE al.language_id = ".$language_id_espanol."
                                  and p.type_id = 2
                                  and a.only_file = 1
                                  and a.is_open = 1".$consulta_privacidad."
                                  and ((LOWER(al.slug) like LOWER('%".$busqueda."%'))
                                  or (LOWER(al.title) like LOWER('%".$busqueda."%'))
                                  or (LOWER(al.content) like LOWER('%".$busqueda."%'))
                                  or (LOWER(al.theme) like LOWER('%".$busqueda."%'))
                                  or (LOWER(a.observacion) like LOWER('%".$busqueda."%'))
                                  or (LOWER(al.abstract) like LOWER('%".$busqueda."%'))
                                  or LOWER(concat(p.name_es,' ', a.edition)) like LOWER('%".$busqueda."%')
                                  or LOWER(concat(p.name_en,' ', a.edition)) like LOWER('%".$busqueda."%')))

                        UNION ALL

                        (SELECT a.id as id, 4 as tipo, a.publication_id as idpubli,  al.slug as ruta, al.title as titulo, al.abstract as detalle, a.published_at as fecha, acol.".$campo." as columna, p.".$campo." as publicacion, a.edition  FROM articles as a
                                  JOIN article_languages as al ON a.id=al.article_id
                                  JOIN publications as p ON p.id=a.publication_id
                                  LEFT JOIN article_columns AS acol ON a.column_id=acol.id
                                  WHERE al.language_id = ".$language_id_espanol."
                                  and p.type_id = 2
                                  and a.only_file = 0
                                  and a.is_open = 1".$consulta_privacidad."
                                  and ((LOWER(al.slug) like LOWER('%".$busqueda."%'))
                                  or (LOWER(al.title) like LOWER('%".$busqueda."%'))
                                  or (LOWER(al.content) like LOWER('%".$busqueda."%'))
                                  or (LOWER(al.theme) like LOWER('%".$busqueda."%'))
                                  or (LOWER(a.observacion) like LOWER('%".$busqueda."%'))
                                  or (LOWER(al.abstract) like LOWER('%".$busqueda."%'))
                                  or LOWER(concat(p.name_es,' ', a.edition)) like LOWER('%".$busqueda."%')
                                  or LOWER(concat(p.name_en,' ', a.edition)) like LOWER('%".$busqueda."%')))


                        ORDER BY fecha DESC, id DESC
                        LIMIT 3
                        ");
                $data_active = array('foro'=>1,'web'=>1,'revista'=>1,'semanario'=>1, 'completo'=>0);
            break;
        }


        return view('front.busquedageneral')
          ->with('data_active', $data_active)
          ->with('data_foro', $data_foro)
          ->with('data_revistas', $data_revistas)
          ->with('data_semanarios', $data_semanarios)
          ->with('data_secciones', $data_secciones)
          ->with('ruta', $ruta)
          ->with('language_id', $language_id)
          ->with('busqueda', $busqueda);

    }
    /**
     * busqueda general todo junto - primera versión
     *
     * @return \Illuminate\Http\Response
     */
    public function searchAlltogether($idioma='es',Request $request)
    {
      $language_id = Funciones::getIdIdioma($idioma);
      $ruta = Funciones::getRuta($idioma);
      $busqueda = $request->input('busqueda');

      $data = DB::select("(SELECT s.id as id, 1 as tipo, 0 as idpubli, sp.file as ruta, sp.title as titulo, sp.theme as detalle, s.date as fecha FROM seminars as s
                JOIN seminars_languages as sl ON s.id=sl.seminar_id
                JOIN seminars_presentations as sp ON s.id=sp.seminar_id
                WHERE sl.language_id = 1
                and ((LOWER(sl.title) like LOWER('%".$busqueda."%'))
                or (LOWER(sp.title) like LOWER('%".$busqueda."%'))
                or (LOWER(sp.observation) like LOWER('%".$busqueda."%'))
                or (LOWER(sp.theme) like LOWER('%".$busqueda."%'))))

                UNION ALL

                (SELECT su.id as id, 2 as tipo, 0 as idpubli, 'eventos' as ruta, sul.name as titulo, sul.description as detalle, su.date as fecha FROM summits as su
                          JOIN summit_languages as sul ON su.id=sul.summit_id
                          WHERE sul.language_id = ".$language_id."
                          and ((LOWER(sul.name) like LOWER('%".$busqueda."%'))
                          or (LOWER(sul.title) like LOWER('%".$busqueda."%'))
                          or (LOWER(sul.place) like LOWER('%".$busqueda."%'))
                          or (LOWER(sul.description) like LOWER('%".$busqueda."%'))))

                UNION ALL

                (SELECT a.id as id, 3 as tipo, a.publication_id as idpubli, al.file as ruta, al.title as titulo, al.abstract as detalle, a.published_at as fecha  FROM articles as a
                          JOIN article_languages as al ON a.id=al.article_id
                          JOIN publications as p ON p.id=a.publication_id
                          WHERE al.language_id = ".$language_id."
                          and a.only_file = 1
                          and a.is_open = 1
                          and ((LOWER(al.slug) like LOWER('%".$busqueda."%'))
                          or (LOWER(al.title) like LOWER('%".$busqueda."%'))
                          or (LOWER(al.content) like LOWER('%".$busqueda."%'))
                          or (LOWER(al.theme) like LOWER('%".$busqueda."%'))
                          or (LOWER(a.observacion) like LOWER('%".$busqueda."%'))
                          or (LOWER(al.abstract) like LOWER('%".$busqueda."%'))
                          or LOWER(concat(p.name_es,' ', a.edition)) like LOWER('%".$busqueda."%')
                          or LOWER(concat(p.name_en,' ', a.edition)) like LOWER('%".$busqueda."%')))

                UNION ALL

                (SELECT a.id as id, 4 as tipo, a.publication_id as idpubli,  al.slug as ruta, al.title as titulo, al.abstract as detalle, a.published_at as fecha  FROM articles as a
                          JOIN article_languages as al ON a.id=al.article_id
                          JOIN publications as p ON p.id=a.publication_id
                          WHERE al.language_id = ".$language_id."
                          and a.only_file = 0
                          and a.is_open = 1
                          and ((LOWER(al.slug) like LOWER('%".$busqueda."%'))
                          or (LOWER(al.title) like LOWER('%".$busqueda."%'))
                          or (LOWER(al.content) like LOWER('%".$busqueda."%'))
                          or (LOWER(al.theme) like LOWER('%".$busqueda."%'))
                          or (LOWER(a.observacion) like LOWER('%".$busqueda."%'))
                          or (LOWER(al.abstract) like LOWER('%".$busqueda."%'))
                          or LOWER(concat(p.name_es,' ', a.edition)) like LOWER('%".$busqueda."%')
                          or LOWER(concat(p.name_en,' ', a.edition)) like LOWER('%".$busqueda."%')))

                ORDER BY fecha DESC
                ");

        return view('front.busquedageneral')
          ->with('data', $data)
          ->with('ruta', $ruta)
          ->with('busqueda', $busqueda);

    }
    /**
     * Store subscriber
     *
     * @return \Illuminate\Http\Response
     */
    public function storeSubscriber(Request $request)
    {
      $email = $request->input('email');
      $existe = Subscriber::where('email', '=', $email)->first();

      if(!$existe){
        $subscriber = new Subscriber();
        $subscriber->email = $email;
        $subscriber->save();
      }
      return redirect()->back()->with('success_subscription', 'success');
    }

    public function nosotros()
    {
      return view('front.index');
    }
    public function mail(Request $request)
    {
        $acepta = 0;
        if($request->input('datos_accept')){
          $acepta = 1;
        }

        $rules = [
          'g-recaptcha-response' => 'required|captcha'
        ];

        $validation = Validator::make($request->all(), $rules);
        // if validation fails
        if($validation->fails())
        {
            return redirect()->back()->with('captchavalidacion','contacto')->withInput();
        }

        $contacto = new Contact();
        $contacto->name = $request->input('nombre');
        $contacto->phone = $request->input('telefono');
        $contacto->email = $request->input('email');
        $contacto->company = $request->input('empresa');
        $contacto->message = $request->input('mensaje');
        $contacto->authorize = $acepta;
        $contacto->save();

        $data = array('nombre'=> $request->input('nombre'),
            'email'=> $request->input('email'),
            'telefono'=> $request->input('telefono'),
            'empresa'=> $request->input('empresa'),
            'mensaje'=> $request->input('mensaje'),
            'autoriza' => $acepta
            );
        // Path or name to the blade template to be rendered
        $template_path = 'mails.contacto';

        Mail::send($template_path, $data, function($message) {
            // Set the receiver and subject of the mail.
            $message->to('jbernilla@comexperu.org.pe', 'Contacto')->subject('Contacto COMEXPERU');
            // Set the sender
            $message->from('jbernilla@comexperu.org.pe','usuario');
        });
        return redirect()->back()->with('status', 'OK');
    }

    //devuelve ultimos 5 articulos en json
    function articulosJson()
    {
      $rol = 0;
      if(Auth::check()){
        $rol = Auth::user()->rol_id;

      }

      $language_id_espanol = 1;

      $json= [];

      $articles = Article::join('article_languages', 'article_languages.article_id' ,'=', 'articles.id')
        ->join('publications', 'publications.id', '=', 'articles.publication_id')
        ->accessprivate($rol)
        ->where('article_languages.language_id', '=', $language_id_espanol)
        ->where('articles.is_open', '=', true)
        ->select('article_languages.abstract', 'articles.id', 'article_languages.slug', 'articles.only_file',
          'article_languages.title', 'articles.cover', 'articles.publication_id', 'publications.directory', 'article_languages.file')
        ->orderBy('articles.published_at','desc')
        ->orderBy('articles.id','desc')
        ->take(5)
        ->get();

        foreach ($articles as $key) {

          $data['titulo'] = $key->title;
          $data['contenido'] = $key->abstract;
          $data['url_imagen'] = url('upload/articles/'.$key->directory.'/'.$key->cover);
          if($key->only_file==1){
              $data['url_web'] = url('upload/articles/'.$key->directory.'/'.$key->file);
          }

          else{
            $data['url_web'] = url('/articulo/'.$key->slug);
          }

          $json[] = $data;

        }

        return json_encode($json);
    }
    public function emailEvento()
    {
        return view('mails.confirmacionevento');
    }
    public function mantenimiento()
    {
        return view('front.mantenimiento');
    }
}
