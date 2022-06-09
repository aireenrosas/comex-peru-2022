<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Summit;
use App\SummitLanguage;
use Funciones;
use App;
use Auth;

class adminCumbresController extends Controller
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
  public function index()
  {
      $language_id = $this->language_id;
      $cumbres = Summit::join('summit_languages', 'summit_languages.summit_id', '=', 'summits.id')
        ->select('summit_languages.name', 'summits.date','summits.time', 'summit_languages.place', 'summits.id'
        )
        ->where('summit_languages.language_id', '=', $language_id)
        ->get();

      return view('admin.cumbres.cumbres')
        ->with('cumbres', $cumbres);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('admin.cumbres.newcumbre');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $user_id = Auth::user()->id;
    $fecha = $request->input('fecha');
    $date = null;
    $anio = null;
    $mes = null;
    $dia = null;

    if($fecha){
      $date = strtotime($fecha);
      $anio = date('Y', $date);
      $mes = date('n',$date);
      $dia = date('d',$date);
    }


    $item = new Summit();

    $item->month= $mes;
    $item->day= $dia;
    $item->year= $anio;
    $item->date= $fecha;
    $item->time= $request->input('time');
    $item->url= $request->input('url');
    $item->created_by= $user_id;
    $item->updated_by= $user_id;
    $item->save();

    $item_es = new SummitLanguage();
    $item_es->summit_id = $item->id;
    $item_es->title = $request->input('title_es');
    $item_es->name = $request->input('name_es');
    $item_es->description = $request->input('description_es');
    $item_es->place= $request->input('place_es');
    $item_es->language_id = 1;
    $item_es->save();

    if($request->input('name_en')){
      $name_en = $request->input('name_en');
      $place_en = $request->input('place_en');
      $title_en = $request->input('place_en');
    }
    else{
      $name_en = $request->input('name_es');
      $place_en = $request->input('place_es');
      $title_en = $request->input('title_es');
    }
    $item_en = new SummitLanguage();
    $item_en->summit_id = $item->id;
    $item_en->title = $title_en;
    $item_en->name = $name_en;
    $item_en->description = $request->input('description_en');
    $item_en->place= $place_en;
    $item_en->language_id = 2;
    $item_en->save();

    return redirect('/admin/cumbres');
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
      $cumbre = Summit::where('id', '=', $id)->first();
      $cumbre_es = SummitLanguage::where('summit_id', '=', $cumbre->id)
        ->where('language_id', '=', 1)
        ->first();
      $cumbre_en = SummitLanguage::where('summit_id', '=', $cumbre->id)
        ->where('language_id', '=', 2)
        ->first();

      return view('admin.cumbres.editcumbre')
        ->with('cumbre', $cumbre)
        ->with('cumbre_es', $cumbre_es)
        ->with('cumbre_en', $cumbre_en);
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
    $user_id = Auth::user()->id;

    $fecha = $request->input('fecha');
    $date = null;
    $anio = null;
    $mes = null;
    $dia = null;

    if($fecha){
      $date = strtotime($fecha);
      $anio = date('Y', $date);
      $mes = date('n',$date);
      $dia = date('d',$date);
    }

    $item =Summit::find($id);
    $item->month= $mes;
    $item->day= $dia;
    $item->year= $anio;
    $item->date= $fecha;
    $item->time= $request->input('time');
    $item->url= $request->input('url');
    $item->created_by= $user_id;
    $item->updated_by= $user_id;
    $item->save();

    $id_item_es = SummitLanguage::where('summit_id', '=', $id)
      ->select('id')
      ->where('language_id', '=', 1)
      ->first();

    if($id_item_es){
      $item_es = SummitLanguage::find($id_item_es->id);
      $item_es->title = $request->input('title_es');
      $item_es->name = $request->input('name_es');
      $item_es->description = $request->input('description_es');
      $item_es->place= $request->input('place_es');
      $item_es->save();
    }
    else{
      $item_es = new SummitLanguage();
      $item_es->summit_id = $id;
      $item_es->title = $request->input('title_es');
      $item_es->name = $request->input('name_es');
      $item_es->description = $request->input('description_es');
      $item_es->place= $request->input('place_es');
      $item_es->language_id = 1;
      $item_es->save();
    }

    $id_item_en = SummitLanguage::where('summit_id', '=', $id)
      ->select('id')
      ->where('language_id', '=', 2)
      ->first();

    if($id_item_en){
      $item_en = SummitLanguage::find($id_item_en->id);
      $item_en->name = $request->input('name_en');
      $item_en->place= $request->input('place_en');
      $item_en->title = $request->input('title_en');
      $item_en->description = $request->input('description_en');
      $item_en->save();
    }
    else{
      $item_en = new SummitLanguage();
      $item_en->summit_id = $id;
      $item_en->name = $request->input('name_en');
      $item_en->place= $request->input('place_en');
      $item_en->title = $request->input('title_en');
      $item_en->description = $request->input('description_en');
      $item_en->language_id = 2;
      $item_en->save();
    }

    return redirect('/admin/cumbres');
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
  public function deleteSummit(Request $request)
  {
      $id = $request->input('id');
      $summit_lang = SummitLanguage::where('summit_id', '=', $id)->delete();
      $summit = Summit::find($id);
      $summit->delete();

      return 'success';

  }
}
