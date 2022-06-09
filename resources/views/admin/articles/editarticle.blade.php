@extends('app.appadmin')
@section('style')
<link href="<?php echo URL::asset('css/home.css'); ?>" rel="stylesheet" type="text/css" />

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="<?php echo URL::asset('js/validaciones.js'); ?>" type="text/javascript"></script>
@endsection
@section('content')

<div class="row">
  <div class="col-md-12 cont-tabla">
      <div class="portlet light ">
          <div class="portlet-title tabbable-line">
            <div class="caption caption-md">
                <h1 class="titulo-editar">Editar Artículo</h1>
                @if($articulo->only_file==1)
                  @if(isset($articulo_es))
                    <a href="{{url('upload/articles/'.$publicacion->directory.'/'.$articulo_es->file)}}" target="_blank">
                      {{url('upload/articles/'.$publicacion->directory.'/'.$articulo_es->file)}}
                    </a>
                  @endif
                  @if(isset($articulo_en))
                    <a href="{{url('upload/articles/'.$publicacion->directory.'/'.$articulo_en->file)}}" target="_blank">
                      {{url('upload/articles/'.$publicacion->directory.'/'.$articulo_en->file)}}
                    </a>
                  @endif
                @else
                  @if(isset($articulo_es))
                    <a href="{{url('/articulo/'.$articulo_es->slug)}}"  target="_blank">
                      {{url('/articulo/'.$articulo_es->slug)}}
                    </a>
                  @else
                    @if(isset($articulo_en))
                      <a href="{{url('/articulo/'.$articulo_en->slug)}}"  target="_blank">
                        {{url('/articulo/'.$articulo_en->slug)}}
                      </a>
                    @endif
                  @endif

                @endif
                <br><br>
            </div>
          </div>
          {!! Form::open(['url' => '/admin/articulos/'.$articulo->id, 'method' => 'PATCH', 'files' => 'true','name' =>'articulos','id' =>'articulos'])!!}
          <div class="portlet-body">
              <div class="col-md-12 form-group cont-tabsadmin">
                <div class="col-md-6">
                  <input type="checkbox" name="has_language" value="1" id="habilitar-lang" <?php if($articulo->has_languages==true){echo 'checked';}?>> Habilitar idiomas
                </div>
                <div class="col-md-6">
                  <input type="checkbox" name="only_file" value="1" id="solo-archivo" <?php if($articulo->only_file==true){echo 'checked';}?>> Sólo Archivo
                </div>
                <br>
                <div class="versiones-languages <?php if($articulo->has_languages==false){echo 'hidden';}?>">

                  <div class="container-tabs">
                    <ul class="nav nav-tabs">
                      <li id="espanol" class="active"><a class="tabs-color" href="#" id="lang_es" name="language" value="ES">ESPAÑOL</a></li>
                      <li id="ingles"><a class="tabs-color" href="#" id="lang_en" name="language" value="EN">ENGLISH</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-12 form-group">
                <label class="label-input-format label-titulo">Publicación</label>
                <select name="publication" class="form-control input-admin select-multiple" data-placeholder="Seleccione publicación" id="select_publicacion" required>
                  @foreach ($publicaciones as $key)
                    <option value="{{$key->id}}" data-type="{{$key->type_id}}" data-privacity="{{$key->privacity}}"  data-en="{{$key->name_en}}" data-es="{{$key->name_es}}" <?php if($key->id==$articulo->publication_id){echo 'selected';}?>>{{$key->name_es}}</option>
                  @endforeach
                </select>
                <label id="select_publicacion-error" class="error" for="select_publicacion"></label>
              </div>
              <div class="col-md-12 form-group">
                <label class="label-input-format label-titulo">Edición</label>
                {!! Form::text('edition',$articulo->edition ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba la edición de la publicación'])!!}
                <label id="edition-error" class="error" for="edition"></label>
              </div>
              <div class="col-md-12 form-group">
                <label class="label-input-format label-titulo">Columna</label>
                <select name="column_id" class="form-control input-admin select-multiple" data-placeholder="Seleccione columna" id="select_columnas">
                  <option value="0" data-type="0" data-en="" data-es=""></option>
                  @foreach ($columnas as $key)
                    <option value="{{$key->id}}" data-type="{{$key->type_id}}" data-en="{{$key->name_en}}" data-es="{{$key->name_es}}" <?php if($key->type_id!=$publicacion->type_id){echo 'disabled';} if($key->id==$articulo->column_id){echo 'selected';}?>>{{$key->name_es}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-12 form-group">
                @if($articulo->privacity==0)
                <?php
                $texto= 'unchecked';
                ?>
                @else
                <?php
                $texto= 'checked';
                ?>
                @endif
                <label class="label-input-format label-titulo">Privacidad</label>
                <div class="col-md-12 col-xs-12" style="padding-left: 0px;">
                  <div class="onoffswitch">
                    <input type="checkbox" name="privacity" class="onoffswitch-checkbox" id="myonoffswitch" value="{{$articulo->privacity}}" {{$texto}}>
                    <label class="onoffswitch-label" for="myonoffswitch">
                      <span class="onoffswitch-inner onoffswitch-inner-privacity"></span>
                      <span class="onoffswitch-switch"></span>
                    </label>
                  </div>
              </div>
              </div>
              <div class="col-md-12 form-group">
                <label class="label-input-format label-titulo">Autor</label>
                {!! Form::text('autor',$articulo->autor ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba la edición de la publicación'])!!}
                <label id="autor-error" class="error" for="autor"></label>
              </div>
              <div class="col-md-12 form-group">
                <label class="label-input-format label-titulo">Tags</label>
                <select name="tags[]" class="form-control input-admin select-multiple" data-placeholder="Seleccione tags" id="select_tags" multiple>
                  @foreach ($tags as $key)
                    <option value="{{$key->id}}" data-en="{{$key->name_en}}" data-es="{{$key->name_es}}" <?php if(in_array($key->id,$tags_selected)){echo 'selected';}?>>{{$key->name_es}}</option>
                  @endforeach
                </select>
                <label id="select_tags-error" class="error" for="select_tags"></label>
              </div>
              <div class="col-md-12 form-group no-onlyfile">
                <label class="label-input-format label-titulo">Imagen</label>

                <img src="{{url('upload/images/'.$articulo->cover)}}" class="img-responsive img-articulo"/>
                @if($articulo->cover && $articulo->cover!='')
                <span class="fa fa-trash-o btn-eliminar-img" data-id="{{$articulo->id}}"><span class="texto-eliminar"> Eliminar Imagen</span></span>
                @endif
                <input type="file" class="file" id="cover-articulo" name="cover-articulo">
                <div class="col-md-12">
                  <p class="mensaje hidden">*El tamaño del archivo no debe superar los 2MB de tamaño.</p>
                </div>
              </div>
              <div class="section-spanish">
                <div class="col-md-6 form-group no-onlyfile">
                  <label class="label-input-format label-titulo">Leyenda</label>
                  @if(isset($articulo_es))
                  {!! Form::text('leyend_es',$articulo_es->leyend ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba la leyenda'])!!}
                  @else
                    {!! Form::text('leyend_es',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba la leyenda'])!!}
                  @endif
                </div>
                <div class="col-md-6 form-group no-onlyfile">
                  <label class="label-input-format label-titulo">Fuente</label>
                  @if(isset($articulo_es))
                  {!! Form::text('source_es',$articulo_es->source,['class' => 'form-control input-admin', 'placeholder' => 'Escriba la fuente'])!!}
                  @else
                    {!! Form::text('source_es',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba la fuente'])!!}
                  @endif
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Título</label>
                  @if(isset($articulo_es))
                  {!! Form::text('title_es',$articulo_es->title ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba el título del artículo', 'required'])!!}
                  @else
                    {!! Form::text('title_es',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba el título del artículo', 'required'])!!}
                  @endif
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Resumen</label>
                    @if(isset($articulo_es))
                      {!! Form::textarea('abstract_es',$articulo_es->abstract,['class' => 'form-control input-admin', 'placeholder' => 'Escriba el resumen del artículo', 'rows'=>'5', 'maxlength'=>'500'])!!}
                    @else
                      {!! Form::textarea('abstract_es',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba el resumen del artículo', 'rows'=>'5'])!!}
                    @endif
                </div>
                <div class="col-md-12 form-group no-onlyfile">
                  <button type="button" name="button" class="btn-add-img" onclick="seeLinks()">Galería de imágenes</button>

                  <label class="label-input-format label-titulo">Contenido</label>
                  @if(isset($articulo_es))
                    {!! Form::textarea('content_es',$articulo_es->content ,['class' => 'form-control input-admin wysi-textarea', 'placeholder' => 'Escriba el contenido del artículo', 'required', 'rows'=>'15'])!!}
                  @else
                    {!! Form::textarea('content_es',null ,['class' => 'form-control input-admin wysi-textarea', 'placeholder' => 'Escriba el contenido del artículo', 'required', 'rows'=>'15'])!!}
                  @endif
                </div>
                <div class="col-sm-6 form-group">
                  <label class="label-input-format label-titulo">Archivo</label>
                  @if(isset($articulo_es))
                    <a href="{{url('upload/articles/'.$publicacion->directory.'/'.$articulo_es->file)}}" target="_blank" class="line-height40">{{$articulo_es->file}}</a>
                  @endif
                  <input type="file" class="file" id="file_es" name="file_es">
                </div>
                <div class="col-sm-6 form-group">
                  <input type="checkbox" name="archivo_manual_es" value="1" id="archivo_manual_es"> Ingresar nombre de archivo ya existente
                  {!! Form::text('name_file_es',null ,['id'=>'name_file_es', 'class' => 'form-control input-admin', 'placeholder' => 'nombrearchivo.ext', 'disabled'])!!}
                </div>
              </div>
              <div class="section-english hidden">
                <div class="col-md-6 form-group no-onlyfile">
                  <label class="label-input-format label-titulo">Leyenda</label>
                  @if(isset($articulo_en))
                    {!! Form::text('leyend_en',$articulo_en->leyend ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba la leyenda'])!!}
                  @else
                    {!! Form::text('leyend_en',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba la leyenda'])!!}
                  @endif
                </div>
                <div class="col-md-6 form-group no-onlyfile">
                  <label class="label-input-format label-titulo">Fuente</label>
                  @if(isset($articulo_en))
                    {!! Form::text('source_en',$articulo_en->source ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba la fuente'])!!}
                  @else
                    {!! Form::text('source_en',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba la fuente'])!!}
                  @endif
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Título</label>
                  @if(isset($articulo_en))
                    {!! Form::text('title_en',$articulo_en->title ,['class' => 'form-control input-admin', 'placeholder' => 'Escribe el título del artículo', 'required'])!!}
                  @else
                    {!! Form::text('title_en',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escribe el título del artículo', 'required'])!!}
                  @endif
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Resumen</label>
                  @if(isset($articulo_en))
                    {!! Form::textarea('abstract_en',$articulo_en->abstract,['class' => 'form-control input-admin', 'placeholder' => 'Escriba el resumen del artículo', 'rows'=>'5', 'maxlength'=>'500'])!!}
                  @else
                    {!! Form::textarea('abstract_en',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba el resumen del artículo', 'rows'=>'5'])!!}
                  @endif
                </div>
                <div class="col-md-12 form-group no-onlyfile">
                  <button type="button" name="button" class="btn-add-img" data-toggle="modal" data-target="#modalFtp">Galería de imágenesn</button>

                  <label class="label-input-format label-titulo">Contenido</label>
                  @if(isset($articulo_en))
                    {!! Form::textarea('content_en',$articulo_en->content ,['class' => 'form-control input-admin wysi-textarea', 'placeholder' => 'Escribe el contenido del artículo', 'required', 'rows'=>'15'])!!}
                  @else
                    {!! Form::textarea('content_en',null ,['class' => 'form-control input-admin wysi-textarea', 'placeholder' => 'Escribe el contenido del artículo', 'required', 'rows'=>'15'])!!}
                  @endif
                </div>
                <div class="col-sm-6 form-group">
                  <label class="label-input-format label-titulo">Archivo</label>
                  @if(isset($articulo_en))
                    <a href="{{url('upload/articles/'.$publicacion->directory.'/'.$articulo_en->file)}}" target="_blank" class="line-height40">{{$articulo_en->file}}</a>
                  @endif

                  <input type="file" class="file" id="file_en" name="file_en">
                </div>
                <div class="col-sm-6 form-group">
                  <input type="checkbox" name="archivo_manual_en" value="1" id="archivo_manual_en"> Ingresar nombre de archivo ya existente
                  {!! Form::text('name_file_en',null ,['id'=>'name_file_en', 'class' => 'form-control input-admin', 'placeholder' => 'nombrearchivo.ext', 'disabled'])!!}
                </div>
              </div>
              <div class="col-md-12 form-group">
                <label class="label-input-format label-titulo">Fecha de publicación</label>

                <?php $fecha = new DateTime($articulo->published_at);?>
                {!! Form::date('fecha_publicacion',$fecha->format('Y-m-d') ,['class' => 'form-control input-admin'])!!}
              </div>
              <div class="actionsNext col-md-12 hidden" style="padding-bottom: 30px; padding-top: 20px;">
                <div class="col-md-12">
                  <label class="error msjLenguajes">Habilitó lenguajes</label>
                </div>
                <button class="next" type="submit">Siguiente</button>
              </div>
              <div class="actions col-md-12" style="padding-bottom: 30px; padding-top: 20px;">
                <input type="hidden" id="open" name="open" value="<?php if($articulo->is_open==true){echo '1';}else{echo '0';}?>">
                <button type="submit" class="hidden submit-form"></button>

                <button class="btn-guardar btn-submit-form" type="button">Guardar</button>
                <button class="btn-nuevo btn-submit-publish-form" type="button">Guardar y publicar</button>
                <a class="btn-cancelar" href="{{url('/admin/articulos')}}">Cancelar</a>
            </div>
          </div>
          {!! Form::close() !!}
      </div>
  </div>
</div>
<div class="modal fade modal-ftp" id="modalFtp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <label>Subir imagen</label>
                <input type="file" class="nueva-img-ftp" id="nueva-img-ftp"/>
                <button type="button" class="subir-img">Subir imagen</button>
                <label class="spin-message"></label>
                <div class="table-scrollable" style="height:300px;overflow-y:scroll">
                    <table class="table table-hover table-light" id="article">
                        <thead>
                        <tr>
                            <th class="titulo-tabla"> IMAGEN </th>
                            <th colspan="2" class="titulo-tabla"> RUTA </th>
                            <th class="titulo-tabla"> COPIAR </th>
                        </tr>
                        </thead>
                        <tbody id="body-imagenes"></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
       var url = '{{url('/')}}';
       $(document).on('click', '.btn-copy', function(event) {
           $(this).parent().parent().find('.url-img').select();
           document.execCommand("copy");
       });
       $(document).on('click', '.subir-img', function() {
            console.log('entro img');
           var reader = new FileReader();


           var file = document.getElementById('nueva-img-ftp');


           if(file.files[0].size<2097153)
           {
               $('.spin-message').empty();
               $('.spin-message').append('Adjuntando <i class="fa fa-spin fa-spinner"></i>');


               var data = new FormData();
               if (file.files.length>0)
               {
                   data.append('file', file.files[0]);
               }
               data.append('_token', $("meta[name='csrf-token']").attr('content'));

               $.ajax({
                   url: '{!! url("/admin/articulos/newimageftp") !!}',
                   data: data,
                   type: 'POST',
                   processData: false,
                   contentType: false,
                   success: function(data) {

                       $('.spin-message').empty();
                       $('#body-imagenes').prepend( '<tr><td><img class="img-file" src="'+ data+'"/></td><td colspan="2"><input type="text"  value="'+data+'" class="url-img" readonly></td><td><button type="button" class="btn-copy">Copiar</button></td></tr>');

                   },
                   error: function(){
                       $('.spin-message').empty();
                       $('.spin-message').append('*No se pudo agregar');

                   }
               });
           }
           else{
               $('.spin-message').append('*El archivo no debe exceder a 2MB de tamaño.');

           }
       });
   </script>
<script>
    if(! $('#habilitar-lang').is(':checked')){
      $("#espanol").removeClass('active');
    }

  $(document).ready(function(){

    $('.select-multiple').select2();
    $('.wysi-textarea').summernote({

        callbacks: {
          onPaste: function(e) {

          }
        }

      });


  });
  $(document).on('change', '.file', function() {

       var input = $(this);
       var parent = $(input).parent();
       var reader = new FileReader();

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
         $(parent).find('img').attr('src', '');
       }

    });
    $(document).on('click', '#lang_en', function() {
      $(".next").trigger("click");
      // $('#ingles').addClass('active');
      // $('#espanol').removeClass('active');
      // $('.section-spanish').addClass('hidden');
      // $('.section-english').removeClass('hidden');
      // $('#select_publicacion option').each(function(){
      //   $(this).text($(this).attr('data-en'));
      // });
      // $('#select_publicacion').select2();
      // $('#select_tags option').each(function(){
      //   $(this).text($(this).attr('data-en'));
      // });
      // $('#select_tags').select2();
    });
    $(document).on('click', '#lang_es', function() {
      $('#ingles').removeClass('active');
      $('#espanol').addClass('active');
      $('.actions').addClass('hidden');
      $('.actionsNext').removeClass('hidden');
      $('.section-spanish').removeClass('hidden');
      $('.section-english').addClass('hidden');
      $('#select_publicacion option').each(function(){
        $(this).text($(this).attr('data-es'));
      });
      $('#select_publicacion').select2();
      $('#select_tags option').each(function(){
        $(this).text($(this).attr('data-es'));
      });
      $('#select_tags').select2();
      $('#select_columnas option').each(function(){
        $(this).text($(this).attr('data-es'));
      });
      $('#select_columnas').select2();
    });
    $(document).on('click', '#habilitar-lang', function() {
      $("#espanol").addClass('active');
      if($(this).is(':checked')){
          $('.versiones-languages').removeClass('hidden');
      }
      else{
        $("#espanol").removeClass('active');
        $('.versiones-languages').addClass('hidden');
        $('.section-spanish').removeClass('hidden');
        $('.section-english').addClass('hidden');
        $('#select_publicacion option').each(function(){
          $(this).text($(this).attr('data-es'));
        });
        $('#select_publicacion').select2();
        $('#select_tags option').each(function(){
          $(this).text($(this).attr('data-es'));
        });
        $('#select_tags').select2();
        $('#select_columnas option').each(function(){
          $(this).text($(this).attr('data-es'));
        });
        $('#select_columnas').select2();
      }
    });
    $('.btn-submit-form').click(function(){
      $('.submit-form').click();
    });
    $('.btn-submit-publish-form').click(function(){
      $('#open').val('1');
      $('.submit-form').click();
    });

    if( $('#habilitar-lang').prop('checked') ) {
      $('.versiones-languages').removeClass('hidden');
    }
    if( $('#solo-archivo').prop('checked') ) {
      $('.no-onlyfile').addClass('hidden');
    }

    $('#solo-archivo').click(function() {
        if ($(this).is(':checked')) {
          $('.no-onlyfile').addClass('hidden');
          // $('#file_es').prop("required", true);
          // $('#file_en').prop("required", true);
        }else{
          $('.no-onlyfile').removeClass('hidden');
          // $('#file_es').removeAttr("required");
          // $('#file_en').removeAttr("required");
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

    $(document).on('change', '#select_publicacion', function(){
      var type = $('#select_publicacion option:selected').attr('data-type');
      var privacidad = $('#select_publicacion option:selected').attr('data-privacity');

      if(privacidad==1)
      {
        $("#myonoffswitch").attr('value','1');
        $("#myonoffswitch").prop('checked', 'checked');
      }
      else{
        $("#myonoffswitch").attr('value','0');
        $("#myonoffswitch").removeAttr('checked');
      }

      $('#select_columnas option').each(function(){
        if($(this).attr('data-type')==type)
        {
          $(this).removeAttr('disabled');
        }
        else{
          $(this).attr('disabled', 'disabled');
        }
      });
      $('#select_columnas').select2();
    });

</script>
<script type="text/javascript">
$(function() {
    function reposition() {
        var modal = $(this),
            dialog = modal.find('.modal-dialog');
        modal.css('display', 'block');
        modal.addClass("modal-traslate");
        dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2));
    }
    $('.modal-img').on('show.bs.modal', reposition);
    $(window).on('resize', function() {
        $('.modal-img:visible').each(reposition);
    });
});
$('.btn-add-img').on('click', function(){
    var winSize = {
      wheight : $(window).height(),
      wwidth : $(window).width()
    };
    var modSize = {
      mheight : $('#modalFtp').height(),
      mwidth : $('#modalFtp').width()
    };
  $('#modalFtp').css({
    // 'background-color' : '#ccc',
    'padding-top' :  ((winSize.wheight - (modSize.mheight/2))/2),
  });
});
</script>
<script>
$(document).on('click', '.btn-eliminar-img', function(){
    var button = $(this);
    var val = $(button).attr('data-id');
    swal({
      title: "¿Está seguro que desea eliminar la imagen?",
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
            url: url + '/admin/articulos/deleteimg',
            data: data,
            type: 'POST',
            success: function(data) {
                $('.btn-eliminar-img').remove();
                $('.img-articulo').attr('src', '');
                console.log(data);

            }
        });
      }
    });

  });

  $("#myonoffswitch").on( 'change', function() {
      if( $(this).is(':checked') ) {
          $(this).attr('value','1');
      } else {
        $(this).attr('value','0');
      }
  });

var seeLinks = function(){

  $('#modalFtp').modal('show');

  if($('#body-imagenes').is(':empty'))
  {
    var data = {};
      $.ajax({
          type: "GET",
          url: url + '/admin/articulos/getimagenesfolder',
          data: data,
          success: function(response){
            console.log(response);
            to_append = '';
            $.each(response.imagenes, function(i,v){
              console.log(v);
              to_append = to_append +'<tr><td><img class="img-file" src="'+v+'"/></td><td colspan="2"><input type="text"  value="'+v+'" class="url-img" readonly></td><td><button type="button" class="btn-copy">Copiar</button></td></tr>';
            });

            $('#body-imagenes').append(to_append);
          },
          error: function(){
          }
      });
  }

};
</script>
@endsection
