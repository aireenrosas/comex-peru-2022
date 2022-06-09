<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Conexiones;
use DB;
use Auth;
use Funciones;
use App;
use App\Seminar;

class eventoListadoPublicacionesController extends Controller
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

        $presentaciones = Seminar::join('seminars_languages', 'seminars_languages.seminar_id','=', 'seminars.id')
          ->join('seminars_presentations', 'seminars_presentations.seminar_id', '=', 'seminars.id')
          ->select('seminars.id', 'seminars.date', 'seminars_languages.name', 'seminars_presentations.title', 'seminars_presentations.file', 'seminars_presentations.theme')
          ->where('seminars_languages.language_id', '=', 1)
          ->orderBy('seminars.date', 'desc')
          ->orderBy('seminars.id', 'desc')
          ->paginate(25);

        return view('front.ver.eventoListadoPublicaciones')
          ->with('ruta', $ruta)
          ->with('presentaciones', $presentaciones)
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
}
