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
              <h1 class="titulo-contenido">DataComex</h1>
            </div>
          </div>
          {!! Form::open(['url' => '/admin/datacomexsubcripciones', 'method' => 'GET']) !!}
          <div class= "row panel-search">
            <div class="col-lg-6 col-xs-3 col-md-4 col-sm-12">
            </div>
          <div class="col-lg-6 col-xs-12 col-md-8 col-sm-12" style="text-align: center">
            <div class="col-xs-8">
              {!! Form::text('filtro_susdatacomex', $request->input('filtro_susdatacomex'),['class' => 'form-control filtro_susdatacomex','placeholder'=> 'Nombre...','id'=>'filtro_susdatacomex'])!!}
            </div>
            <button id="search_datacomex" class="btn btn-nuevo" type="submit">Buscar</button>
            <a class="btn btn-nuevo" onclick="clear_input()">Limpiar</a>
          </div>
        </div>
          <div class="portlet-body">
              <div class="table-scrollable">
                <div class="pagination-box" align="center" style="width: 100%">
                  {{$suscriptores->appends(['filtro_susdatacomex'=>$request->input('filtro_susdatacomex')])->links()}}
                </div>
                  <table class="table table-hover  table-bordered" id="datacomex">
                    <thead>
                        <tr>
                            <th class="titulo-tabla">EMPRESA</th>
                            <th class="titulo-tabla">EMAIL</th>
                            <th class="titulo-tabla">TELEFONO</th>
                            <th class="titulo-tabla">NOMBRE</th>
                            <th class="titulo-tabla">CARGO</th>
                            <th class="titulo-tabla">ESTADO</th>
                            <th class="titulo-tabla">AUTORIZA</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($suscriptores as $key)
                         <tr>
                             <td>{!! $key->company !!}</td>
                             <td>{!! $key->email !!}</td>
                             <td>{!! $key->phone !!}</td>
                             <td>{!! $key->name !!}</td>
                             <td>{!! $key->position !!}</td>
                             @if($key->state==1)
                             <td>Habilitado</td>
                             @else <td>Inhabilitado</td>
                             @endif
                             @if($key->authorize==1)
                             <td>Sí</td>
                             @else 
                             <td>No</td>
                             @endif
                         </tr>
                       @endforeach

                    </tbody>
                  </table>
                  <div class="pagination-box" align="center" style="width: 100%">
                    {{$suscriptores->appends(['filtro_susdatacomex'=>$request->input('filtro_susdatacomex')])->links()}}
                  </div>
                    {!!Form::close()!!}
                </div>
          </div>
      </div>
    </div>
</div>
<script>
function clear_input(){
$('.filtro_susdatacomex').val('');
$('#search_datacomex').click();
}
</script>
@endsection
