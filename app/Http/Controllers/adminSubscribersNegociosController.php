<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NegociosSubscription;
use Funciones;
use App;
use Auth;

class adminSubscribersNegociosController extends Controller
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
      $suscriptores = NegociosSubscription::orderBy('id', 'desc')
        ->filterByName($request->input('filtro_susnegocios'))
        ->paginate(25);

      return view('admin.suscriptores.suscriptoresnegocios')
        ->with('suscriptores', $suscriptores)
        ->with('request', $request);
  }

}
