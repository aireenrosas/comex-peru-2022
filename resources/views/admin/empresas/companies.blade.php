@extends('app.appadmin')
@section('style')
<link href="<?php echo URL::asset('css/home.css'); ?>" rel="stylesheet" type="text/css" />
@endsection
@section('script')
@endsection
@section('content')

<div class="row">
  <div class="col-md-12 cont-tabla">
      <div class="portlet light ">
          <div class="portlet-title tabbable-line">
            <div class="caption caption-md">
              <h1 class="titulo-contenido">Empresas</h1>
            </div>
          </div>
          {!! Form::open(['url' => '/admin/empresas', 'method' => 'GET']) !!}
          <div class= "row panel-search">
            <div class="col-lg-6 col-xs-3 col-md-4 col-sm-12">
              <a class="btn btn-nuevo" href="{{url('admin/empresas/create')}}"><i class="glyphicon glyphicon-plus"></i> Nuevo</a>
            </div>
          <div class="col-lg-6 col-xs-12 col-md-8 col-sm-12" style="text-align: center">
            <div class="col-xs-8">
              {!! Form::text('filtro_empresas', $request->input('filtro_empresas'),['class' => 'form-control filtro_empresas','placeholder'=> 'Nombre...','id'=>'filtro_empresas'])!!}
            </div>
            <button id="search_empresas" class="btn btn-nuevo" type="submit">Buscar</button>
            <a class="btn btn-nuevo" onclick="clear_input()">Limpiar</a>
          </div>
        </div>
          <div class="portlet-body">
              <div class="table-scrollable table-responsive">
                <div class="pagination-box" align="center" style="width: 100%">
                  {{$empresas->appends(['filtro_empresas'=>$request->input('filtro_empresas')])->links()}}
                </div>
                  <table class="table table-hover table-bordered" id="example" >
                    <thead>
                        <tr>
                            <th class="titulo-tabla"> RUC </th>
                            <th class="titulo-tabla"> NOMBRE </th>
                            <th class="titulo-tabla"> TIPO </th>
                              <th class="titulo-tabla"> ACCIONES </th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($empresas as $key)

                        <tr>
                            <td>{!! $key->RUC !!}</td>
                            <td style="text-align: left">{!! $key->name !!}</td>
                            <td>{!! $key->tipo !!}</td>
                            <td><a href="{{url('admin/empresas/'.$key->id.'/edit')}}"><i class="fa fa-pencil ico-editar"></i></a></td>
                        </tr>
                         @endforeach
                    </tbody>
                  </table>
                  <div class="pagination-box" align="center" style="width: 100%">
                    {{$empresas->appends(['filtro_empresas'=>$request->input('filtro_empresas')])->links()}}
                  </div>
                {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function clear_input(){
$('.filtro_empresas').val('');
$('#search_empresas').click();
}
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endsection
