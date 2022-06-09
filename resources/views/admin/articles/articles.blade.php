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
        <div class="portlet-title tabbable-line panel">
          <div class="caption caption-md">
            <h1 class="titulo-contenido">Artículos</h1>
          </div>
        </div>

        {!! Form::open(['url' => '/admin/articulos', 'method' => 'GET']) !!}
        <div class= "row panel-search">
          <div class="col-xs-12 marginbottom">
              <div class="col-xs-12">
                <a class="btn-nuevo" href="{{url('admin/articulos/create')}}"><i class="glyphicon glyphicon-plus"></i> Nuevo</a>
              </div>
          </div>
        <div class="col-xs-12" style="text-align: center">

          <div class="col-sm-6 col-xs-12">
            <div class="form-group">
              {!! Form::text('filtro_article', $request->input('filtro_article'),['class' => 'form-control filtro_article','placeholder'=> 'Título...','id'=>'filtro_article'])!!}
            </div>
          </div>
          <div class="col-sm-3 col-xs-12">
            <div class="form-group">
              {!! Form::select('filtro_publicacion',$publicaciones, $request->input('filtro_publicacion') ,['class' => 'form-control filtro_article', 'placeholder' => 'Publicación...', 'id'=>'filtro_publicacion'])!!}
            </div>
          </div>
          <div class="col-sm-3 col-xs-12">
            <div class="form-group">
              {!! Form::text('filtro_edicion', $request->input('filtro_edicion'),['class' => 'form-control filtro_article','placeholder'=> 'Edición...','id'=>'filtro_edicion'])!!}
            </div>
          </div>
          <div class="col-md-12" align="right">
            <div class="form-group">
            <button id="search_articles" class="btn-nuevo" type="submit">Buscar</button>
            <a class="btn-nuevo" onclick="clear_input()">Limpiar</a>
              </div>
          </div>

        </div>
        {!!Form::close()!!}
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="actions pull-right" style="margin-bottom:15px;">
              <div class="btn-group ">
                  <a class="btn btn-outline btn-desplegable btn-guardar" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="true"> Acciones Masivas
                      <i class="fa fa-angle-down"></i>
                  </a>
                  <ul class="dropdown-menu pull-right">
                      <li>
                          <a href="javascript:;" class="seleccion-todos item-accion-masiva" data-all="1">Seleccionar Todos</a>
                      </li>
                      <li>
                          <a href="javascript:;" class="seleccion-todos item-accion-masiva" data-all="0">Quitar selección a Todos</a>
                      </li>
                      <li>
                          <a href="javascript:;" class="marcar-privacidad item-accion-masiva" data-privacidad="1" data-mensaje="PRIVADOS" >Marcar seleccionados como privados</a>
                      </li>
                      <li>
                          <a href="javascript:;" class="marcar-privacidad item-accion-masiva" data-privacidad="0" data-mensaje="PÚBLICOS" >Marcar seleccionados como públicos</a>
                      </li>
                      <li>
                          <a href="javascript:;" class="col-md-12 item-accion-masiva">
                            Cambiar fecha de publicación
                            {!! Form::date('fecha_publicacion',null ,['class' => 'form-control input-admin', 'onchange' =>"handler(event);"])!!}
                          </a>
                      </li>

                  </ul>
              </div>
            </div>
        </div>
      </div>
          <div class="portlet-body">
              <div class="table-scrollable table-responsive">
                <div class="pagination-box" align="center" style="width: 100%">
                  {{$articles->appends(['filtro_article'=>$request->input('filtro_article'), 'filtro_publicacion'=>$request->input('filtro_publicacion'), 'filtro_edicion'=>$request->input('filtro_edicion')])->links()}}
                </div>

                  <table class="table table-hover table-bordered " id="article">
                    <thead>
                        <tr>
                            <th>
                              <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline check-masivo">
                                  <input id="checkgeneral" type="checkbox" class="checkboxes" data-set="#article .checkboxes" />
                                  <span></span>
                              </label>
                            </th>
                            <th class="titulo-tabla"> TÍTULO </th>
                            <th class="titulo-tabla"> PUBLICACIÓN </th>
                            <th class="titulo-tabla"> EDICIÓN </th>
                            <th class="titulo-tabla"> FECHA DE PUBLICACIÓN </th>
                            <th class="titulo-tabla"> CREADO POR </th>
                            <th class="titulo-tabla"> FECHA DE CREACIÓN </th>
                            <th class="titulo-tabla"> PRIVACIDAD </th>
                            <th class="titulo-tabla"> ESTADO </th>
                            <th class="titulo-tabla"> ACCIONES </th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($articles as $key)
                         <tr>
                            <td>
                              <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                  <input type="checkbox" class="group-checkable checkbox-article" name="checkbox-article" value="{{$key->id}}" data-set="#sample_1 .checkboxes">
                                  <span></span>
                              </label>
                             </td>
                             <td class="izquierda">{!! $key->title !!}</td>
                             <td>{!! $key->name_es !!}</td>
                             <td>{!! $key->edition !!}</td>
                             <td>{!! $key->published_at !!}</td>
                             <td>{!! $key->autor !!}</td>
                             <td>{!! $key->created_at !!}</td>
                             <td>
                               @if($key->privacity==true)
                                 Privado
                               @else
                                 Público
                               @endif
                             </td>
                             <td id="estado{{$key->id}}">
                               @if($key->is_open==true)
                                 Publicado
                               @else
                                 Borrador
                               @endif
                             </td>
                             <td>
                                <a href="{{url('admin/articulos/'.$key->id.'/edit')}}"><i class="fa fa-pencil ico-editar"></i></a>
                                <a href="#"><i class="fa fa-times ico-editar btn-eliminar" data-id="{{$key->id}}" aria-hidden="true" style="padding-left: 5px;"></i></a>
                              </td>
                         </tr>
                       @endforeach

                    </tbody>
                  </table>


                </div>
                <div class="pagination-box" align="center" style="width: 100%">
                  {{$articles->appends(['filtro_article'=>$request->input('filtro_article'), 'filtro_publicacion'=>$request->input('filtro_publicacion'), 'filtro_edicion'=>$request->input('filtro_edicion')])->links()}}
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
      title: "El artículo se pondrá como borrador. ¿Está seguro que desea continuar?",
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
            url: url + '/admin/articulos/delete',
            data: data,
            type: 'POST',
            success: function(data) {
                $('#estado'+val).text('Borrador');
                console.log(data);

            }
        });
      }
    });

  });
  $(document).on('click', '.marcar-privacidad', function(){
    var articles = [];
    var mensaje= $(this).attr('data-mensaje');
    var privacidad = $(this).attr('data-privacidad');

    $('input[name=checkbox-article]:checked').each(function(){
        articles.push( $(this).val() );
    });
    if(articles.length>0){
          swal({
            title: "",
            text: "Los artículos seleccionados se marcarán como "+mensaje+". ¿Está seguro que desea continuar?",
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
              data.articles = articles;
              data.privacidad = privacidad;

                  $.ajax({
                      type: "POST",
                      url: url + '/admin/articulos/changeprivacity',
                      data: data,
                      success: function(data){
                        swal({
                          title: "",
                          text: "Los artículos fueron marcados como "+mensaje+".",
                          html: true,
                          });
                        location.reload();
                      },
                      error: function(){
                          console.log(data);
                          swal({
                            title: "",
                            text: 'No se pudo realizar.',
                            html: true,
                            });
                      }
                  });
            }
          });

        }
        else{
          swal({
            title: "",
            text: 'Debe seleccionar al menos un artículo.',
            html: true,
            });
        }


    });

    $("#checkgeneral").change(function () {
        if ($(this).is(':checked')) {
            $(".checkbox-article").prop('checked', true);
        }
        else
        {
            $(".checkbox-article").prop('checked', false);
        }
    });
    $(".seleccion-todos").click(function () {
        if ($(this).attr('data-all')=="1") {
            $(".checkbox-article").prop('checked', true);
            $("#checkgeneral").prop('checked', true);
        }
        else
        {
            $(".checkbox-article").prop('checked', false);
            $("#checkgeneral").prop('checked', false);
        }
    });
    function handler(e){
      var fecha = e.target.value;
      var articles = [];
      var input = e.target;
      $('input[name=checkbox-article]:checked').each(function(){
          articles.push( $(this).val() );
      });
      if(articles.length>0){
        swal({
          title: "",
          text: "La fecha de publicación de los artículos seleccionados, se actualizará a "+fecha+". ¿Está seguro que desea continuar?",
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
                data.articles = articles;
                data.fecha = fecha;

            $.ajax({
                url: url + '/admin/articulos/updatepublicationdate',
                data: data,
                type: 'POST',
                success: function(data) {
                  swal({
                    title: "",
                    text: "La fecha de publicación ha sido actualizada correctamente.",
                    html: true,
                    });
                  location.reload();

                }
            });
          }
          else{
            $(input).replaceWith('<input class="form-control input-admin" onchange="handler(event);" name="fecha_publicacion" type="date">');
          }
        });
      }
      else{
        swal({
          title: "",
          text: 'Debe seleccionar al menos un artículo.',
          html: true,
          });
          $(input).replaceWith('<input class="form-control input-admin" onchange="handler(event);" name="fecha_publicacion" type="date">');
      }
    }
</script>
<script>
    function clear_input(){
      $('.filtro_article').val('');
      $('#search_articles').click();
    }

    $(document).on('click', '.actions .dropdown-menu', function (e) {
      e.stopPropagation();
    });
/*
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $('#article').DataTable( {
      "lengthMenu": [[50, 100, -1], [ 50, 100, "All"]],
      "order": [[ 1, "desc" ]],
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
  } );
});*/
</script>
@endsection
