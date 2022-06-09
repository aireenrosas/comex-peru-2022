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
                <h1 class="titulo-editar">Editar Seminario</h1>
            </div>
          </div>

          <div class="row col-md-12">
            <div class="portlet-title tabbable-line">
              <div class="caption caption-md">
                  <h2 class="">Editar presentación</h2>
              </div>
            </div>
            {!! Form::open(['url' => '/admin/seminars/updatepresentacion', 'method' => 'POST', 'files' => 'true'])!!}
            <input type="hidden" name="presentacion_id" value="{{$presentacion->id}}"/>
            <div class="portlet-body">
              <div class="col-md-12">
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Título</label>
                  {!! Form::text('doc_titulo',$presentacion->title ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el título del documento', 'required'])!!}
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Tema</label>
                  {!! Form::textarea('doc_tema',$presentacion->theme ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el tema del documento', 'rows'=>'2', 'required'])!!}
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Observación</label>
                  {!! Form::textarea('doc_observacion',$presentacion->observation ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe la observación del documento', 'rows'=>'5'])!!}
                </div>
                <div class="col-sm-6 form-group">
                  <label class="label-input-format label-titulo">Archivo</label>
                  {{$presentacion->file}}
                    <input type="file" class="file" name="presentacion" id="archivopresentacion">
                  <div class="col-md-12">
                    <p class="mensaje">*El tamaño del archivo no debe superar los 2MB de tamaño.</p>
                  </div>
                </div>
                <div class="col-sm-6 form-group">
                  <input type="checkbox" name="archivo_manual" value="1" id="archivo_manual"> Ingresar nombre de archivo ya existente
                  {!! Form::text('name_file',null ,['id'=>'name_file', 'class' => 'form-control input-admin', 'placeholder' => 'nombrearchivo.ext', 'disabled'])!!}
                </div>
                <div class="actions col-md-12" style="padding:20px 15px;">
                  <button class="btn btn-nuevo " type="submit">Guardar Presentación</button>
                </div>

            {!! Form::close() !!}
            </div>
          </div>
      </div>
  </div>
</div>
<script>
  $('#archivo_manual').click(function() {
      if ($(this).is(':checked')) {
        $('#name_file').removeAttr('disabled');
        $('#archivopresentacion').replaceWith('<input type="file" class="file" name="presentacion" id="archivopresentacion">');
      }
      else{
        $('#name_file').attr('disabled', 'disabled');
      }
  });
  $(document).on('change', '.file', function() {

       var input = $(this);
       var parent = $(input).parent();
       var reader = new FileReader();

       if(this.files[0].size<2097153)
       {
          $(parent).find('.mensaje').css('color', 'black');
       }
       else{
         $(parent).find('.mensaje').css('color', 'red');
         $('#archivopresentacion').replaceWith('<input type="file" class="file" name="presentacion" id="archivopresentacion">');

       }

    });
</script>
@endsection
