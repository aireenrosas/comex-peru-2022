<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Conexiones;
use DB;
use Auth;
use Funciones;
use App;
use App\Publication;

class serviciopublicacionesController extends Controller
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
        $ruta = Funciones::getRuta($idioma);
        $language_id = Funciones::getIdIdioma($idioma);
        $campo = Funciones::getCampoLang($language_id);

        $publicaciones_privadas = Publication::where('privacity', '=',1)->select('id', $campo.' as name')->orderby("name")->get();
        $publicaciones_publicas = Publication::where('privacity', '=',0)->select('id', $campo.' as name')->orderby("name")->get();

        return view('front.ver.serviciopublicaciones')
          ->with('ruta', $ruta)
          ->with('publicaciones_privadas', $publicaciones_privadas)
          ->with('publicaciones_publicas', $publicaciones_publicas);
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
