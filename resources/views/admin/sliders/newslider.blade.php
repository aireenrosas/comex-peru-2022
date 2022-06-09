@extends('app.appadmin')
@section('style')
<link href="<?php echo URL::asset('css/home.css'); ?>" rel="stylesheet" type="text/css" />

@endsection
@section('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.min.js"></script>
@endsection
@section('content')

<div class="row">
  <div class="col-md-12 cont-tabla">
      <div class="portlet light ">
          <div class="portlet-title tabbable-line">
            <div class="caption caption-md">
                <h1 class="titulo-editar">Nuevo Slider</h1>
            </div>
          </div>
          {!! Form::open(['url' => '/admin/sliders', 'method' => 'POST', 'files'=>'true', 'id' => 'formSlider'])!!}
          <div class="portlet-body">
              <div class="container-tabs">
                <ul class="nav nav-tabs">
                  <li class="active" id="espanol"><a class="tabs-color" href="#" id="lang_es" name="language" value="ES">ESPAÑOL</a></li>
                  <li id="ingles"><a class="tabs-color" href="#" id="lang_en" name="language" value="EN">ENGLISH</a></li>
                </ul>
              </div>
              <br>
              <div class="col-md-6">
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Imagen</label>
                  <img src="http://via.placeholder.com/1139x500" class="imagen-slider" />
                  <input type="file" class="file" name="file_slider" required>
                  <div class="col-md-12">
                    <p class="mensaje hidden">*El tamaño del archivo no debe superar los 2MB de tamaño.</p>
                  </div>
                </div>
                <div class="section-spanish">
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Título</label>
                    {!! Form::text('title_es',null ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el nombre del slider'])!!}
                  </div>
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Texto</label>
                    {!! Form::textarea('text_es',null ,['class' => 'form-control input-admin wysi-textarea', 'placeholder' => 'Escriba el texto del slider'])!!}
                  </div>
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Texto Botón</label>
                    {!! Form::text('button_text_es',null ,['class' => 'input-admin form-control mayus', 'placeholder' => 'Escribe el texto del botón', 'id' => 'btnText'])!!}
                  </div>
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Url</label>
                    {!! Form::text('url_es',null ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe la Url' , 'id' => 'btnUrl'])!!}
                    <label>Formato de URL debe ser: https://www...</label>
                    <label id="btnUrl-error" class="error"></label>
                  </div>
                </div>
                <div class="section-english hidden">
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Título</label>
                    {!! Form::text('title_en',null ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el nombre del slider'])!!}
                  </div>
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Texto</label>
                    {!! Form::textarea('text_en',null ,['class' => 'form-control input-admin wysi-textarea', 'placeholder' => 'Escriba el texto del slider'])!!}
                  </div>
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Texto Botón</label>
                    {!! Form::text('button_text_en',null ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el texto del botón', 'id' => 'btnTextE'])!!}
                  </div>
                  <div class="col-md-12 form-group">
                    <label class="label-input-format label-titulo">Url</label>
                    {!! Form::text('url_en',null ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe la Url', 'id' => 'btnUrlE'])!!}
                    <label class="error">Formato de url debe ser: http://www...</label>
                    <label id="btnUrlE-error" class="error"></label>
                  </div>
                </div>
              </div>
              <div class="actions col-md-12" style="padding:20px 15px;">
                <button class="btn btn-guardar" type="submit">Guardar</button>
                <a class="btn btn-cancelar" href="{{url('/admin/sliders')}}">Cancelar</a>
            </div>
          </div>
          {!! Form::close() !!}
      </div>
  </div>
</div>
<script type="text/javascript">
$(document).on('change', '.file', function() {

     var input = $(this);
     var parent = $(input).parent();
     var reader = new FileReader();

     console.log(this.files[0].size);
     if(this.files[0].size<2097153)
     {
          reader.onload = function(e) {
             $(parent).find('img').attr('src', e.target.result);
             $(parent).find('.mensaje').addClass('hidden');
         };
         reader.readAsDataURL(this.files[0]);
     }
     else{
       $(parent).find('.mensaje').removeClass('hidden');
     }

  });
$(document).on('click', '#lang_en', function() {
  $('#ingles').addClass('active');
  $('#espanol').removeClass('active');
  $('.section-spanish').addClass('hidden');
  $('.section-english').removeClass('hidden');
});
$(document).on('click', '#lang_es', function() {
  $('#ingles').removeClass('active');
  $('#espanol').addClass('active');
  $('.section-spanish').removeClass('hidden');
  $('.section-english').addClass('hidden');
});


$("#formSlider").submit(function(e){
  var text=$('#btnText').val();
  var urlbtn=$('#btnUrl').val();
  var textE=$('#btnTextE').val();
  var urlbtnE=$('#btnUrlE').val();
  if(text !="" && urlbtn=="" || text =="" && urlbtn !=""){
    e.preventDefault();
    $('#btnUrl-error').html('Error: Creó un boton sin Url');
    console.log("evitó el envio");
  }else{
      $('#btnUrl-error').css('display','none');
  }
  if(textE !="" && urlbtnE=="" || textE =="" && urlbtnE !=""){
    e.preventDefault();
    $('#btnUrlE-error').html('Error: Creó un boton sin Url');
    console.log("evitó el envio");
  }else{
      $('#btnUrlE-error').css('display','none');
  }

 });
</script>
@endsection
