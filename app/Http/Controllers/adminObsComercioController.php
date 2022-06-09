<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TradeBarrier;
use Funciones;
use App;
use Auth;

class adminObsComercioController extends Controller
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
      $solicitudes = TradeBarrier::orderBy('id', 'desc')
        ->filterByName($request->input('filtro_obstaculos'))
        ->paginate(50);

      return view('admin.obstaculos_comercio.solicitudes')
        ->with('solicitudes', $solicitudes)
        ->with('request', $request);
  }

}
