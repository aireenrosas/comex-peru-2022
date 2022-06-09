<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SemanarioSubscription;
use Funciones;
use App;
use Auth;

class adminSubscribersSemanarioController extends Controller
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
      $suscriptores = SemanarioSubscription::orderBy('id', 'desc')
        ->filterByName($request->input('filtro_sussemanario'))
        ->paginate(25);

      return view('admin.suscriptores.suscriptoressemanarios')
        ->with('suscriptores', $suscriptores)
        ->with('request', $request);
  }

}
