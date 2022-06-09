<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;
use Funciones;
use App;
use Auth;

class adminSubscribersController extends Controller
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
      $suscriptores = Subscriber::orderBy('id', 'desc')
        ->filterByName($request->input('filtro_sus'))
        ->paginate(50);
        
      return view('admin.suscriptores.suscriptores')
        ->with('suscriptores', $suscriptores)
        ->with('request', $request);
  }

}
