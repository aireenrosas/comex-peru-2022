<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Conexiones;
use DB;
use Auth;
use Funciones;
use App;
use App\TradeBarrier;
use Mail;

class obstaculoscomercialesController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('socios');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idioma='es')
    {
        $ruta = Funciones::getRuta($idioma);

        return view('front.ver.obstaculoscomerciales')
          ->with('ruta', $ruta);
    }

    /**
     * Send email and store data on trade barriers database table
     *
     * @return \Illuminate\Http\Response
     */
    public function sendproblematic(Request $request)
    {
      $nuevo = new TradeBarrier();
      $nuevo->name = $request->input('nombre');
      $nuevo->lastname = $request->input('apellido');
      $nuevo->email = $request->input('email');
      $nuevo->phone = $request->input('telefono');
      $nuevo->company = $request->input('empresa');
      $nuevo->description = $request->input('descripcion');
      $nuevo->save();

      $data = array('nombre'=> $request->input('nombre'),
          'apellido'=> $request->input('apellido'),
          'email'=> $request->input('email'),
          'telefono'=> $request->input('telefono'),
          'empresa'=> $request->input('empresa'),
          'descripcion'=> $request->input('descripcion')
          );
      // Path or name to the blade template to be rendered
      $template_path = 'mails.obstaculosalcomercio';

      Mail::send($template_path, $data, function($message) {
          // Set the receiver and subject of the mail.
          $message->to('consultoria@comexperu.org.pe', '')->subject('Obstáculos al Comercio COMEXPERU');
          // Set the sender
          $message->from('consultoria@comexperu.org.pe','usuario');
      });
      return redirect()->back()->with('status', 'OK');
    }
}
