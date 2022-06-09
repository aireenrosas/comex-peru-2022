<?php

use Illuminate\Http\Request;
use App\User;
use App\Funciones\Funciones;
use App\Article;
use App\ArticleTag;
use App\Seminar;
use App\Summit;
use App\Logs;
use App\Publication;
use App\Inscription;
use App\SemanarioSubscription;
use App\DatacomexSubscription;
use App\NegociosSubscription;
use Illuminate\Support\Facades\Hash;
use App\Contact;
use Illuminate\Support\Facades\Mail;
use App\Subscriber;
use App\TradeBarrier;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/save-subscription',function(Request $request){
  if(\Auth::check()){
    $id = \Auth::user()->id;
    $json = json_decode($request->input('json'));
    $keys = $json->keys;
    $user = \App\User::findOrFail($id);
    //return json_encode($user);
    $user->updatePushSubscription($json->endpoint, $keys->p256dh, $keys->auth);

    $user->notify(new \App\Notifications\GenericNotification("Bienvenido a COMEXPERÚ", "Usted recibirá nuestras notificaciones.",url('/articulos')));
    return response()->json([
      'success' => true
    ]);
  }
  else{
    $id = 553;//PUBLICUSER
    $json = json_decode($request->input('json'));
    $keys = $json->keys;
    $user = \App\User::findOrFail($id);
    //return json_encode($user);
    $user->updatePushSubscription($json->endpoint, $keys->p256dh, $keys->auth);
  }

});
Route::post('/send-notification', function(Request $request){
    $suscriptores = \App\PushSubscription::select('user_id')->groupBy('user_id')->get();

    foreach ($suscriptores as $key) {
      $user = \App\User::findOrFail($key->user_id);
      $user->notify(new \App\Notifications\GenericNotification($request->title, $request->body, $request->url));

    }
    $suscriptores_ios = \App\KeyIos::get();
    // $urls = explode('/',$request->url);
    // $conturl = sizeof($urls);
    // $idSlug =\App\ArticleLanguage::select('article_id')->where('slug', '=', $urls[$conturl-1])->orderBy('id','DESC')->first();
    //$tHost = 'gateway.sandbox.push.apple.com';
    $tHost = 'gateway.push.apple.com';
    $tPort = 2195;

    $tCert = 'ic/cert.pem';
    $tPassphrase = '';
    $tAlert = $request->title.' '.$request->body;
    $tBadge = 0;
    $tSound = 'default';
    $tPayload = "articulos/";
    $tBody['aps'] = array (
    'alert' => $tAlert,
    'badge' => $tBadge,
    'sound' => $tSound,
    );
    $tBody ['payload'] = $tPayload;
    $tBody = json_encode ($tBody);
    $tContext = stream_context_create ();
    stream_context_set_option ($tContext, 'ssl', 'local_cert', $tCert);
    stream_context_set_option ($tContext, 'ssl', 'passphrase', $tPassphrase);
    $tSocket = stream_socket_client ('ssl://'.$tHost.':'.$tPort, $error, $errstr, 30, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $tContext);
    if (!$tSocket)
    exit ("APNS Connection Failed: $error $errstr" . PHP_EOL);

    $tResult = false;

    foreach ($suscriptores_ios as $susp) {

      $tMsg = chr (0) . chr (0) . chr (32) . pack ('H*', $susp->token) . pack ('n', strlen ($tBody)) . $tBody;
      $tResult = fwrite ($tSocket, $tMsg, strlen ($tMsg));
    }
    if ($tResult)
    echo 'Delivered Message to APNS' . PHP_EOL;
    else
    echo 'Could not Deliver Message to APNS' . PHP_EOL;
    fclose ($tSocket);

  return response()->json([
    'success' => true
    // ,'url'=>$urls[$conturl-1]
  ]);

});
Route::post('/login', function(Request $request){
  header('Access-Control-Allow-Origin: *');
  header('Content-type: application/json');

  $username = $request->input('username');
  $password = $request->input('password');

  if($username && $username!=""){
    $user = User::whereRaw("(LOWER(login) = LOWER('".$username."'))")->first();
    if($user){
      if (Hash::check($request->input('password'), $user->password))
    	{
        $logs = new Logs();
        $logs->id_users = $user->id;
        $logs->save();
        return response()->json([
          'success' => true,
          'user_id' => $user->id,
        ]);
      }
      else{
        return response()->json([
          'success' => false
        ]);
      }
    }
    else{
      return response()->json([
        'success' => false
      ]);
    }
  }
  else{
    return response()->json([
      'success' => false
    ]);
  }



});
Route::get('/home', function(Request $request){

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    $rol = 0;
    $user_id = $request->input('user');
    $idioma = $request->input('idioma');
    if($user_id!='0'){
      $usuario = User::where('id', '=', $user_id)->first();
      if($usuario){
        $rol = $usuario->rol_id;
      }
    }

    $language_id = Funciones::getIdIdioma($idioma);
    $language_id_espanol = 1;
    $ruta = Funciones::getRuta($idioma);

    $all_tags = Funciones::getTagsApi($language_id);
    $all_publicaciones = Funciones::getPublicacionesApi($language_id, $rol);

    $campo = Funciones::getCampoLang($language_id);

    $articles = Article::join('article_languages', 'article_languages.article_id' ,'=', 'articles.id')
      ->join('publications', 'publications.id', '=', 'articles.publication_id')
      ->leftjoin('article_columns', 'article_columns.id', '=', 'articles.column_id')
      ->accessprivate($rol)
      ->where('article_languages.language_id', '=', $language_id_espanol)
      ->where('articles.is_open', '=', true)
      ->select('article_languages.document', 'articles.id', 'article_languages.slug', 'articles.only_file',
        'articles.edition','publications.id as idpubli','publications.name_es', 'publications.name_en',
        'articles.autor','article_languages.title', 'article_columns.'.$campo.' as columna', 'publications.directory','articles.published_at')
      ->orderBy('articles.published_at','desc')
      ->orderBy('articles.id','desc')
      ->take(7)
      ->get();

    $articulos = Funciones::armarArticuloApi($articles, $campo, $ruta, $language_id);

    $sliders = Funciones::getSliderApi($language_id);

    $json = [];
    $json['publicaciones'] = $all_publicaciones;
    $json['tags'] = $all_tags;
    $json['articulos'] = $articulos;
    $json['sliders'] = $sliders;

    return json_encode($json);

});
Route::get('/getarticles', function(Request $request){

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    $rol = 0;
    $user_id = $request->input('user');
    if($user_id!='0'){
      $usuario = User::where('id', '=', $user_id)->first();
      if($usuario){
        $rol = $usuario->rol_id;
      }
    }
    $idioma = $request->input('idioma');
    $language_id = Funciones::getIdIdioma($idioma);
    $language_id_espanol = 1;
    $keyword = $request->input('keyword');
    $tags = $request->input('tags');
    $fecha = $request->input('fecha');
    $campo = Funciones::getCampoLang($language_id);
    $ruta = Funciones::getRuta($idioma);
    //\Session::put('tags', $tags);

    $publicaciones = $request->input('publicaciones');
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
      ->select('article_languages.document', 'article_languages.title','articles.id', 'articles.autor','article_languages.slug',
      'articles.only_file', 'articles.edition','publications.id as idpubli','publications.name_es', 'publications.name_en', 'publications.directory', 'article_columns.'.$campo.' as columna','articles.published_at')
      ->orderBy('articles.published_at','desc')
      ->orderBy('articles.id','desc')
      ->simplePaginate(7);


    $pages = $articles->toArray();

    $json['articulos']=[];

    $articulos = Funciones::armarArticuloApi($articles, $campo, $ruta, $language_id);
    $json['articulos']=$articulos;

    if(isset($pages['next_page_url'])){
      $json['next_page']=$pages['current_page']+1;
    }
    else{
      $json['next_page']=null;
    }
    $json['idioma']=$idioma;

    return json_encode($json);

});
Route::get('/articulo', function(Request $request){

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    $rol = 0;
    $user_id = $request->input('user');
    $logueado = false;
    if($user_id!='0'){
      $usuario = User::where('id', '=', $user_id)->first();
      if($usuario){
        $rol = $usuario->rol_id;
        $logueado = true;
      }
    }
    $idioma = $request->input('idioma');
    $id = $request->input('id_articulo');
    $language_id = Funciones::getIdIdioma($idioma);
    $language_id_espanol = 1;
    $ruta = Funciones::getRuta($idioma);
    $campo = Funciones::getCampoLang($language_id);
    $all_tags = Funciones::getTagsApi($language_id);
    $all_publicaciones = Funciones::getPublicacionesApi($language_id, $rol);

    $article = Article::join('article_languages', 'article_languages.article_id' ,'=', 'articles.id')
      ->leftjoin('article_columns', 'article_columns.id', '=', 'articles.column_id')
      ->where('article_languages.language_id', '=', $language_id_espanol)
      ->where('articles.id', '=', $id)
      ->select('article_languages.document','articles.edition','article_columns.'.$campo.' as columna','articles.privacity','article_languages.title', 'articles.id', 'article_languages.slug', 'articles.only_file', 'articles.autor', 'articles.publication_id')
      ->first();

    if(!$article){
      return response()->json([
        'error' => 'Artículo no existe'
      ]);
    }

    if($article->privacity==1){
      if($logueado==false){
        return response()->json([
          'error' => 'Acceso denegado'
        ]);
      }
    }


    $data = [];

    $tags_relacionados = [];
    $articulos_relacionados = [];

    if($article){
      $publicacion = Publication::where('id', '=', $article->publication_id)->first();

      $doc =json_decode($article->document);
      $data['title'] = $article->title;
      $data['content'] = $doc->content;
      $data['resumen'] = Funciones::myTruncate($doc->content, 150, ' ', '...');
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

      $data['id'] = $article->id;
      $data['autor'] = $article->autor;
      $data['date'] = Funciones::getDateString($doc->published_at, $language_id);
      $data['url_web'] = url('/articulo/'.$article->slug);
      $data['url_publicacion'] =  url('/publicaciones?id='.$publicacion->id.'&publicacion='.$publicacion->$campo.'&edicion='.$article->edition);
      $data['publication'] = $publicacion->$campo;
      $data['columna'] = $article->columna;
      $data['publication_id'] = $publicacion->id;
      $data['edition'] = $article->edition;

      $tags = ArticleTag::join('tags', 'tags.id', '=', 'article_tags.tag_id')
        ->where('article_id', '=', $article->id)
        ->select('article_tags.tag_id', 'tags.'.$campo.' as name')
        ->get();

      foreach ($tags as $tag) {
        if($tag){
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
        ->select('article_languages.document', 'article_languages.title', 'articles.id','article_columns.'.$campo.' as columna', 'articles.autor','article_languages.slug', 'articles.only_file', 'articles.edition','publications.id as idpubli','publications.name_es', 'publications.name_en', 'publications.directory','articles.published_at')
        ->groupBy('article_languages.document', 'article_languages.title', 'articles.id','article_columns.'.$campo, 'articles.autor','article_languages.slug', 'articles.only_file','articles.edition','idpubli','publications.name_es', 'publications.name_en', 'publications.directory','articles.published_at')
        ->orderBy('articles.published_at','desc')
        ->orderBy('articles.id','desc')
        ->take(2)
        ->get();

      $articulos_relacionados = Funciones::armarArticuloApi($articles_relacionados, $campo, $ruta, $language_id);

      $json = [];
      $json['articulo'] = $data;
      $json['articulos_relacionados'] = $articulos_relacionados;
      $json['publicaciones'] = $all_publicaciones;
      $json['tags'] = $all_tags;

      return json_encode($json);
    }

});

Route::get('/eventos', function(Request $request){
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    $idioma = $request->input('idioma');
    $language_id = Funciones::getIdIdioma($idioma);
    $ruta = Funciones::getRuta($idioma);
    $cumbres_format=[];
    $seminarios_format=[];
    $seminarios_inscripcion=[];

    $cumbres = Summit::join('summit_languages', 'summit_languages.summit_id', '=', 'summits.id')
        ->select('summits.id','summits.date','summits.time','summits.month','summits.day','summits.url','summit_languages.name','summit_languages.title'
        ,'summit_languages.place','summit_languages.description')
        ->where('summit_languages.language_id', '=', $language_id)
        ->orderBy('summits.date','asc')
        ->get();

    foreach ($cumbres as $key) {
      if($key->date)
      {
        $key_date = strtotime($key->date);
        $cumbre['day_name'] = Funciones::getNameDay(date('w', $key_date), $language_id);
        $cumbre['day'] = $key->day;
        $cumbre['month_name'] = Funciones::getNameMonth($key->month, $language_id);
      }
      else {
        $cumbre['day_name'] = "";
        $cumbre['day'] = "";
        $cumbre['month_name'] = "";
      }

      $cumbre['title'] = $key->title;
      $cumbre['place'] = $key->place;

      $cumbres_format[]=$cumbre;
    }

    $seminarios = Seminar::join('seminars_languages', 'seminars_languages.seminar_id', '=', 'seminars.id')
        ->where('seminars_languages.language_id', '=', $language_id)
        ->where('seminars.active', '=', 1)
        ->select('seminars.date','seminars.day','seminars.month','seminars_languages.place','seminars_languages.title','seminars_languages.file')
        ->orderBy('seminars.date','asc')
        ->orderBy('seminars.id','asc')
        ->get();

    foreach ($seminarios as $key) {
      $key_date = strtotime($key->date);
      $data['day'] = $key->day;
      $data['day_name'] = Funciones::getNameDay(date('w', $key_date), $language_id);
      $data['month_name'] = Funciones::getNameMonth($key->month, $language_id);
      $data['title'] = $key->title;
      $data['place'] = $key->place;
      if(isset($key->file) && $key->file!=''){
        $data['file'] = url('upload/seminars/'.$key->file);
      }

      $seminarios_format[]=$data;
    }

    //consulta para obtener los eventos en el que se pueden inscribir
    $list_events= Seminar::select('seminars.id','seminars_languages.name')
    ->join('seminars_languages','seminars_languages.seminar_id','=','seminars.id')
    ->where('active','=',1)
    ->where('state','=',1)
    ->where('seminars_languages.language_id','=',$language_id)
    ->select('seminars.id', 'seminars_languages.name')
    ->get();

    foreach ($list_events as $key) {
      $item['id'] = $key->id;
      $item['name'] = $key->name;

      $seminarios_inscripcion[]=$item;
    }
    $json = [];
    $json['cumbres'] = $cumbres_format;
    $json['seminarios'] = $seminarios_format;
    $json['seminarios_inscripcion'] = $seminarios_inscripcion;

    return json_encode($json);

});
Route::get('/list-eventos', function(Request $request){
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    $idioma = $request->input('idioma');
    $language_id = Funciones::getIdIdioma($idioma);
    $ruta = Funciones::getRuta($idioma);
    $seminarios_inscripcion=[];

    //consulta para obtener los eventos en el que se pueden inscribir
    $list_events= Seminar::select('seminars.id','seminars_languages.name')
    ->join('seminars_languages','seminars_languages.seminar_id','=','seminars.id')
    ->where('active','=',1)
    ->where('state','=',1)
    ->where('seminars_languages.language_id','=',$language_id)
    ->select('seminars.id', 'seminars_languages.name')
    ->get();

    foreach ($list_events as $key) {
      $item['id'] = $key->id;
      $item['name'] = $key->name;

      $seminarios_inscripcion[]=$item;
    }
    $json = [];
    $json['seminarios_inscripcion'] = $seminarios_inscripcion;

    return json_encode($json);

});
Route::post('/save-inscription', function(Request $request){

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    $acepta = 0;
    if($request->input('datos_accept')){
      $acepta = 1;
    }

    $inscription = new Inscription();
    $inscription->seminar_id = $request->input('seminar_id');
    $inscription->company = $request->input('company');
    $inscription->RUC = $request->input('ruc');
    $inscription->sector = $request->input('sector');
    $inscription->address = $request->input('address');
    $inscription->email = $request->input('email');
    $inscription->phone = $request->input('phone');
    $inscription->fax = $request->input('fax');
    $inscription->name = $request->input('name');
    $inscription->lastname = $request->input('lastname');
    $inscription->document_type = $request->input('document_type');
    $inscription->document = $request->input('document');
    $inscription->position = $request->input('position');
    $inscription->authorize = $acepta;
    $inscription->state = 1;
    $inscription->save();

    $idioma = $request->input('idioma');
    $language_id = Funciones::getIdIdioma($idioma);

    if($language_id==2){
      App::setLocale('en');
    }
    else{
      App::setLocale('es');
    }

    $seminario = Seminar::join('seminars_languages','seminars_languages.seminar_id','=','seminars.id')
      ->where('seminars.id','=',$request->input('seminar_id'))
      ->where('seminars_languages.language_id','=',$language_id)
      ->select('seminars.id','seminars_languages.name', 'seminars_languages.place', 'seminars.date', 'seminars.time')
      ->first();

      if($seminario!=null)
      {
        $time = Funciones::formatTime($seminario->time);

        $data = [
          'title' => $seminario->name
          ,'place' => $seminario->place
          ,'time' => $time
          ,'date' => Funciones::getAllStringDate($seminario->date, $language_id)
          ,'email' => $request->input('email')
          ,'name' => $request->input('name')
        ];
        // Path or name to the blade template to be rendered
        $template_path = 'mails.confirmacionevento';

        Mail::send($template_path, $data, function($message) use ($data) {
            // Set the receiver and subject of the mail.
            $message->to($data['email'], $data['name'])->subject('Inscripción COMEXPERU');
        });
      }

    return response()->json([
      'success' => true
    ]);

});
Route::post('/save-obstaculos', function(Request $request){

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    $nuevo = new TradeBarrier();
    $nuevo->name = $request->input('name');
    $nuevo->lastname = $request->input('lastname');
    $nuevo->email = $request->input('email');
    $nuevo->phone = $request->input('phone');
    $nuevo->company = $request->input('company');
    $nuevo->description = $request->input('description');
    $nuevo->save();

    $data = array('nombre'=> $request->input('name'),
        'apellido'=> $request->input('lastname'),
        'email'=> $request->input('email'),
        'telefono'=> $request->input('phone'),
        'empresa'=> $request->input('company'),
        'descripcion'=> $request->input('description')
        );
    // Path or name to the blade template to be rendered
    $template_path = 'mails.obstaculosalcomercio';

    try{
        Mail::send($template_path, $data, function($message) {
            // Set the receiver and subject of the mail.
            //  $message->to('consultoria@comexperu.org.pe', '')->subject('Obstáculos al Comercio COMEXPERU');
            $message->to('consultoria@comexperu.org.pe', 'Contacto')->subject('Obstáculos al Comercio COMEXPERU');
            // Set the sender
            //$message->from('consultoria@comexperu.org.pe','usuario');
            $message->from('consultoria@comexperu.org.pe','usuario');
        });
    }
    catch(\Exception $e){
      return response()->json([
        'success' => true,
        'mail_send' =>false
      ]);
    }
    return response()->json([
      'success' => true,
      'mail_send' => true
    ]);


});
Route::get('/foro', function(Request $request){

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    $idioma = $request->input('idioma');
    $language_id = Funciones::getIdIdioma($idioma);

    $presentaciones = Seminar::join('seminars_languages', 'seminars_languages.seminar_id','=', 'seminars.id')
      ->join('seminars_presentations', 'seminars_presentations.seminar_id', '=', 'seminars.id')
      ->select('seminars.id', 'seminars.date', 'seminars_languages.name', 'seminars_presentations.title', 'seminars_presentations.file', 'seminars_presentations.theme')
      ->where('seminars_languages.language_id', '=', 1)
      ->orderBy('seminars.date', 'desc')
      ->orderBy('seminars.id', 'desc')
      ->paginate(25);

    $paginacion = $presentaciones->toArray();

    $json = [];

    foreach ($presentaciones as $key) {
      $data['title'] = $key->title;
      $data['name'] = $key->name;
      $data['theme'] = $key->theme;
      $data['date'] = Funciones::getDateString($key->date, $language_id);
      if($key->file!='' && $key->file){
          $data['file'] = url('upload/seminars/foro/'.$key->file);
      }
      else{
        $data['file'] = '';
      }

      $json['presentaciones'][] = $data;
    }
    $json['last_page'] = $paginacion['last_page'];

    return json_encode($json);

});
Route::get('/list-publications', function(Request $request){

  header('Access-Control-Allow-Origin: *');
  header('Content-type: application/json');

  $rol = 0;
  $user_id = $request->input('user');
  $idioma = $request->input('idioma');
  $language_id = Funciones::getIdIdioma($idioma);
  $campo = Funciones::getCampoLang($language_id);
  $json = [];

  $publicaciones = Publication::where('privacity', '=',0)->select('id', $campo.' as name')->get();
  if($user_id!='0'){
    $usuario = User::where('id', '=', $user_id)->first();
    if($usuario){
      $publicaciones = Publication::select('id', $campo.' as name')->orderBy('id')->orderBy('privacity')->get();
    }
  }


  foreach ($publicaciones as $key) {
    $data['id'] = $key->id;
    $data['name'] = $key->name;

    $json[] = $data;
  }

  return json_encode($json);

});
Route::get('/publicaciones', function(Request $request){

  header('Access-Control-Allow-Origin: *');
  header('Content-type: application/json');

  $rol = 0;
  $user_id = $request->input('user');
  $idioma = $request->input('idioma');
  $id_publicacion = $request->input('id_publicacion');
  $edition = $request->input('edicion');

  if($user_id!='0'){
    $usuario = User::where('id', '=', $user_id)->first();
    if($usuario){
      $rol = $usuario->rol_id;
    }
  }

  $language_id = Funciones::getIdIdioma($idioma);
  $language_id_espanol = 1;
  $campo = Funciones::getCampoLang($language_id);
  $json = [];

  $articulos = Article::join('article_languages', 'article_languages.article_id' ,'=', 'articles.id')
    ->join('publications', 'publications.id', '=', 'articles.publication_id')
    ->leftjoin('article_columns', 'article_columns.id', '=', 'articles.column_id')
    ->filterByPublication($id_publicacion)
    ->filterByEdition($edition)
    ->accessprivate($rol)
    ->where('article_languages.language_id', '=', $language_id_espanol)
    ->where('articles.is_open', '=', true)
    ->select('articles.id', 'article_languages.slug', 'articles.only_file', 'articles.publication_id as idpubli',
      'publications.'.$campo.' as publicacion', 'article_languages.abstract', 'article_columns.'.$campo.' as columna',
      'article_languages.title', 'articles.published_at', 'articles.autor', 'article_languages.file', 'articles.edition', 'publications.directory')
    ->orderBy('articles.published_at','desc')
    ->orderBy('articles.id','desc')
    ->paginate(25);

  $paginacion = $articulos->toArray();

  foreach ($articulos as $key) {
    $data['id'] = $key->id;
    $data['title'] = preg_replace('#<[^>]+>#', ' ', $key->title);
    $data['abstract'] = $key->abstract;
    $data['column'] = $key->columna;
    $data['id_publication'] = $key->idpubli;
    $data['publication'] = $key->publicacion;
    $data['edition'] = $key->edition;
    $data['slug'] = $key->slug;
    $data['only_file'] = $key->only_file;
    $data['date'] = Funciones::getDateString($key->published_at, $language_id);
    if($key->file!='' && $key->file){
        $data['file'] = url('upload/articles/'.$key->directory.'/'.$key->file);
    }
    else{
      $data['file'] = '';
    }
    $json['publicaciones'][] = $data;
  }
    $json['last_page'] = $paginacion['last_page'];

  return json_encode($json);

});
Route::post('/save-subscriptions', function(Request $request){

  header('Access-Control-Allow-Origin: *');
  header('Content-type: application/json');

  $id_publicacion = $request->input('id_publicacion');

  $acepta = 0;
  if($request->input('datos_accept')){
    $acepta = 1;
  }

  try{
    switch ($id_publicacion) {
      case '1':
          $subscription = new SemanarioSubscription();
          $subscription->company = $request->input('company');
          $subscription->email = $request->input('email');
          $subscription->phone = $request->input('phone');
          $subscription->name = $request->input('name');
          $subscription->position = $request->input('position');
          $subscription->state = 1;
          $subscription->authorize = $acepta;
          $subscription->save();
        break;
      case '4':
          $subscription = new DatacomexSubscription();
          $subscription->company = $request->input('company');
          $subscription->email = $request->input('email');
          $subscription->phone = $request->input('phone');
          $subscription->name = $request->input('name');
          $subscription->position = $request->input('position');
          $subscription->state = 1;
          $subscription->authorize = $acepta;
          $subscription->save();
        break;

      default:
        # code...
        break;
    }

    return response()->json([
      'success' => true
    ]);
  }
  catch(\Exception $e){
    return response()->json([
      'success' => false
    ]);
  }


});
Route::post('/save-subscription-negocios', function(Request $request){

  header('Access-Control-Allow-Origin: *');
  header('Content-type: application/json');

  try{

    $acepta = 0;
    if($request->input('datos_accept')){
      $acepta = 1;
    }

    $suscription = new NegociosSubscription();
    $suscription->institution = $request->input('institution');
    $suscription->ruc = $request->input('ruc');
    $suscription->address = $request->input('address');
    $suscription->address_institution = $request->input('address_institution');
    $suscription->email = $request->input('email');
    $suscription->phone = $request->input('phone');
    $suscription->fax = $request->input('fax');
    $suscription->name = $request->input('name');
    $suscription->anual_peru = $request->input('anual_peru');
    $suscription->anual_latinoamerica = $request->input('anual_latinoamerica');
    $suscription->anual_continentes = $request->input('anual_continentes');
    $suscription->position = $request->input('position');
    $suscription->semestral_continentes = $request->input('semestral_continentes');
    $suscription->semestral_latinoamerica = $request->input('semestral_latinoamerica');
    $suscription->semestral_peru = $request->input('semestral_peru');
    $suscription->state = 1;
    $suscription->authorize = $acepta;
    $suscription->save();

    return response()->json([
      'success' => true
    ]);
  }
  catch(\Exception $e){
    return response()->json([
      'success' => false
    ]);
  }


});
Route::post('/save-contact', function(Request $request){

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    $acepta = 0;
    if($request->input('datos_accept')){
      $acepta = 1;
    }

    $contacto = new Contact();
    $contacto->name = $request->input('name');
    $contacto->phone = $request->input('phone');
    $contacto->email = $request->input('email');
    $contacto->company = $request->input('company');
    $contacto->message = $request->input('message');
    $contacto->authorize = $acepta;
    $contacto->save();

    $data = array('nombre'=> $request->input('name'),
        'email'=> $request->input('email'),
        'telefono'=> $request->input('phone'),
        'empresa'=> $request->input('company'),
        'mensaje'=> $request->input('message'),
        );
    // Path or name to the blade template to be rendered
    $template_path = 'mails.contacto';
    try{
        Mail::send($template_path, $data, function($message) {
            // Set the receiver and subject of the mail.
            //$message->to('consultoria@comexperu.org.pe', 'Contacto')->subject('Contacto COMEXPERU');
            $message->to('jbernilla@comexperu.org.pe', 'Contacto')->subject('Contacto COMEXPERU');
            // Set the sender
            //$message->from('consultoria@comexperu.org.pe','usuario');
            $message->from('jbernilla@comexperu.org.pe','usuario');
        });
    }
    catch(\Exception $e){
      return response()->json([
        'success' => true,
        'mail_send' =>false
      ]);
    }
    return response()->json([
      'success' => true,
      'mail_send' => true
    ]);

});
Route::post('/save-subscriber', function(Request $request){

  header('Access-Control-Allow-Origin: *');
  header('Content-type: application/json');

  try{

    $email = $request->input('email');
    $existe = Subscriber::where('email', '=', $email)->first();

    if(!$existe){
      $subscriber = new Subscriber();
      $subscriber->email = $email;
      $subscriber->save();
    }

    return response()->json([
      'success' => true
    ]);
  }
  catch(\Exception $e){
    return response()->json([
      'success' => false
    ]);
  }


});
Route::get('/busqueda-general', function(Request $request){

  header('Access-Control-Allow-Origin: *');
  header('Content-type: application/json');

    $idioma = $request->input('idioma');
    $busqueda = $request->input('keyword');
    $section = $request->input('section');
    $user_id = $request->input('user');
    $language_id_espanol = 1;
    $rol = 0;
    $consulta_privacidad=' AND a.privacity = false';
    $json = [];
    $language_id = Funciones::getIdIdioma($idioma);
    $ruta = Funciones::getRuta($idioma);
    $campo = Funciones::getCampoLang($language_id);

    if($user_id!='0'){
      $usuario = User::where('id', '=', $user_id)->first();
      if($usuario){
        $consulta_privacidad='';
      }
    }

    try{

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

          break;
      }

      foreach ($data_secciones as $key) {
        $item_secciones = [];
        $item_secciones['id'] = $key->id;
        $item_secciones['title'] = preg_replace('#<[^>]+>#', ' ', $key->titulo);
        $item_secciones['id_publication'] = $key->idpubli;
        $item_secciones['publication'] = $key->publicacion;
        $item_secciones['edition'] = $key->edition;
        $item_secciones['date'] = Funciones::getDateString($key->fecha, $language_id);
        $item_secciones['detalle'] = Funciones::myTruncate(strip_tags($key->detalle), 150, ' ', '...');
        $item_secciones['url'] = Funciones::getUrl($key->tipo, $key->ruta, $key->idpubli, $ruta);
        $item_secciones['tipo'] = $key->tipo;

        $json['secciones_web'][] = $item_secciones;
      }
      foreach ($data_foro as $key) {
        $item_foro = [];
        $item_foro['id'] = $key->id;
        $item_foro['title'] = preg_replace('#<[^>]+>#', ' ', $key->titulo);
        $item_foro['id_publication'] = $key->idpubli;
        $item_foro['date'] = Funciones::getDateString($key->fecha, $language_id);
        $item_foro['detalle'] = Funciones::myTruncate(strip_tags($key->detalle), 150, ' ', '...');
        $item_foro['url'] = Funciones::getUrl($key->tipo, $key->ruta, $key->idpubli, $ruta);
        $item_foro['tipo'] = $key->tipo;
        $json['foro'][] = $item_foro;
      }
      foreach ($data_revistas as $key) {
        $item_revistas = [];
        $item_revistas['id'] = $key->id;
        $item_revistas['title'] = preg_replace('#<[^>]+>#', ' ', $key->titulo);
        $item_revistas['id_publication'] = $key->idpubli;
        $item_revistas['publication'] = $key->publicacion;
        $item_revistas['edition'] = $key->edition;
        $item_revistas['date'] = Funciones::getDateString($key->fecha, $language_id);
        $item_revistas['column'] = $key->columna;
        $item_revistas['url'] = Funciones::getUrl($key->tipo, $key->ruta, $key->idpubli, $ruta);
        $item_revistas['tipo'] = $key->tipo;

        $json['revistas'][] = $item_revistas;
      }
      foreach ($data_semanarios as $key) {
        $item_semanarios = [];
        $item_semanarios['id'] = $key->id;
        $item_semanarios['title'] = preg_replace('#<[^>]+>#', ' ', $key->titulo);
        $item_semanarios['id_publication'] = $key->idpubli;
        $item_semanarios['publication'] = $key->publicacion;
        $item_semanarios['edition'] = $key->edition;
        $item_semanarios['date'] = Funciones::getDateString($key->fecha, $language_id);
        $item_semanarios['column'] = $key->columna;
        $item_semanarios['url'] = Funciones::getUrl($key->tipo, $key->ruta, $key->idpubli, $ruta);
        $item_semanarios['tipo'] = $key->tipo;

        $json['semanarios'][] = $item_semanarios;
      }

      return json_encode($json);
    }
    catch(\Exception $e){
      return response()->json([
        'error' => $e->getMessage()
      ]);
    }

});
Route::post('/savesuscription', function(Request $request){

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    $palabra_clave = '5WaV9IjnWuMmNfoY6TIBWJxLlCZ3QHVhai2En1LT';
    try{
      if($request->input('palabra_clave')==$palabra_clave){

        $existe = \App\KeyIos::where('token', '=', $request->input('key'))->first();

        if(!$existe){
          $nuevo = new \App\KeyIos();
          $nuevo->token = $request->input('key');
          $nuevo->save();
        }

      }
      else{
        return response()->json([
          'success' => false, 'mg' => 'Access Denied'
        ]);
      }

    }
    catch(\Exception $e){
      return response()->json([
        'success' => false
      ]);
    }
    return response()->json([
      'success' => true,
    ]);


});
