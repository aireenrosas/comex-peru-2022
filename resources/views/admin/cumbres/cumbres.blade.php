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
              <h1 class="titulo-contenido">Cumbres</h1>
            </div>
            <div class="cont-botonnuevo">
              <a class="btn btn-nuevo pull-right" href="{{url('admin/cumbres/create')}}"><i class="glyphicon glyphicon-plus"></i> Nuevo</a>
            </div>
          </div>
          <div class="portlet-body">
              <div class="table-scrollable table-responsive">
                  <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="titulo-tabla"> NOMBRE </th>
                            <th class="titulo-tabla"> FECHA </th>
                            <th class="titulo-tabla"> HORA </th>
                            <th class="titulo-tabla"> LUGAR </th>
                            <th class="titulo-tabla"> ACCIONES </th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($cumbres as $key)
                        <tr id="cumbre{{$key->id}}">
                            <td class="izquierda">{{$key->name}}</td>
                            <td>{{$key->date}}</td>
                            <td>{{$key->time}}</td>
                            <td>{{$key->place}}</td>
                            <td>
                              <a href="{{url('admin/cumbres/'.$key->id.'/edit')}}"><i class="fa fa-pencil ico-editar"></i></a>
                              <a href="#"><i class="fa fa-times ico-editar btn-eliminar" data-id="{{$key->id}}" aria-hidden="true" style="padding-left: 5px;"></i></a>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).on('click', '.btn-eliminar', function(){
    var button = $(this);
    var val = $(button).attr('data-id');
    swal({
      title: "¿Desea eliminar este item?",
      text: "",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "SÍ",
      cancelButtonText: "CANCELAR",
      closeOnConfirm: true,
      closeOnCancel: true
    },
    function(isConfirm){
      if (isConfirm) {

        var data = {};
            data._token = $("meta[name='csrf-token']").attr('content');
            data.id = val;

        $.ajax({
            url: url + '/admin/cumbres/deletesummit',
            data: data,
            type: 'POST',
            success: function(data) {
              if(data=='success'){
                $('#cumbre'+val).remove();

                swal({
                   title: "",
                   text: 'El item se eliminó correctamente.',
                   html: true,
                   confirmButtonText: "CERRAR",
                   });
              }
              else {
                swal({
                   title: "",
                   text: 'No se pudo eliminar.',
                   html: true,
                   confirmButtonText: "CERRAR",
                   });
              }


            },
            error: function(data){
              swal({
                 title: "",
                 text: 'No se pudo eliminar.',
                 html: true,
                 confirmButtonText: "CERRAR",
                 });
            }
        });
      }
    });

  });
</script>
@endsection
