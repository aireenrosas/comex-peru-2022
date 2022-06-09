<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use App\Roles;
use Funciones;
use App;
use App\Company;

class adminUsuariosController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
        $usuarios= User::select(
           'users.id'
          ,'users.name'
          ,'users.rol_id'
          ,'users.password'
          ,'users.password_no_encriptado'
          ,'users.login'
          ,'users.ruc'
          ,'users.state'
          ,'users.description'
          ,'r.name as tipo'
          ,'c.name as empresa'
          )
        ->join('roles as r','r.id','=','users.rol_id')
        ->leftjoin('companies as c','c.RUC','=','users.ruc')
        ->filterByName($request->input('filtro_users'))
        ->orderBy('users.id')
        ->paginate(25);



        return view('admin.usuarios.usuarios')
        ->with('usuarios', $usuarios)
        ->with('request', $request);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $roles = Roles::select(
                       'id'
                      ,'name'
                      )
      ->pluck('name', 'id');

    //  $empresas = Company::pluck('name', 'RUC');
      $empresas = Company::select('name','RUC')
      ->orderBy('name', 'asc')
      ->pluck('name', 'RUC');
      return view('admin.usuarios.newusuario')
      ->with('roles', $roles)
      ->with('empresas', $empresas);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
        // get the form data for the user
        $userFormData = $request->all();
        $activo= $request->input('onoffswitch');
        // write the validation rules for your form
        $rules = [
          'rol_id' => 'required',
          'name' => 'required|max:255',
          'login' => 'required|max:255|unique:users',
          'ruc' => 'required',
          'password' => 'required|min:6',
          'description' => 'required|max:50',
        ];
        // validate the user form data
        $validation = Validator::make($request->all(), $rules);
        // if validation fails
        if($validation->fails())
        {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $userFormData['password_no_encriptado'] = $userFormData['password'];
        $userFormData['password'] = bcrypt($userFormData['password']);

        $userFormData['rol_id']= (int)$userFormData['rol_id'];

        if($activo=='on'){
          $userFormData['state'] = 1;
        }
        else {
          $userFormData['state'] = 2;
        }
        $user = User::create($userFormData);
        return redirect('/admin/usuarios');
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
    $usuario = User::where('id', '=', $id)
    ->first();
    $roles = Roles::select(
                     'id'
                    ,'name'
                    )
        ->pluck('name', 'id');

    $empresas = Company::select('name','RUC')
    ->orderBy('name', 'asc')
    ->pluck('name', 'RUC');

    return view('admin.usuarios.editusuario')
    ->with('usuarios',$usuario)
    ->with('empresas', $empresas)
    ->with('roles', $roles);
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
    $rules = [
      'rol_id' => 'required',
      'name' => 'required|max:255',
      'login' => 'required|max:255',
      'ruc' => 'required',
    //  'password' => 'required|min:6',
      'description' => 'required|max:50',
    ];
    // validate the user form data
    $validation = Validator::make($request->all(), $rules);
    // if validation fails
    if($validation->fails())
    {
        return redirect()->back()->withErrors($validation)->withInput();
    }

    $pass= $request->input('check');

     $usuario= User::where('id','=', $id)
     ->first();
     $usuario->name = $request->input('name');
     $usuario->login = $request->input('login');
     $usuario->description = $request->input('description');
     $usuario->rol_id = $request->input('rol_id');
     $usuario->ruc = $request->input('ruc');
     if($request->input('onoffswitch')=='on')
     {
        $usuario->state =1;
     }
     else {
        $usuario->state =2;
     }
     if($pass==true)
     {
       $usuario->password = bcrypt($request->input('password'));
       $usuario->password_no_encriptado = $request->input('password');
     }

    $usuario->save();
    return redirect('/admin/usuarios');
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
