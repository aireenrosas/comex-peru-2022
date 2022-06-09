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
                <h1 class="titulo-editar">Nuevo Seminario</h1>
            </div>
          </div>
          {!! Form::open(['url' => '/admin/seminars', 'method' => 'POST', 'files' => 'true','id' =>'seminars'])!!}
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
                    {!! Form::text('name_es',null ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el nombre del seminario', 'required'])!!}
                  </div>
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Título para CRONOGRAMA</label>
                    {!! Form::text('title_es',null ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el nombre del seminario', 'required'])!!}
                  </div>
                  <div class="col-sm-6 form-group">
                    <label class="label-input-format label-titulo">Archivo</label>
                    {{-- <input type="file" class="file" name="file_es">
                    <div class="col-md-12">
                      <p class="mensaje hidden">*El tamaño del archivo no debe superar los 2MB de tamaño.</p>
                    </div>
                  </div>
                  {{-- <div class="col-sm-6 form-group"> --}}
                    <input class="hidden" type="checkbox" name="archivo_manual_es" value="1" id="archivo_manual_es" checked> Ingresar nombre de archivo
                    {!! Form::text('name_file_es',null ,['id'=>'name_file_es', 'class' => 'form-control input-admin', 'placeholder' => ''])!!}
                  </div>
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Lugar</label>
                    {!! Form::text('place_es',null ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el lugar del seminario', 'required'])!!}
                  </div>
                </div>
                <div class="section-english hidden">
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Nombre</label>
                    {!! Form::text('name_en',null ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el nombre del seminario', 'required'])!!}
                  </div>
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Título para CRONOGRAMA</label>
                    {!! Form::text('title_en',null ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el nombre del seminario', 'required'])!!}
                  </div>
                  {{-- <div class="col-sm-6 form-group">
                    <label class="label-input-format label-titulo">Carpeta</label>
                    {!! Form::text('carpeta_en',null ,['id'=>'carpeta_en', 'class' => 'form-control input-admin', 'placeholder' => 'Ingrese carpeta donde guardar el archivo seleccionado'])!!}
                    <div class="col-md-12">
                      <p class="mensaje">*Llene este campo si desea guardar el archivo seleccionado en una carpeta específica.</p>
                    </div>
                  </div> --}}
                  <div class="col-sm-6 form-group">
                    <label class="label-input-format label-titulo">Archivo</label>
                    {{-- <input type="file" class="file" name="file_en">
                    <div class="col-md-12">
                      <p class="mensaje hidden">*El tamaño del archivo no debe superar los 2MB de tamaño.</p>
                    </div>
                  </div>
                  <div class="col-sm-6 form-group"> --}}
                    <input class="hidden" type="checkbox" name="archivo_manual_en" value="1" id="archivo_manual_en" checked> Ingresar nombre de archivo
                    {!! Form::text('name_file_en',null ,['id'=>'name_file_en', 'class' => 'form-control input-admin', 'placeholder' => ''])!!}
                  </div>
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Lugar</label>
                    {!! Form::text('place_en',null ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el lugar del seminario', 'required'])!!}
                  </div>
                </div>

                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo" style="width: 100%;">Fecha</label>
                  <i class="fa fa-calendar ico-calendar" aria-hidden="true"></i><input class="form-calendar" type="date"  name="date" value="{{date('Y-m-d')}}" required/>

                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo" style="width: 100%;">Hora</label>
                  <input class="form-calendar" type="time"  name="time" value="" />

                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Activo (En el calendario)</label>

                  <div class="col-md-12 col-xs-12" style="padding-left: 0px;">
                    <div class="onoffswitch">
                      <input type="checkbox" name="active" class="onoffswitch-checkbox" id="myonoffswitch" unchecked value="0">
                      <label class="onoffswitch-label" for="myonoffswitch">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Estado (Para inscripciones)</label>

                  <div class="col-md-12 col-xs-12" style="padding-left: 0px;">
                    <div class="onoffswitch">
                      <input type="checkbox" name="state" class="onoffswitch-checkbox" id="switch_estado" unchecked value="0">
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
</script>
<script>
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
</script>
@endsection
