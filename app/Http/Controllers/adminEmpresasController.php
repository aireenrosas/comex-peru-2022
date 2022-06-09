<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\CompanyType;
use Validator;

class adminEmpresasController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
        $empresas= Company::select(
           'companies.id'
          ,'companies.name'
          ,'companies.RUC'
          ,'ct.name as tipo'
          )
        ->join('companies_type as ct','ct.id','=','companies.type')
        ->filterByName($request->input('filtro_empresas'))
        ->orderBy('companies.name')
        ->paginate(25);

        return view('admin.empresas.companies')
        ->with('empresas', $empresas)
        ->with('request', $request);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $tipos = CompanyType::pluck('name', 'id');

      return view('admin.empresas.newcompany')
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

        $empresaFormData = $request->all();

        $rules = [
          'name' => 'required|max:255',
          'RUC' => 'required|max:11|min:11|unique:companies'
        ];

        $validation = Validator::make($request->all(), $rules);
        // if validation fails
        if($validation->fails())
        {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $empresa = Company::create($empresaFormData);
        return redirect('/admin/empresas');
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
    $empresa = Company::where('id', '=', $id)
    ->first();
    $tipos = CompanyType::pluck('name', 'id');

    return view('admin.empresas.editcompany')
    ->with('empresa',$empresa)
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
      $rules = [
        'name' => 'required|max:255',
        'RUC' => 'required|max:11|min:11|unique:companies,RUC,'.$id
      ];
      // validate the user form data
      $validation = Validator::make($request->all(), $rules);
      // if validation fails
      if($validation->fails())
      {
          return redirect()->back()->withErrors($validation)->withInput();
      }
      else{
        $empresa = Company::find($id);
        $empresa->RUC = $request->input('RUC');
        $empresa->name = $request->input('name');
        $empresa->type = $request->input('type');
        $empresa->save();
      }

      return redirect('/admin/empresas');
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
