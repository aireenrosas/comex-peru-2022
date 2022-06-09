<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\ArticleTag;
use Funciones;
use App;

class adminTagsController extends Controller
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
      $tags = Tag::get();

      return view('admin.tags.tags')
        ->with('tags', $tags);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('admin.tags.newtag');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $item = new Tag();
    $item->name_es = $request->input('name_es');
    $item->name_en = $request->input('name_en');
    $item->save();

    return redirect('/admin/tags');
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
    $tag = Tag::where('id', '=', $id)
    ->first();
    return view('admin.tags.edittag')
    ->with('tag',$tag);
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

    $edittag= Tag::find($id);
    $edittag->name_es = $request->input('name_es');
    $edittag->name_en = $request->input('name_en');
    $edittag->save();
    return redirect('/admin/tags');
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
  public function deleteTag(Request $request)
  {
      $id = $request->input('id');
      $tags_relacionados = ArticleTag::where('tag_id', '=', $id)->get();

      if(count($tags_relacionados)>0){
        return 'existe';
      }
      else{
        $item =Tag::find($id);
        $item->delete();

        return 'success';
      }

  }
}
