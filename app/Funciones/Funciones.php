<?php
namespace App\Funciones;

use App\Article;
use App\ArticleLanguage;
use App\ArticleCategory;
use App\ArticleTag;
use App\Publication;
use App\Tag;
use App\Slider;
use Auth;
use App\User;
use App\Seminar;
use App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class Funciones
{
  static function getRuta($idioma)
  {
    App::setLocale($idioma);
    if($idioma=='en'){

      $ruta = $idioma;
    }
    else{
      $idioma='';
      $ruta = '';

    }

    return $ruta;
  }
  static function getIdIdioma($idioma)
  {
    if($idioma=='es' || $idioma==''){
      $language_id = 1;
    }
    else{
      $language_id = 2;
    }
    return $language_id;
  }
  function generateDocumentArticle($id_article, $id_language, $article_lang_id, $title,$content, $abstract,  $leyend, $source, $file)
  {
    $item = Article::find($id_article);
    $json['id'] = $item->id;
    $json['open'] = $item->is_open;
    $json['has_languages'] = $item->has_languages;
    $json['created_by'] = $item->created_by;
    $json['published_at'] = $item->published_at;
    $json['cover'] = $item->cover;

    $json['language_id'] = $article_lang_id;
    $json['title'] = $title;
    $json['abstract'] = $abstract;
    $json['content'] = $content;
    $json['leyend'] = $leyend;
    $json['source'] = $source;
    $json['file'] = $file;

    $json['publication'] = [];
    $json['tags'] = [];

    $campo = Funciones::getCampoLang($id_language);

    $publication = Publication::where('id', '=', $item->publication_id)->first();

    if($publication){
      $data = array(
        'publication_id'=> $publication->id,
        'publication_name' =>$publication->$campo

      );
      $json['publication'][]=$data;
    }

    $tags = ArticleTag::join('tags', 'tags.id', '=', 'article_tags.tag_id')
      ->where('article_id', '=', $id_article)
      ->select('article_tags.tag_id', 'tags.name_es', 'tags.name_en')
      ->get();

    foreach ($tags as $key) {
      $data = array(
        'tag_id'=> $key->tag_id,
        'tag_name' =>$key->$campo

      );
      $json['tags'][]=$data;
    }

    return json_encode($json);
  }
  function sanear_string($cadena) {

       $string = $cadena;

       $string = str_replace(
           array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
           array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
           $string
       );

       $string = str_replace(
           array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
           array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
           $string
       );

       $string = str_replace(
           array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
           array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
           $string
       );

       $string = str_replace(
           array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
           array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
           $string
       );

       $string = str_replace(
           array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
           array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
           $string
       );

       $string = str_replace(
           array('ñ', 'Ñ', 'ç', 'Ç'),
           array('n', 'N', 'c', 'C'),
           $string
       );

       $string = str_replace(
           array(','),
           array(''),
           $string
       );

       $string = str_replace(
           array( "º", "~",
                "#", "@", "|", "!", '"',
                "·", "$", "%", "&", "/",
                "(", ")", "?", "'", "¡",
                "¿", "[", "^", "<code>", "]",
                "+", "}", "{", "¨", "´",
                ">", "<", ";", ",", ":",
                "."),
           '',
           $string
       );


       $textoLimpio = $string;
       // ***************************

       $textoLimpio =strtolower($textoLimpio);
       return trim($textoLimpio);
     }
     function simplicar_string($cadena){
       $texto = $this->sanear_string($cadena);
       $texto_cambiado = str_replace(" ", "-", $texto);

       return $texto_cambiado;
     }

     function saveImage($filename, $directory)
     {
       if (Input::hasFile($filename))
       {

          $fullName = Input::file($filename)->getClientOriginalName();
 					$extension = Input::file($filename)->getClientOriginalExtension();

 					$fullNameLength = strlen($fullName);

 					$extensionLength = strlen($extension);
 					$nameLength = $fullNameLength - ($extensionLength + 1);
 					$onlyName = substr($fullName, 0, $nameLength);
 					$onlyName = Funciones::simplicar_string($onlyName);
 					$maxlength = 180 - ($extensionLength+1);
          $name_of_file = substr($onlyName,0,$maxlength). '-' .date('dmy') . '-' . date('his'). '.' .$extension;
 					$name = $directory.$name_of_file;
          $f = Input::file($filename)->move($directory, $name);

          return $name_of_file;
       }
       return '';
     }
     function saveFile($filename, $directory)
     {
       if (Input::hasFile($filename))
       {

          $fullName = Input::file($filename)->getClientOriginalName();
 					$extension = Input::file($filename)->getClientOriginalExtension();

 					$fullNameLength = strlen($fullName);

 					$extensionLength = strlen($extension);
 					$nameLength = $fullNameLength - ($extensionLength + 1);
 					$onlyName = substr($fullName, 0, $nameLength);
 					$onlyName = Funciones::simplicar_string($onlyName);
 					$maxlength = 234 - ($extensionLength+1);
          $name_of_file = substr($onlyName,0,$maxlength). '.' .$extension;
 					$name = $directory.$name_of_file;
          $f = Input::file($filename)->move($directory, $name);

          return $name_of_file;
       }
       return '';
     }
     public static function myTruncate($string, $limit, $break='.', $pad=' ...') {
       $string = strip_tags($string);
        if(strlen($string) <= $limit)
        return $string;
        if(false !== ($breakpoint = strpos($string, $break, $limit))) {
          if($breakpoint < strlen($string)-1) {
            $string = substr($string, 0, $breakpoint) . $pad;
          }
        }
        return $string;
    }
    static function getNameDay($day, $language_id)
    {
      if($day)
      {
        $dias_es=array(0=>"Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
        $dias_en=array(0=>"Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");

        if($language_id==2){
          return $dias_en[$day];
        }
        else{
          return $dias_es[$day];
        }
      }
      return '';

    }
    static function formatTime($time)
    {
      if($time)
      {
        $hora = strtotime($time );
        return date("g:i a", $hora);
      }
      return '';
    }
    static function getNameMonth($month, $language_id)
    {
      if($month>0)
      {
        $meses_es = array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
                  "Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $meses_en=array(1=>"January","February","March","April","May","June","July",
                  "August", "September", "October", "November", "December");

        if($language_id==2){
          return $meses_en[$month];
        }
        else{
          return $meses_es[$month];
        }
      }
      else{
        return '';
      }

    }
    static function getDateString($fecha, $language_id)
    {
       if($fecha)
       {
         $date = strtotime($fecha);
         $ano = date('Y', $date);
         $mes = date('n',$date);
         $dia = date('d',$date);
         $meses_es=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
                   "Agosto","Septiembre","Octubre","Noviembre","Diciembre");
         $meses_en=array(1=>"January","February","March","April","May","June","July",
                             "August", "September", "October", "November", "December");

         if($language_id==2){
           return $meses_en[$mes]." ".$dia .", ".$ano;
         }
         else{
           return $meses_es[$mes]." ".$dia .", ".$ano;
         }
       }
       else{
         return '';
       }
     }
     function getTags($language_id, $tags_selected)
     {
       $campo = Funciones::getCampoLang($language_id);

       //$tags_selected = \Session::get('tags');
       $tags = Tag::select("$campo as name", "id")->get();
       $all_tags = [];
       if(!isset($tags_selected)){
         $tags_selected = [];
       }
       foreach ($tags as $key) {
         if(in_array($key->id, $tags_selected)){
           $item['id']=$key->id;
           $item['name'] = $key->name;
           $item['active'] = 'filtro-lista-active';
           $item['input_active'] = $key->id;
         }
         else{
           $item['id']=$key->id;
           $item['name'] = $key->name;
           $item['active'] = '';
          $item['input_active'] = '';
         }
         array_push($all_tags, $item);
       }



       return $all_tags;
     }
     function getPublicaciones($language_id, $publicaciones_selected, $rol)
     {
       $campo = Funciones::getCampoLang($language_id);

       //$publicaciones_selected = \Session::get('publicaciones');
       $publicaciones = Publication::select("$campo as name", "id")
        ->accessprivate($rol)
        ->get();

       $all_publicaciones = [];
       if(!isset($publicaciones_selected)){
         $publicaciones_selected = [];
       }
       foreach ($publicaciones as $key) {
         if(in_array($key->id, $publicaciones_selected)){
           $item['id']=$key->id;
           $item['name'] = $key->name;
           $item['active'] = 'lista-ver-active';
           $item['input_active'] = $key->id;
         }
         else{
           $item['id']=$key->id;
           $item['name'] = $key->name;
           $item['active'] = '';
           $item['input_active'] = '';
         }
         array_push($all_publicaciones, $item);
       }

       return $all_publicaciones;
     }
     public function getlanguage()
     {
       $idioma['id'] = 1;
       $idioma['siglas'] = 'es';
       //dd(\Session::get('language'));
       if(\Session::has('language')){
         if(\Session::get('language')!='es'){
           $idioma['siglas'] = 'en';
           $idioma['id'] = 2;
         }

       }
       return $idioma;
     }
    public static function getCampoLang($language_id)
    {
      if($language_id==1){
        $campo = 'name_es';
      }
      else{
        $campo = 'name_en';
      }
      return $campo;
    }
    public function armarArticulo($articles, $campo, $ruta, $language_id)
    {

      $articulos = [];
      foreach ($articles as $key) {
        $doc =json_decode($key->document);

        if($key->only_file==1){
            $data['link'] = url('upload/articles/'.$key->directory.'/'.$doc->file);
        }

        else{
          $data['link'] = url($ruta.'/articulo/'.$key->slug);
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

        $data['id'] = $doc->id;

        $data['edition'] = $key->edition;
        $data['id_publications'] = $key->idpubli;
        if($ruta=="en"){
          $data['publications'] = $key->name_en;
        }else{
          $data['publications'] = $key->name_es;
        }

        $data['linkpublic'] = url($ruta.'/publicaciones?id='.$data['id_publications'].'&publicacion='.  $data['publications'].'&edicion='.$data['edition']);

        $data['columna'] = '';
        if($key->columna){
          $data['columna'] = ' - '.$key->columna;
        }

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
        $articulos[]=$data;
      }
      return $articulos;
    }
    public function getSeminarByMonth($month, $year, $language_id){

      $seminarios_format=[];

      $seminarios = Seminar::join('seminars_languages', 'seminars_languages.seminar_id', '=', 'seminars.id')
          ->where('seminars.month', '=', $month)
          ->where('seminars.year', '=', $year)
          ->where('seminars_languages.language_id', '=', $language_id)
          ->where('seminars.active', '=', 1)
          ->select('seminars.date','seminars.day','seminars.month','seminars_languages.place','seminars_languages.title','seminars_languages.file')
          ->orderBy('seminars.day','asc')
          ->get();

      foreach ($seminarios as $key) {
        $key_date = strtotime($key->date);

        if(isset($key->file) && $key->file!=''){
          $data['file'] = url('upload/seminars/'.$key->file);
        }
        else {
          $data['file'] = '';
        }

        $data['day_name'] = Funciones::getNameDay(date('w', $key_date), $language_id);
        $data['day'] = $key->day;
        $data['month'] = $key->month;
        $data['name'] = $key->title;
        $data['place'] = $key->place;

        $seminarios_format[]=$data;
      }
      return $seminarios_format;
    }
    static function getUrl($tipo, $ruta, $idpubli, $idioma)
    {
      switch ($tipo) {
        case 1:
           return url('upload/seminars/foro/'.$ruta);
          break;
        case 2:
           return url($idioma.'/eventos#cumbres');
          break;
        case 3:
          $publi = Publication::where('id', '=', $idpubli)->first();
           return url('upload/articles/'.$publi->directory.'/'.$ruta);
          break;
        case 4:
         return url($idioma.'/articulo/'.$ruta);
          break;
        default:
          return '';
          break;
      }
    }
    function getTipoBusqueda($tipo, $idpubli, $idioma)
    {
      if($idioma == 'en'){
        $campo='name_en';
      }
      else{
        $campo='name_es';
      }

      switch ($tipo) {
        case 1:
            if($idioma == 'en'){
              return 'Seminars';
            }
            else{
              return 'Foro';
            }

          break;
        case 2:
            if($idioma == 'en'){
              return 'Entrepreneurial Summits';
            }
            else{
              return 'Cumbres empresariales';
            }

          break;
        case 3:
          if($idioma == 'en'){
            return 'Publications';
          }
          else{
            return 'Publicaciones';
          }

          // $publi = Publication::where('id', '=', $idpubli)->first();
          //  return $publi->$campo;
          break;
        case 4:
        if($idioma == 'en'){
          return 'Publications';
        }
        else{
          return 'Publicaciones';
        }
        // $publi = Publication::where('id', '=', $idpubli)->first();
        //  return $publi->$campo;
        break;
        default:
          return '';
          break;
      }
    }

    // public function tipoArchivo($nombreArchivo)
    // {
    //   $array = explode('.', $nombreArchivo);
    //   $ext = trim(end($array));
    //
    //   switch ($ext) {
    //
    //     case 'pdf':
    //       return url('/images/iconopdf.png');
    //       break;
    //     case 'ppt':
    //       return url('/images/ppt.jpg');
    //       break;
    //
    //     default:
    //       return $ext;
    //       break;
    //   }
    // }
    static function getAllStringDate($fecha, $language_id)
    {
       if($fecha)
       {
         $date = strtotime($fecha);
         $ano = date('Y', $date);
         $mes = date('n',$date);
         $dia = date('d',$date);
         $meses_es=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
                   "Agosto","Septiembre","Octubre","Noviembre","Diciembre");
         $meses_en=array(1=>"January","February","March","April","May","June","July",
                             "August", "September", "October", "November", "December");

         if($language_id==2){
           return $meses_en[$mes]." ".$dia .", ".$ano;
         }
         else{
           return $dia ." de ".$meses_es[$mes]. " del ".$ano;
         }
       }
       else{
         return '';
       }
     }

    /*******FUNCIONES IPHONE APP*********/
    static function getPublicacionesApi($language_id, $rol)
    {
      $campo = Funciones::getCampoLang($language_id);

      $publicaciones = Publication::select("$campo as name", "id")
       ->accessprivate($rol)
       ->get();

       $all_publicaciones = [];

      foreach ($publicaciones as $key) {
          $item['id']=$key->id;
          $item['name'] = $key->name;

        array_push($all_publicaciones, $item);
      }

      return $all_publicaciones;
    }
    static function getTagsApi($language_id)
    {
      $campo = Funciones::getCampoLang($language_id);

      //$tags_selected = \Session::get('tags');
      $tags = Tag::select("$campo as name", "id")->get();
      $all_tags = [];

      foreach ($tags as $key) {

          $item['id']=$key->id;
          $item['name'] = $key->name;

          array_push($all_tags, $item);
      }

      return $all_tags;
    }
    static function getSliderApi($language_id)
    {
      $sliders = Slider::leftjoin('slider_languages', 'slider_languages.slider_id', '=','sliders.id')
        ->where('slider_languages.language_id', '=', $language_id)
        ->orwhere('slider_languages.language_id', '=', null)
        ->get();

      $data = [];
      foreach ($sliders as $key) {
        $item['title']=$key->title;
        $item['text'] = $key->text;
        $item['url'] = $key->url;
        $item['button_text'] = $key->button_text;
        if($key->image && $key->image!=""){
          $item['image'] = url('/upload/sliders/'.$key->image);
        }
        else{
            $item['image'] = "";
        }


        array_push($data, $item);
      }

      return $data;
    }
    static function armarArticuloApi($articles, $campo, $ruta, $language_id)
    {

      $articulos = [];
      foreach ($articles as $key) {
        $doc =json_decode($key->document);
        $data['file'] = '';
        if($key->only_file==1){
            $data['file'] = url('upload/articles/'.$key->directory.'/'.$doc->file);
        }
        $data['title'] = $key->title;
        if($doc->abstract && $doc->abstract!='null'){
          $data['abstract'] = $doc->abstract;
        }
        else{
          $data['abstract'] = '';
        }
        $data['slug'] = $key->slug;
        if($doc->cover && $doc->cover!='')
        {
          $data['image'] = url('upload/images/'.$doc->cover);
        }
        else{
          $data['image'] = "";
        }

        $data['id'] = $key->id;

        $data['edition'] = $key->edition;
        $data['id_publication'] = $key->idpubli;
        if($ruta=="en"){
          $data['publication'] = $key->name_en;
        }else{
          $data['publication'] = $key->name_es;
        }
        $data['column'] = $key->columna;
        $data['autor'] = $key->autor;
        $data['only_file'] = $key->only_file;
        $data['date'] = Funciones::getDateString($key->published_at, $language_id);

        $articulos[]=$data;
      }
      return $articulos;
    }



}
