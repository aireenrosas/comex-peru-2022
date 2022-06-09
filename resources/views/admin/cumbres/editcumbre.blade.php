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
                <h1 class="titulo-editar">Editar Cumbre</h1>
            </div>
          </div>
          {!! Form::open(['url' => '/admin/cumbres/'.$cumbre->id, 'method' => 'PATCH','id' =>'cumbre'])!!}
          <div class="portlet-body">
              <div class="container-tabs">
                <ul class="nav nav-tabs">
                  <li class="active" id="espanol"><a class="tabs-color" href="#" id="lang_es" name="language" value="ES">ESPAÑOL</a></li>
                  <li id="ingles"><a class="tabs-color" href="#" id="lang_en" name="language" value="EN">ENGLISH</a></li>
                </ul>
              </div>
              <br>
              <div class="col-md-6">

                <div class="section-spanish ">

                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Nombre</label>
                    {!! Form::text('name_es',$cumbre_es->name ,['class' => 'form-control input-admin', 'placeholder' => 'Escribe el nombre de la cumbre'])!!}
                  </div>

                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Descripción</label>
                    {!! Form::textarea('description_es',$cumbre_es->description ,['class' => 'form-control input-admin wysi-textarea', 'placeholder' => 'Escriba el contenido de la cumbre'])!!}
                  </div>
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Título</label>
                    {!! Form::text('title_es', $cumbre_es->title ,['class' => 'form-control input-admin', 'placeholder' => 'Escribe el título'])!!}
                  </div>
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Lugar</label>
                    {!! Form::text('place_es',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escribe el lugar de la cumbre'])!!}
                  </div>
                </div>
                <div class="section-english hidden">

                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Nombre</label>
                    {!! Form::text('name_en', $cumbre_en->name,['class' => 'form-control input-admin', 'placeholder' => 'Escribe el nombre de la cumbre'])!!}
                  </div>
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Descripción</label>
                    {!! Form::textarea('description_en',$cumbre_en->description ,['class' => 'form-control input-admin wysi-textarea', 'placeholder' => 'Escriba el contenido de la cumbre'])!!}
                  </div>
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Título</label>
                    {!! Form::text('title_en',$cumbre_en->title ,['class' => 'form-control input-admin', 'placeholder' => 'Escribe el título'])!!}
                  </div>
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Lugar</label>
                    {!! Form::text('place_en',$cumbre_en->place ,['class' => 'form-control input-admin', 'placeholder' => 'Escribe el lugar de la cumbre'])!!}
                  </div>
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo" style="width: 100%;">Fecha</label>
                  <input class="form-calendar" type="date"  name="fecha" value="{{$cumbre->date}}" /><i class="fa fa-calendar ico-calendar" aria-hidden="true"></i>
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Hora</label>
                  {!! Form::time('time',$cumbre->time ,['class' => 'form-control input-admin', 'placeholder' => 'Escribe la hora de la cumbre'])!!}
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Url</label>
                  {!! Form::text('url',$cumbre->url ,['class' => 'form-control input-admin', 'placeholder' => 'https://www...'])!!}
                </div>
              </div>
              <div class="actionsNext col-md-12" style="padding-bottom: 30px; padding-top: 20px;">
                <button class="btn next" type="submit">Siguiente</button>
              </div>

              <div class="actions col-md-12 hidden" style="padding:20px 15px;">
                <button class="btn btn-guardar" type="submit">Guardar</button>
                <a class="btn btn-cancelar" href="{{url('/admin/cumbres')}}">Cancelar</a>
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

  $( document ).ready(function() {
          $('#fecha').datepicker();
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
@endsection
