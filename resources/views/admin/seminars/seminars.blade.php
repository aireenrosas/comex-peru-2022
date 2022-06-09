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
              <h1 class="titulo-contenido">Seminarios</h1>
            </div>

          </div>
          {!! Form::open(['url' => '/admin/seminars', 'method' => 'GET']) !!}
          <div class= "row panel-search">
            <div class="col-lg-6 col-xs-3 col-md-4 col-sm-12">
              <a class="btn btn-nuevo"  href="{{url('admin/seminars/create')}}"><i class="glyphicon glyphicon-plus"></i> Nuevo</a>
            </div>
          <div class="col-lg-6 col-xs-12 col-md-8 col-sm-12" style="text-align: center">
            <div class="col-xs-8">
              {!! Form::text('filtro_seminars', $request->input('filtro_seminars'),['class' => 'form-control filtro_seminars','placeholder'=> 'Nombre...','id'=>'filtro_seminars'])!!}
            </div>
            <button id="search_seminars" class="btn btn-nuevo" type="submit">Buscar</button>
            <a class="btn btn-nuevo" onclick="clear_input()">Limpiar</a>
          </div>
        </div>
          <div class="portlet-body">
              <div class="table-scrollable table-responsive">
                <div class="pagination-box" align="center" style="width: 100%">
                  {{$seminarios->appends(['filtro_seminars'=>$request->input('filtro_seminars')])->links()}}
                </div>
                  <table class="table table-hover table-bordered" id="seminars">
                    <thead>
                        <tr>
                            <th class="titulo-tabla"> NOMBRE </th>
                            <th class="titulo-tabla"> FECHA </th>
                            <th class="titulo-tabla"> LUGAR </th>
                            <th class="titulo-tabla"> ACTIVO<br> (En Cronograma) </th>
                            <th class="titulo-tabla"> ESTADO<br> (Para inscripciones) </th>
                            <th class="titulo-tabla"> ACCIONES </th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($seminarios as $key)
                        @if($key->active==1)
                          <tr class="danger">
                        @else
                          <tr>
                        @endif

                            <td class="izquierda">{{$key->name}}</td>
                            <td>{{$key->date}}</td>
                            <td>{{$key->place}}</td>
                            @if($key->active==1)
                              <td>Activo</td>
                            @else
                              <td></td>
                            @endif
                            @if($key->state==1)
                              <td>Habilitado</td>
                            @else
                              <td>Deshabilitado</td>
                            @endif
                            <td><a href="{{url('/admin/seminars/'.$key->id.'/edit')}}"><i class="fa fa-pencil ico-editar"></i></a></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div class="pagination-box" align="center" style="width: 100%">
                    {{$seminarios->appends(['filtro_seminars'=>$request->input('filtro_seminars')])->links()}}
                  </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function clear_input(){
$('.filtro_seminars').val('');
$('#search_seminars').click();
}
</script>
@endsection
