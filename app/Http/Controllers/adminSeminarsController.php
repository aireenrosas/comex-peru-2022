<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Seminar;
use App\SeminarLanguage;
use App\SeminarPresentation;
use Funciones;
use App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Auth;

class adminSeminarsController extends Controller
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

      $seminarios = Seminar::join('seminars_languages', 'seminars_languages.seminar_id', '=', 'seminars.id')
         ->filterByName($request->input('filtro_seminars'))
          ->select('seminars_languages.name', 'seminars.date', 'seminars_languages.place', 'seminars.id', 'seminars.active', 'seminars.state')
          ->where('seminars_languages.language_id', '=', $language_id)
          ->orderBy('seminars.created_at', 'desc')
          ->paginate(100);

      return view('admin.seminars.seminars')
        ->with('seminarios', $seminarios)
        ->with('request', $request);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('admin.seminars.newseminar');
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function newpresentacion($id_seminario)
  {
      return view('admin.seminars.adddocument')
      ->with('seminario', $id_seminario);
  }
  /**
   * store presentations
   *
   * @return \Illuminate\Http\Response
   */
  public function savedocumentos(Request $request)
  {
    $path = 'upload/seminars/foro';
    $seminar_id = $request->input('seminar_id');

    if($request->input('archivo_manual')=='1' && trim($request->input('name_file'))){
      $file =trim($request->input('name_file'));
    }
    else{
      $file = Funciones::saveFile('presentacion', $path);
    }

    $item = new SeminarPresentation();
    $item->seminar_id = $seminar_id;
    $item->title = $request->input('doc_titulo');
    $item->theme= $request->input('doc_tema');
    $item->observation= $request->input('doc_observacion');
    $item->file= $file;
    $item->save();

    return redirect('/admin/seminars/'.$seminar_id.'/edit');
  }
  /**
   * Show the form for editing a presentation.
   *
   * @return \Illuminate\Http\Response
   */
  public function editpresentacion($id_presentacion)
  {
      $presentacion = SeminarPresentation::where('id', '=', $id_presentacion)->first();

      return view('admin.seminars.editdocument')
      ->with('presentacion', $presentacion);
  }
  /**
   * delete a presentation.
   *
   * @return \Illuminate\Http\Response
   */
  public function deletepresentacion($id_presentacion)
  {
      $presentacion = SeminarPresentation::where('id', '=', $id_presentacion)->delete();

      return redirect()->back();
  }
  /**
   * update presentations
   *
   * @return \Illuminate\Http\Response
   */
  public function updatepresentacion(Request $request)
  {
    $path = 'upload/seminars/foro/';
    $presentacion_id = $request->input('presentacion_id');

    $item = SeminarPresentation::find($presentacion_id);
    $item->title = $request->input('doc_titulo');
    $item->theme= $request->input('doc_tema');
    $item->observation= $request->input('doc_observacion');

    if($request->input('archivo_manual')=='1' && trim($request->input('name_file'))){
      $item->file =trim($request->input('name_file'));
    }
    else{
      if (Input::hasFile('presentacion'))
      {
        $item->file= Funciones::saveFile('presentacion', $path);
      }
    }

    $item->save();

    return redirect('/admin/seminars/'.$item->seminar_id.'/edit');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $path = 'upload/seminars/';
    $user_id = Auth::user()->id;

    if($request->input('active')){
      $activo = 1;
    }
    else{
      $activo = 0;
    }

    if($request->input('state')){
      $estado = 1;
    }
    else{
      $estado = 2;
    }

    $fecha = $request->input('date');
    $date = strtotime($fecha);
    $anio = date('Y', $date);
    $mes = date('n',$date);
    $dia = date('d',$date);

    $item = new Seminar();
    $item->month= $mes;
    $item->day= $dia;
    $item->year= $anio;
    $item->date= $request->input('date');
    $item->time= $request->input('time');
    $item->active = $activo;
    $item->state = $estado;
    $item->created_by= $user_id;
    $item->updated_by= $user_id;
    $item->save();

    $item_es = new SeminarLanguage();
    $item_es->seminar_id = $item->id;
    $item_es->name = $request->input('name_es');
    $item_es->place= $request->input('place_es');
    $item_es->title = $request->input('title_es');
    if($request->input('archivo_manual_es')=='1' && trim($request->input('name_file_es'))){
      $item_es->file =trim($request->input('name_file_es'));
    }
    else{
        $item_es->file= Funciones::saveFile('file_es', $path);
    }
    $item_es->language_id = 1;
    $item_es->save();

    if($request->input('name_en')){
      $name_en = $request->input('name_en');
      $place_en = $request->input('place_en');
    }
    else{
      $name_en = $request->input('name_es');
      $place_en = $request->input('place_es');
    }
    $item_en = new SeminarLanguage();
    $item_en->seminar_id = $item->id;
    $item_en->name = $name_en;
    $item_en->place= $place_en;
    $item_en->title = $request->input('title_en');
    if($request->input('archivo_manual_en')=='1' && trim($request->input('name_file_en'))){
      $item_en->file =trim($request->input('name_file_en'));
    }
    else{
        $item_en->file= Funciones::saveFile('file_en', $path);
    }
    $item_en->language_id = 2;
    $item_en->save();


    return redirect('/admin/seminars');
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
      $seminario = Seminar::where('id', '=', $id)->first();
      $seminario_es = SeminarLanguage::where('seminar_id', '=', $seminario->id)
        ->where('language_id', '=', 1)
        ->first();
      $seminario_en = SeminarLanguage::where('seminar_id', '=', $seminario->id)
        ->where('language_id', '=', 2)
        ->first();

        $documentos = SeminarPresentation::where('seminar_id', '=', $id)->get();

      return view('admin.seminars.editseminar')
        ->with('seminario', $seminario)
        ->with('seminario_es', $seminario_es)
        ->with('seminario_en', $seminario_en)
        ->with('documentos', $documentos);
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
    $path = 'upload/seminars/';
    $user_id = Auth::user()->id;

    if($request->input('state')){
      $estado = 1;
    }
    else{
      $estado = 2;
    }

    if($request->input('active')){
      $activo = 1;
    }
    else{
      $activo = 0;
    }

    $fecha = $request->input('date');
    $date = strtotime($fecha);
    $anio = date('Y', $date);
    $mes = date('n',$date);
    $dia = date('d',$date);

    $item =Seminar::find($id);
    $item->month= $mes;
    $item->day= $dia;
    $item->year= $anio;
    $item->date= $request->input('date');
    $item->time= $request->input('time');
    $item->active = $activo;
    $item->state = $estado;
    $item->created_by= $user_id;
    $item->updated_by= $user_id;
    $item->save();

    $id_item_es = SeminarLanguage::where('seminar_id', '=', $id)
      ->select('id')
      ->where('language_id', '=', 1)
      ->first();



    if($id_item_es){
      $item_es = SeminarLanguage::find($id_item_es->id);
      $item_es->name = $request->input('name_es');
      $item_es->place= $request->input('place_es');
      $item_es->title = $request->input('title_es');
      if($request->input('archivo_manual_es')=='1' && trim($request->input('name_file_es'))){
        $item_es->file =trim($request->input('name_file_es'));
      }
      else{
        if (Input::hasFile('file_es'))
        {
          $item_es->file= Funciones::saveFile('file_es', $path);
        }
      }
      $item_es->save();
    }
    else{
      $item_es = new SeminarLanguage();
      $item_es->seminar_id = $item->id;
      $item_es->name = $request->input('name_es');
      $item_es->place= $request->input('place_es');
      $item_es->title = $request->input('title_es');
      if($request->input('archivo_manual_es')=='1' && trim($request->input('name_file_es'))){
        $item_es->file =trim($request->input('name_file_es'));
      }
      else{
          $item_es->file= Funciones::saveFile('file_es', $path);
      }
      $item_es->language_id = 1;
      $item_es->save();
    }

    $id_item_en = SeminarLanguage::where('seminar_id', '=', $id)
      ->select('id')
      ->where('language_id', '=', 2)
      ->first();

    if($id_item_en){
      $item_en = SeminarLanguage::find($id_item_en->id);
      $item_en->name = $request->input('name_en');
      $item_en->place= $request->input('place_en');
      $item_en->title = $request->input('title_en');
      if($request->input('archivo_manual_en')=='1' && trim($request->input('name_file_en'))){
        $item_en->file =trim($request->input('name_file_en'));
      }
      else{
        if (Input::hasFile('file_en'))
        {
          $item_en->file= Funciones::saveFile('file_en', $path);
        }
      }
      $item_en->save();
    }
    else{
      $item_en = new SeminarLanguage();
      $item_en->seminar_id = $item->id;
      $item_en->name = $request->input('name_en');
      $item_en->title = $request->input('title_en');
      $item_en->place= $request->input('place_en');
      $item_en->file= '';
      if($request->input('archivo_manual_en')=='1' && trim($request->input('name_file_en'))){
        $item_en->file =trim($request->input('name_file_en'));
      }
      else{
          $item_en->file= Funciones::saveFile('file_en', $path);
      }
      $item_en->language_id = 2;
      $item_en->save();
    }


    return redirect('/admin/seminars');
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
