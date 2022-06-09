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
              <h1 class="titulo-contenido">Obstáculos al comercio</h1>
            </div>
          </div>
          {!! Form::open(['url' => '/admin/obstaculosalcomercio', 'method' => 'GET']) !!}
          <div class= "row panel-search">
            <div class="col-lg-6 col-xs-3 col-md-4 col-sm-2">

            </div>
          <div class="col-lg-6 col-xs-12 col-md-8 col-sm-10" style="text-align: center">
            <div class="col-xs-8">
              {!! Form::text('filtro_obstaculos', $request->input('filtro_obstaculos'),['class' => 'form-control filtro_obstaculos','placeholder'=> 'Email...','id'=>'filtro_obstaculos'])!!}
            </div>
            <button id="search_obstaculos" class="btn btn-nuevo" type="submit">Buscar</button>
            <a class="btn btn-nuevo" onclick="clear_input()">Limpiar</a>
          </div>
        </div>
          <div class="portlet-body">
              <div class="table-scrollable">
                <div class="pagination-box" align="center" style="width: 100%">
                  {{$solicitudes->appends(['filtro_obstaculos'=>$request->input('filtro_obstaculos')])->links()}}
                </div>
                  <table class="table table-hover table-bordered" id="obstaculos">
                    <thead>
                        <tr>
                            <th class="titulo-tabla"> NOMBRES</th>
                            <th class="titulo-tabla"> APELLIDOS</th>
                            <th class="titulo-tabla"> EMPRESA</th>
                            <th class="titulo-tabla"> EMAIL</th>
                            <th class="titulo-tabla"> TELÉFONO</th>
                            <th class="titulo-tabla"> DESCRIPCIÓN</th>
                            <th class="titulo-tabla"> FECHA</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($solicitudes as $key)
                         <tr>
                           <td>{!! $key->name !!}</td>
                           <td>{!! $key->lastname !!}</td>
                           <td>{!! $key->company !!}</td>
                           <td>{!! $key->email !!}</td>
                           <td>{!! $key->phone !!}</td>
                           <td>{!! $key->description !!}</td>
                           <td>{!! $key->created_at !!}</td>
                         </tr>
                       @endforeach

                    </tbody>
                  </table>
                  <div class="pagination-box" align="center" style="width: 100%">
                    {{$solicitudes->appends(['filtro_obstaculos'=>$request->input('filtro_obstaculos')])->links()}}
                  </div>
                    {!!Form::close()!!}
                </div>
          </div>
      </div>
    </div>
</div>
<script>
function clear_input(){
$('.filtro_obstaculos').val('');
$('#search_obstaculos').click();
}
</script>
@endsection
