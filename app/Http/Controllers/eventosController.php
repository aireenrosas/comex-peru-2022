<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Conexiones;
use DB;
use Auth;
use Funciones;
use App;
use App\Summit;
use App\Seminar;
use App\Inscription;
use Mail;
use Validator;

class eventosController extends Controller
{

    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idioma='es')
    {

        $language_id = Funciones::getIdIdioma($idioma);

        $ruta = Funciones::getRuta($idioma);

        $date = strtotime(date('Y-m-d'));
        $anio_actual = date('Y', $date);
        $meses = Seminar::select('month', 'year')
            ->where('active', '=', 1)
            ->groupBy('month', 'year')
            ->orderBy('date','asc')
            ->get();

        $cumbres = Summit::join('summit_languages', 'summit_languages.summit_id', '=', 'summits.id')
            ->select('summits.id','summits.date','summits.time','summits.month','summits.day','summits.url','summit_languages.name','summit_languages.title'
            ,'summit_languages.place','summit_languages.description')
            ->where('summit_languages.language_id', '=', $language_id)
            ->orderBy('summits.date','desc')
            ->get();

        $cumbres_format=[];

        foreach ($cumbres as $key) {
          $key_date = strtotime($key->date);
          $data['id'] = $key->id;
          $data['day_name'] = Funciones::getNameDay(date('w', $key_date), $language_id);
          $data['day'] = $key->day;
          $data['time'] = Funciones::formatTime($key->time);
          $data['month'] = Funciones::getNameMonth($key->month, $language_id);
          $data['name'] = $key->name;
          $data['title'] = $key->title;
          $data['place'] = $key->place;
          $data['url'] = $key->url;
          $data['description'] = $key->description;

          $cumbres_format[]=$data;
        }
        //consulta para obtener los eventos
        $list_events= Seminar::select('seminars.id','seminars_languages.name')
        ->join('seminars_languages','seminars_languages.seminar_id','=','seminars.id')
        ->where('active','=',1)
        ->where('state','=',1)
        ->where('seminars_languages.language_id','=',$language_id)
        ->get();
        //dd($list_events);
        //fin consulta

        return view('front.ver.eventos')
          ->with('meses', $meses)
          ->with('cumbres', $cumbres_format)
          ->with('language_id', $language_id)
          ->with('ruta', $ruta)
          ->with('list_events', $list_events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function save_subscription(Request $request)
     {

         $rules = [
           'g-recaptcha-response' => 'required|captcha'
         ];

         $validation = Validator::make($request->all(), $rules);
         // if validation fails
         if($validation->fails())
         {
             return redirect()->back()->with('captchavalidacion','inscripcion')->withInput();
         }

         $acepta = 0;
         if($request->input('datos_accept')){
           $acepta = 1;
         }

        $inscriptionFormData = $request->all();
        $inscriptionFormData['state'] = 1; // habilitado por defecto
        $inscriptionFormData['authorize'] = $acepta;
        $inscription = Inscription::create($inscriptionFormData);

        $language_id = $request->input('language_id');

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



        return redirect()->back()->with('status', 'OK');
     }
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
}
