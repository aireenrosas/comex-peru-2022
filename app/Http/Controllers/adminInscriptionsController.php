<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use App\Roles;
use Funciones;
use App\Seminar;
use App;
use App\Inscription;

class adminInscriptionsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
        $inscripciones= Inscription::select(
          'inscriptions.*', 'seminars_languages.name as evento'
        )
        ->join('seminars_languages','seminars_languages.seminar_id','=','inscriptions.seminar_id')
        ->filterByName($request->input('filtro_inscripciones'))
        ->where('seminars_languages.language_id', '=',1)
        ->orderby('inscriptions.id', 'desc')
        ->paginate(25);

        return view('admin.suscriptores.inscripciones')
        ->with('inscripciones', $inscripciones)
        ->with('request', $request);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {

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
