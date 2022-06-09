<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\SliderLanguage;
use Funciones;
use App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Auth;

class adminSlidersController extends Controller
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
      $sliders = Slider::leftjoin('slider_languages', 'slider_languages.slider_id', 'sliders.id')
        ->select('sliders.id', 'sliders.image', 'slider_languages.title')
        ->where('slider_languages.language_id', '=', 1)
        ->orwhere('slider_languages.language_id', '=', null)
        ->orderBy('sliders.id')
        ->get();

      return view('admin.sliders.sliders')
        ->with('sliders', $sliders);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('admin.sliders.newslider');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $path = 'upload/sliders/';
    $user_id = Auth::user()->id;

    $slider = new Slider();
    $slider->image= Funciones::saveFile('file_slider', $path);
    $slider->created_by = $user_id;
    $slider->updated_by = $user_id;
    $slider->save();

    $titulo_es = $request->input('title_es');
    $texto_es = $request->input('text_es');
    $boton_es = strtoupper($request->input('button_text_es'));
    $url_es = $request->input('url_es');

    $titulo_en = $request->input('title_en');
    $texto_en = $request->input('text_en');
    $boton_en = strtoupper($request->input('button_text_en'));
    $url_en = $request->input('url_en');

    if($titulo_es || $texto_es || $boton_es || $url_es )
    {
      $slider_es = new SliderLanguage();
      $slider_es->slider_id = $slider->id;
      $slider_es->language_id = 1;
      $slider_es->title = $titulo_es;
      $slider_es->text = $texto_es;
      $slider_es->button_text = $boton_es;
      $slider_es->url = $url_es;
      $slider_es->save();
    }

    if($titulo_en || $texto_en || $boton_en || $url_en )
    {
      $slider_en = new SliderLanguage();
      $slider_en->slider_id = $slider->id;
      $slider_en->language_id = 2;
      $slider_en->title = $titulo_en;
      $slider_en->text = $texto_en;
      $slider_en->button_text = $boton_en;
      $slider_en->url = $url_en;
      $slider_en->save();
    }

    return redirect('/admin/sliders');
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
      $slider = Slider::where('id', '=', $id)->first();
      $slider_es = SliderLanguage::where('slider_id', '=', $slider->id)
        ->where('language_id', '=', 1)
        ->first();
      $slider_en = SliderLanguage::where('slider_id', '=', $slider->id)
        ->where('language_id', '=', 2)
        ->first();

      return view('admin.sliders.editslider')
        ->with('slider', $slider)
        ->with('slider_es', $slider_es)
        ->with('slider_en', $slider_en);
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
    $path = 'upload/sliders/';
    $user_id = Auth::user()->id;

    $slider = Slider::find($id);
    if (Input::hasFile('file_slider'))
    {
      $slider->image= Funciones::saveFile('file_slider', $path);
    }
    $slider->updated_by = $user_id;
    $slider->save();

    $titulo_es = $request->input('title_es');
    $texto_es = $request->input('text_es');
    $boton_es = strtoupper($request->input('button_text_es'));
    $url_es = $request->input('url_es');

    $titulo_en = $request->input('title_en');
    $texto_en = $request->input('text_en');
    $boton_en = strtoupper($request->input('button_text_en'));
    $url_en = $request->input('url_en');

    if($titulo_es || $texto_es || $boton_es || $url_es )
    {
      $slider_es = SliderLanguage::where('slider_id', '=', $id)
        ->where('language_id', '=', 1)
        ->first();

      if($slider_es){
        $slider_es = SliderLanguage::find($slider_es->id);
        $slider_es->title = $titulo_es;
        $slider_es->text = $texto_es;
        $slider_es->button_text = $boton_es;
        $slider_es->url = $url_es;
        $slider_es->save();
      }
      else{
        $slider_es = new SliderLanguage();
        $slider_es->slider_id = $id;
        $slider_es->language_id = 1;
        $slider_es->title = $titulo_es;
        $slider_es->text = $texto_es;
        $slider_es->button_text = $boton_es;
        $slider_es->url = $url_es;
        $slider_es->save();
      }

    }

    if($titulo_en || $texto_en || $boton_en || $url_en )
    {
      $slider_en = SliderLanguage::where('slider_id', '=', $id)
        ->where('language_id', '=', 2)
        ->first();
      if($slider_en){
        $slider_en = SliderLanguage::find($slider_en->id);
        $slider_en->title = $titulo_en;
        $slider_en->text = $texto_en;
        $slider_en->button_text = $boton_en;
        $slider_en->url = $url_en;
        $slider_en->save();
      }
      else {
        $slider_en = new SliderLanguage();
        $slider_en->slider_id = $id;
        $slider_en->language_id = 2;
        $slider_en->title = $titulo_en;
        $slider_en->text = $texto_en;
        $slider_en->button_text = $boton_en;
        $slider_en->url = $url_en;
        $slider_en->save();
      }

    }

    return redirect('/admin/sliders');
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
  public function deleteSlider(Request $request)
  {
      $id = $request->input('id');
      $slider_lang = SliderLanguage::where('slider_id', '=', $id)->delete();
      $slider = Slider::find($id);
      $slider->delete();

      return 'success';

  }
}
