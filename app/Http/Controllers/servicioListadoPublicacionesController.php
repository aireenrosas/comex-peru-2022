<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Conexiones;
use DB;
use Auth;
use Funciones;
use App;
use App\Article;
use App\SemanarioSubscription;
use App\Publication;
use App\DatacomexSubscription;
use App\NegociosSubscription;
use Validator;

class servicioListadoPublicacionesController extends Controller
{

    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idioma='es', Request $request)
    {
      $id_publicacion = $request->input('id');
      $publicacion = $request->input('publicacion');
      $edition = $request->input('edicion');

      $language_id = Funciones::getIdIdioma($idioma);
      $language_id_espanol = 1;
      $ruta = Funciones::getRuta($idioma);
      $campo = Funciones::getCampoLang($language_id);

      $rol = 0;
      if(Auth::check()){
        $rol = Auth::user()->rol_id;
      }

      $articulos = Article::join('article_languages', 'article_languages.article_id' ,'=', 'articles.id')
        ->join('publications', 'publications.id', '=', 'articles.publication_id')
        ->leftjoin('article_columns', 'article_columns.id', '=', 'articles.column_id')
        ->filterByPublication($id_publicacion)
        ->filterByEdition($edition)
        ->accessprivate($rol)
        ->where('article_languages.language_id', '=', $language_id_espanol)
        ->where('articles.is_open', '=', true)
        ->select('articles.id', 'article_languages.slug', 'articles.only_file', 'articles.publication_id as idpubli',
          'publications.name_es', 'publications.name_en', 'article_languages.abstract', 'article_columns.'.$campo.' as columna',
          'article_languages.title', 'articles.published_at', 'articles.autor', 'article_languages.file', 'articles.edition', 'publications.directory')
        ->orderByEdition($edition)
        ->paginate(25);

        $ruta = Funciones::getRuta($idioma);
        return view('front.ver.servicioListadoPublicaciones')
          ->with('ruta', $ruta)
          ->with('articulos', $articulos)
          ->with('publicacion_id', $id_publicacion)
          ->with('request', $request)
          ->with('language_id', $language_id);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function subscriptionpublication(Request $request)
    {

      $rules = [
        'g-recaptcha-response' => 'required|captcha'
      ];

      $validation = Validator::make($request->all(), $rules);
      // if validation fails
      if($validation->fails())
      {
          return redirect()->back()->with('captchavalidacion','publicacion')->withInput();
      }
    //   $response_recaptcha = $_POST['g-recaptcha-response'];
    //   if(isset( $response_recaptcha)&&$response_recaptcha)
    //   {
    //     $secret='6Lfxfy4UAAAAAEQEuNgyvYY1beXcw9ZUBFxd4szb';
    //   //$secret= '6LeEFy4UAAAAAKtVGNFzdULg_11IGMSCmRGbcROV'; //clave del local
    //     $ip= $_SERVER['REMOTE_ADDR'];
    //     $validation_server= file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response_recaptcha."&remoteip=".$ip);
    // //    $validation_server= file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response_recaptcha."&remoteip=".$ip);
      $acepta = 0;
      if($request->input('datos_accept')){
        $acepta = 1;
      }

      $id_publicacion = $request->input('id_publicacion');

      switch ($id_publicacion) {
        case '1':
            $subscription = new SemanarioSubscription();
            $subscription->company = $request->input('empresa');
            $subscription->email = $request->input('email');
            $subscription->phone = $request->input('telefono');
            $subscription->name = $request->input('nombre');
            $subscription->position = $request->input('cargo');
            $subscription->state = 1;
            $subscription->authorize = $acepta;
            $subscription->save();
          break;
        case '4':
            $subscription = new DatacomexSubscription();
            $subscription->company = $request->input('empresa');
            $subscription->email = $request->input('email');
            $subscription->phone = $request->input('telefono');
            $subscription->name = $request->input('nombre');
            $subscription->position = $request->input('cargo');
            $subscription->state = 1;
            $subscription->authorize = $acepta;
            $subscription->save();
          break;

        default:
          # code...
          break;
      }
      return redirect()->back()->with('okey', 'okey');
    // } //fin if captcha
    //    return redirect()->back()->with('errorA', 'errorA');
    }

    public function subscriptionnegocios(Request $request)
    {
        $rules = [
          'g-recaptcha-response' => 'required|captcha'
        ];

        $validation = Validator::make($request->all(), $rules);
        // if validation fails
        if($validation->fails())
        {
            return redirect()->back()->with('captchavalidacion','negocios')->withInput();
        }
    //    $response_recaptcha = $_POST['g-recaptcha-response'];
    //    if(isset( $response_recaptcha)&&$response_recaptcha)
    //    {
    //      $secret='6Lfxfy4UAAAAAEQEuNgyvYY1beXcw9ZUBFxd4szb';
    //   //   $secret= '6LeEFy4UAAAAAKtVGNFzdULg_11IGMSCmRGbcROV'; //clave del local
    //      $ip= $_SERVER['REMOTE_ADDR'];
    //      $validation_server= file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response_recaptcha."&remoteip=".$ip);
    // //     $validation_server= file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response_recaptcha."&remoteip=".$ip);
        $acepta = 0;
        if($request->input('datos_accept')){
          $acepta = 1;
        }

        $negociosFormData = $request->all();
        $radio= $request->input('radio');
        $negociosFormData['state']= 1; //habilitado
        if($radio==1){$negociosFormData['anual_peru']= 1;}
        if($radio==2){$negociosFormData['anual_latinoamerica']= 1;}
        if($radio==3){$negociosFormData['anual_continentes']= 1;}
        if($radio==4){$negociosFormData['semestral_peru']= 1;}
        if($radio==5){$negociosFormData['semestral_latinoamerica']= 1;}
        if($radio==6){$negociosFormData['semestral_continentes']= 1;}
        $negociosFormData['authorize'] = $acepta;
        $negiociosInscricion= NegociosSubscription::create($negociosFormData);
        return redirect()->back()->with('status', 'OK');
      //  }
      //  return redirect()->back()->with('error', 'error');
    }
}
