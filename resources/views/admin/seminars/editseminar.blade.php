@extends('app.appadmin')
@section('style')
<link href="<?php echo URL::asset('css/home.css'); ?>" rel="stylesheet" type="text/css" />

@endsection
@section('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="<?php echo URL::asset('js/validacionesadmin.js'); ?>" type="text/javascript"></script>
@endsection
@section('content')

<div class="row">
  <div class="col-md-12 cont-tabla">
      <div class="portlet light ">
          <div class="portlet-title tabbable-line">
            <div class="caption caption-md">
                <h1 class="titulo-editar">Editar Seminario</h1>
            </div>
          </div>
          {!! Form::open(['url' => '/admin/seminars/'.$seminario->id, 'method' => 'PATCH', 'files' => 'true','id' =>'seminars'])!!}
          <div class="portlet-body">
              <div class="container-tabs">
                <ul class="nav nav-tabs">
                  <li class="active" id="espanol"><a class="tabs-color" href="#" id="lang_es" name="language" value="ES">ESPAÑOL</a></li>
                  <li id="ingles"><a class="tabs-color" href="#" id="lang_en" name="language" value="EN">ENGLISH</a></li>
                </ul>
              </div>
              <br>
              <div class="col-md-8">
                <div class="section-spanish">
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Nombre</label>
                    @if($seminario_es)
                    {!! Form::text('name_es',$seminario_es->name ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el nombre del seminario', 'required'])!!}
                    @else
                    {!! Form::text('name_es',null ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el nombre del seminario', 'required'])!!}
                    @endif
                  </div>
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Título para CRONOGRAMA</label>
                    @if($seminario_es)
                    {!! Form::text('title_es',$seminario_es->title ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el título del seminario', 'required'])!!}
                    @else
                    {!! Form::text('title_es',null ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el nombre del seminario', 'required'])!!}
                    @endif
                  </div>
                  <div class="col-sm-6 form-group">
                    <label class="label-input-format label-titulo">Archivo</label>
                    @if(isset($seminario_es))
                      <a href="{{url('upload/seminars/'.$seminario_es->file)}}" target="_blank" class="line-height40">{{$seminario_es->file}}</a><br>
                    @endif
                    {{-- <input type="file" class="file" name="file_es">
                    <div class="col-md-12">
                      <p class="mensaje hidden">*El tamaño del archivo no debe superar los 2MB de tamaño.</p>
                    </div>
                  </div>
                  <div class="col-sm-6 form-group"> --}}
                    <input class="hidden" type="checkbox" name="archivo_manual_es" value="1" id="archivo_manual_es" checked>
                    @if(isset($seminario_es))
                    {!! Form::text('name_file_es',$seminario_es->file ,['id'=>'name_file_es', 'class' => 'form-control input-admin', 'placeholder' => ''])!!}
                    @else
                      {!! Form::text('name_file_es',null,['id'=>'name_file_es', 'class' => 'form-control input-admin', 'placeholder' => ''])!!}
                    @endif
                  </div>
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Lugar</label>
                    @if($seminario_es)
                    {!! Form::text('place_es',$seminario_es->place ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el lugar del seminario', 'required'])!!}
                    @else
                    {!! Form::text('place_es',null ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el lugar del seminario', 'required'])!!}
                    @endif
                  </div>
                </div>
                <div class="section-english hidden">
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Nombre</label>
                    @if($seminario_en)
                    {!! Form::text('name_en',$seminario_en->name ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el nombre del seminario', 'required'])!!}
                    @else
                    {!! Form::text('name_en',null ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el nombre del seminario', 'required'])!!}
                    @endif
                  </div>
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Título para CRONOGRAMA</label>
                    @if($seminario_en)
                    {!! Form::text('title_en',$seminario_en->title ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el título del seminario', 'required'])!!}
                    @else
                    {!! Form::text('title_en',null ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el nombre del seminario', 'required'])!!}
                    @endif
                  </div>
                  <div class="col-sm-6 form-group">
                    <label class="label-input-format label-titulo">Archivo</label>
                    @if(isset($seminario_en))
                      <a href="{{url('upload/seminars/'.$seminario_en->file)}}" target="_blank" class="line-height40">{{$seminario_en->file}}</a><br>
                    @endif
                    {{-- <input type="file" class="file" name="file_en" >
                    <div class="col-md-12">
                      <p class="mensaje hidden">*El tamaño del archivo no debe superar los 2MB de tamaño.</p>
                    </div>
                  </div>
                  <div class="col-sm-6 form-group"> --}}
                  <input class="hidden" type="checkbox" name="archivo_manual_en" value="1" id="archivo_manual_en" checked>
                  @if(isset($seminario_en))
                  {!! Form::text('name_file_en',$seminario_en->file ,['id'=>'name_file_en', 'class' => 'form-control input-admin', 'placeholder' => ''])!!}
                  @else
                    {!! Form::text('name_file_en',null,['id'=>'name_file_en', 'class' => 'form-control input-admin', 'placeholder' => ''])!!}
                  @endif
                  </div>
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Lugar</label>
                    @if($seminario_en)
                    {!! Form::text('place_en',$seminario_en->place ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el lugar del seminario'])!!}
                    @else
                    {!! Form::text('place_en',null ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el lugar del seminario'])!!}
                    @endif
                </div>
                </div>

                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo" style="width: 100%;">Fecha</label>
                  <i class="fa fa-calendar ico-calendar" aria-hidden="true"></i><input class="form-calendar" type="date"  name="date" value="{{$seminario->date}}" required/>

                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo" style="width: 100%;">Hora</label>
                  <input class="form-calendar" type="time"  name="time" value="{{$seminario->time}}" />

                </div>

                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Activo (En el calendario)</label>
                  @if($seminario->active==0)
                  <?php
                  $texto= 'unchecked';
                  ?>
                  @else
                  <?php
                  $texto= 'checked';
                  ?>
                  @endif
                  <div class="col-md-12 col-xs-12" style="padding-left: 0px;">
                    <div class="onoffswitch">
                      <input type="checkbox" name="active" class="onoffswitch-checkbox" id="myonoffswitch" value="{{$seminario->active}}" {{$texto}}>
                      <label class="onoffswitch-label" for="myonoffswitch">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Estado (Para inscripciones)</label>
                  @if($seminario->state==1)
                  <?php
                  $texto= 'checked';
                  ?>
                  @else
                  <?php
                  $texto= 'unchecked';
                  ?>
                  @endif
                  <div class="col-md-12 col-xs-12" style="padding-left: 0px;">
                    <div class="onoffswitch">
                      <input type="checkbox" name="state" class="onoffswitch-checkbox" id="switch_estado" value="{{$seminario->state}}" {{$texto}}>
                      <label class="onoffswitch-label" for="switch_estado">
                        <span class="onoffswitch-inner onoffswitch-inner-habilitado"></span>
                        <span class="onoffswitch-switch"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="actionsNext col-md-12" style="padding-bottom: 30px; padding-top: 20px;">
                <button class="btn next" type="submit">Siguiente</button>
              </div>

              <div class="actions col-md-12 hidden" style="padding:20px 15px;">
                <button class="btn btn-guardar" type="submit">Guardar</button>
                <a class="btn btn-cancelar" href="{{url('/admin/seminars')}}">Cancelar</a>
              </div>

          </div>
          {!! Form::close() !!}
          <div class="row col-md-12">
            <div class="portlet-title tabbable-line">
              <div class="caption caption-md">
                  <h2 class="">Presentaciones</h2>
              </div>
                <a class="btn btn-nuevo pull-right" href="{{url('admin/seminars/'.$seminario->id.'/nuevapresentacion')}}">Nuevo</a>

            </div>
            {!! Form::open(['url' => '/admin/savedocumentos', 'method' => 'POST', 'files' => 'true'])!!}
            <div class="portlet-body">
              <div class="table-scrollable">
                  <table class="table table-hover table-light">
                    <thead>
                        <tr>
                            <th class="titulo-tabla"> TÍTULO </th>
                            <th class="titulo-tabla"> TEMA </th>
                            <th class="titulo-tabla"> OBSERVACIÓN </th>
                            <th class="titulo-tabla"> ARCHIVO </th>
                            <th class="titulo-tabla"> ACCIONES </th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($documentos as $key)
                          <tr>
                            <td>{!!$key->title!!}</td>
                            <td>{!!$key->theme!!}</td>
                            <td>{!!$key->observation!!}</td>
                            <td>{!!$key->file!!}</td>
                            <td>
                              <a href="{{url('/admin/seminars/editpresentacion/'.$key->id)}}"><i class="fa fa-pencil ico-editar"></i></a>
                              <a href="javascript:;" class="btn-eliminar" data-id="{{$key->id}}"><i class="fa fa-remove ico-editar"></i></a>
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
</div>
<script type="text/javascript">
$(document).on('click', '#lang_en', function() {
  $(".next").trigger("click");
});
  // $(document).on('click', '#lang_en', function() {
  //   $('#ingles').addClass('active');
  //   $('#espanol').removeClass('active');
  //   $('.section-spanish').addClass('hidden');
  //   $('.section-english').removeClass('hidden');
  // });
  $(document).on('click', '#lang_es', function() {
    $('#ingles').removeClass('active');
    $('#espanol').addClass('active');
    $('.section-spanish').removeClass('hidden');
    $('.section-english').addClass('hidden');
  });
  $("#myonoffswitch").on( 'change', function() {
      if( $(this).is(':checked') ) {
          $(this).attr('value','1');
      } else {
        $(this).attr('value','0');
      }
  });
  $("#switch_estado").on( 'change', function() {
      if( $(this).is(':checked') ) {
          $(this).attr('value','2');
      } else {
        $(this).attr('value','1');
      }
  });
  $('#archivo_manual_es').click(function() {
      if ($(this).is(':checked')) {
        $('#name_file_es').removeAttr('disabled');
      }
      else{
        $('#name_file_es').attr('disabled', 'disabled');
      }
  });
  $('#archivo_manual_en').click(function() {
      if ($(this).is(':checked')) {
        $('#name_file_en').removeAttr('disabled');
      }
      else{
        $('#name_file_en').attr('disabled', 'disabled');
      }
  });
  $(document).on('click', '.btn-eliminar', function(){

      var button = $(this);
      var val = $(button).attr('data-id');
      swal({
        title: "¿Está seguro que desea eliminar?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "ELIMINAR",
        cancelButtonText: "CANCELAR",
        closeOnConfirm: true,
        closeOnCancel: true
      },
      function(isConfirm){
        if (isConfirm) {

          location.href = url+ '/admin/seminars/deletepresentacion/' + val;
        }
      });

    });
</script>
@endsection
