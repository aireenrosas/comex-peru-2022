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
              <h3 class="titulo-contenido">Usuarios</h3>
            </div>
          </div>
          {!! Form::open(['url' => '/admin/usuarios', 'method' => 'GET']) !!}
          <div class= "row panel-search">
            <div class="col-lg-6 col-xs-3 col-md-4 col-sm-12">
              <a class="btn btn-nuevo" href="{{url('admin/usuarios/create')}}"><i class="glyphicon glyphicon-plus"></i> Nuevo</a>
            </div>
          <div class="col-lg-6 col-xs-12 col-md-8 col-sm-12" style="text-align: center">
            <div class="col-xs-8">
              {!! Form::text('filtro_users', $request->input('filtro_users'),['class' => 'form-control filtro_users','placeholder'=> 'Nombre...','id'=>'filtro_users'])!!}
            </div>
            <button id="search_users" class="btn btn-nuevo" type="submit">Buscar</button>
            <a class="btn btn-nuevo" onclick="clear_input()">Limpiar</a>
          </div>
        </div>
          <div class="portlet-body">
              <div class="table-scrollable table-responsive">
                <div class="pagination-box" align="center" style="width: 100%">
                  {{$usuarios->appends(['filtro_users'=>$request->input('filtro_users')])->links()}}
                </div>
                  <table class="table table-bordered" id="example" >
                    <thead>
                        <tr>
                            <th class="titulo-tabla"> ID </th>
                            <th class="titulo-tabla"> ROL </th>
                            <th class="titulo-tabla"> NOMBRE </th>
                            <th class="titulo-tabla"> USUARIO </th>
                            <th class="titulo-tabla"> PASSWORD </th>
                            <th class="titulo-tabla"> RUC </th>
                            <th class="titulo-tabla"> EMPRESA </th>
                            <th class="titulo-tabla"> ESTADO </th>
                            <th class="titulo-tabla"> ACCIONES </th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($usuarios as $key)
                       @if($key->state==2)
                       <?php
                       $estilo='desactivo';
                       ?>
                       @else
                       <?php
                       $estilo= '';
                       ?>
                       @endif
                        <tr class="{{$estilo}}">
                            <td>{!! $key->id !!}</td>
                            <td>{!! $key->tipo !!}</td>
                            <td style="text-align: left">{!! $key->name !!}
                              <a class="test" data-toggle="tooltip" title="{!! $key->description !!}"><i class="glyphicon glyphicon-info-sign informacion"></i></a>
                            </td>
                            <td>{!! $key->login !!}</td>
                            <td>{!! $key->password_no_encriptado !!}</td>
                            <td>{!! $key->ruc !!}</td>
                            <td>{!! $key->empresa !!}</td>
                            @if($key->state==1)
                            <td>Activo</td>
                            @else
                            <td>Inactivo</td>
                            @endif

                            <td><a href="{{url('admin/usuarios/'.$key->id.'/edit')}}"><i class="fa fa-pencil ico-editar"></i></a></td>
                        </tr>
                         @endforeach
                    </tbody>
                  </table>
                  <div class="pagination-box" align="center" style="width: 100%">
                    {{$usuarios->appends(['filtro_users'=>$request->input('filtro_users')])->links()}}
                  </div>
                {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function clear_input(){
$('.filtro_users').val('');
$('#search_users').click();
}
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();


    /*
    $('#example').DataTable( {
      "lengthMenu": [[50, 100, -1], [ 50, 100, "All"]],
      "order": [[ 0, "desc" ]],
      "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }
  } );*/
});
</script>
@endsection
