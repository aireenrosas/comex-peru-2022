<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publication;
use App\PublicationType;
use Funciones;
use App;
use Auth;
use App\Article;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class adminPublicacionesController extends Controller
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
      $publications = Publication::leftjoin('publications_type', 'publications_type.id', '=', 'publications.type_id')
        ->select('publications_type.name as type', 'publications.id','publications.privacity', 'publications.name_es', 'publications.name_en')
        ->get();

      return view('admin.publications.publications')
        ->with('publications', $publications);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $tipos = PublicationType::get();

      return view('admin.publications.newpublication')
        ->with('tipos', $tipos);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      if(!$request->input('privacity')){
        $privacity=0;
      }else{
        $privacity=1;
      }

      $directory = Funciones::simplicar_string($request->input('name_es'));
      File::makeDirectory('upload/articles/'.$directory);
      $item = new Publication();
      $item->name_es = $request->input('name_es');
      $item->name_en = $request->input('name_en');
      $item->privacity = $privacity;
      $item->directory = $directory;
      $item->type_id = $request->input('type');
      $item->save();



      return redirect('/admin/publicaciones');
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
      $publication = Publication::where('id', '=', $id)
        ->first();
      $tipos = PublicationType::pluck('name', 'id')->toArray();

      return view('admin.publications.editpublication')
        ->with('publication',$publication)
        ->with('tipos', $tipos);

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
      if(!$request->input('privacity')){
        $privacity=0;
      }else{
        $privacity=1;
      }

      $publication= Publication::where('id','=', $id)
        ->first();
      $publication->name_es = $request->input('name_es');
      $publication->name_en = $request->input('name_en');
      $publication->privacity = $privacity;
      $publication->type_id = $request->input('type');
      $publication->save();

      return redirect('/admin/publicaciones');
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
  public function deletePublication(Request $request)
  {

      $id = $request->input('id');
      $articulos_relacionados = Article::where('publication_id', '=', $id)->get();

      if(count($articulos_relacionados)>0){
        return 'existe';
      }
      else{
        $item =Publication::find($id);
        $item->delete();

        return 'success';
      }
  }
}
