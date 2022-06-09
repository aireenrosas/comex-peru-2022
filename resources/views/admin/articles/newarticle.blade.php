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
                <h1 class="titulo-editar">Nuevo Artículo</h1>
            </div>
          </div>
          {!! Form::open(['url' => '/admin/articulos', 'method' => 'POST', 'files' => 'true','name' =>'articulos','id' =>'articulos'])!!}
          <div class="portlet-body">
              <div class="col-md-12 form-group cont-tabsadmin">
                <div class="col-md-6">
                  <input type="checkbox" name="has_language" value="1" id="habilitar-lang"> Habilitar idiomas
                </div>
                <div class="col-md-6">
                  <input type="checkbox" name="only_file" value="1" id="solo-archivo"> Sólo Archivo
                </div>
                <div class="versiones-languages hidden">
                  <br>
                  {{-- <input id="lang_es" type="radio" name="language" value="ES" checked> ES
                  <input id="lang_en" type="radio" name="language" value="EN"> EN --}}
                  <div class="container-tabs">
                    <ul class="nav nav-tabs">
                      <li id="espanol"><a class="tabs-color" href="#" id="lang_es" name="language" value="ES">ESPAÑOL</a></li>
                      <li id="ingles"><a class="tabs-color" href="#" id="lang_en" name="language" value="EN">ENGLISH</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-12 form-group">
                <label class="label-input-format label-titulo">Publicación</label>
                <select name="publication" class="form-control input-admin select-multiple" data-placeholder="Seleccione publicación" id="select_publicacion">
                  @foreach ($publicaciones as $key)
                    <option value="{{$key->id}}" data-type="{{$key->type_id}}" data-privacity="{{$key->privacity}}" data-en="{{$key->name_en}}" data-es="{{$key->name_es}}">{{$key->name_es}}</option>
                  @endforeach
                </select>
                <label id="select_publicacion-error" class="error" for="select_publicacion"></label>
              </div>
              <div class="col-md-12 form-group">
                <label class="label-input-format label-titulo">Edición</label>
                {!! Form::text('edition',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba la edición de la publicación'])!!}
                <label id="edition-error" class="error" for="edition"></label>
              </div>
              <div class="col-md-12 form-group">
                <label class="label-input-format label-titulo">Columna</label>
                <select name="column_id" class="form-control input-admin select-multiple" data-placeholder="Seleccione columna" id="select_columnas">
                  <option value="0" data-type="0" data-en="" data-es=""></option>
                  @foreach ($columnas as $key)
                    <option value="{{$key->id}}" data-type="{{$key->type_id}}" data-en="{{$key->name_en}}" data-es="{{$key->name_es}}" <?php if($key->type_id!=2){echo 'disabled';}?>>{{$key->name_es}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-12 form-group">
                <label class="label-input-format label-titulo">Privacidad</label>
                <div class="col-md-12 col-xs-12" style="padding-left: 0px;">
                  <div class="onoffswitch">
                    <input type="checkbox" name="privacity" class="onoffswitch-checkbox" id="myonoffswitch" value="0" unchecked>
                    <label class="onoffswitch-label" for="myonoffswitch">
                      <span class="onoffswitch-inner onoffswitch-inner-privacity"></span>
                      <span class="onoffswitch-switch"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-md-12 form-group">
                <label class="label-input-format label-titulo">Autor</label>
                {!! Form::text('autor',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba el autor de la publicación'])!!}
                <label id="autor-error" class="error" for="autor"></label>
              </div>
              <div class="col-md-12 form-group">
                <label class="label-input-format label-titulo">Tags</label>
                <select name="tags[]" class="form-control input-admin select-multiple" data-placeholder="Seleccione tags" id="select_tags" multiple>
                  @foreach ($tags as $key)
                    <option value="{{$key->id}}" data-en="{{$key->name_en}}" data-es="{{$key->name_es}}">{{$key->name_es}}</option>
                  @endforeach
                </select>
                <label id="select_tags-error" class="error" for="select_tags"></label>
              </div>
              <div class="col-md-12 form-group no-onlyfile">
                <label class="label-input-format label-titulo">Imagen</label>
                <img src="#" class="img-responsive"/>
                <input type="file" class="file" id="cover-articulo" name="cover-articulo">

              </div>
              <div class="section-spanish">
                <div class="col-md-6 form-group no-onlyfile">
                  <label class="label-input-format label-titulo">Leyenda</label>
                  {!! Form::text('leyend_es',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba la leyenda'])!!}
                </div>
                <div class="col-md-6 form-group no-onlyfile">
                  <label class="label-input-format label-titulo">Fuente</label>
                  {!! Form::text('source_es',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba la fuente'])!!}
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Título</label>
                  {!! Form::text('title_es',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba el título del artículo', 'required'])!!}
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Resumen</label>
                  {!! Form::textarea('abstract_es',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba el resumen del artículo', 'rows'=>'5', 'maxlength'=>'500'])!!}
                </div>
                <div class="col-md-12 form-group no-onlyfile contenido">
                  <button type="button" name="button" class="btn-add-img" onclick="seeLinks()">Galería de imágenes</button>
                  <label class="label-input-format label-titulo">Contenido</label>
                  {!! Form::textarea('content_es',null ,['class' => 'form-control input-admin wysi-textarea', 'placeholder' => 'Escriba el contenido del artículo', 'required', 'rows'=>'15'])!!}
                </div>
                <div class="col-sm-6 form-group">
                  <label class="label-input-format label-titulo">Archivo</label>
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
                  {!! Form::text('leyend_en',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba la leyenda'])!!}
                </div>
                <div class="col-md-6 form-group no-onlyfile">
                  <label class="label-input-format label-titulo">Fuente</label>
                  {!! Form::text('source_en',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba la fuente'])!!}
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Título</label>
                  {!! Form::text('title_en',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escribe el título del artículo', 'required'])!!}
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Resumen</label>
                  {!! Form::textarea('abstract_en',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escriba el resumen del artículo', 'rows'=>'5', 'maxlength'=>'500'])!!}
                </div>
                <div class="col-md-12 form-group no-onlyfile contenido">
                  <button type="button" name="button" class="btn-add-img" data-toggle="modal" data-target="#modalFtp">Galería de imágenes</button>
                  <label class="label-input-format label-titulo">Contenido</label>
                  {!! Form::textarea('content_en',null ,['class' => 'form-control input-admin wysi-textarea', 'placeholder' => 'Escribe el contenido del artículo', 'required', 'rows'=>'15'])!!}
                </div>
                <div class="col-sm-6 form-group">
                  <label class="label-input-format label-titulo">Archivo</label>
                  <input type="file" class="file" id="file_en" name="file_en">
                </div>
                <div class="col-sm-6 form-group">
                  <input type="checkbox" name="archivo_manual_en" value="1" id="archivo_manual_en"> Ingresar nombre de archivo ya existente
                  {!! Form::text('name_file_en',null ,['id'=>'name_file_en', 'class' => 'form-control input-admin', 'placeholder' => 'nombrearchivo.ext', 'disabled'])!!}
                </div>
              </div>
              <div class="col-md-12 form-group">
                <label class="label-input-format label-titulo">Fecha de publicación</label>
                {!! Form::date('fecha_publicacion',date('Y-m-d') ,['class' => 'form-control input-admin'])!!}
              </div>
              <div class="actionsNext col-md-12 hidden" style="padding-bottom: 30px; padding-top: 20px;">
                <div class="col-md-12">
                  <label class="error msjLenguajes">Habilitó lenguajes</label>
                </div>
                <button class="next" type="submit">Siguiente</button>
              </div>
              <div class="actions col-md-12" style="padding-bottom: 30px; padding-top: 20px;">
                <input type="hidden" id="open" name="open" value="0">
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

           var reader = new FileReader();


           var file = document.getElementById('nueva-img-ftp');

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

       });
   </script>
<script>
  $(document).ready(function(){
    $('.select-multiple').select2();
    $('.wysi-textarea').summernote({

        callbacks: {
          onPaste: function(e) {
            console.log('entro');
            // $('.note-editable img').each(function(){
            //   console.log('imagen');
            //   var data = $(this).attr('src');
            //   var txt = data.substr(0,5);
            //   if(txt=='data:'){
            //     $(this).remove();
            //   }
            // });
          }
        }

      });
  });
    $(document).on('change', '.file', function() {

       var input = $(this);
       var parent = $(input).parent();
       var reader = new FileReader();

      reader.onload = function(e) {
         $(parent).find('img').attr('src', e.target.result);
         $(parent).find('.mensaje').addClass('hidden');
     };
     reader.readAsDataURL(this.files[0]);


    });
    $(document).on('click', '#lang_en', function() {
      $(".next").trigger("click");
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
      $('#open').val('0');
      $('.submit-form').click();
    });
    $('.btn-submit-publish-form').click(function(){
      $('#open').val('1');
      $('.submit-form').click();
    });

    if( $('#habilitar-lang').prop('checked') ) {
      $('.versiones-languages').removeClass('hidden');
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
        console.log('esvacio');
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
<script>
// $(function() {
//     function reposition() {
//         var modal = $(this),
//             dialog = modal.find('.modal-dialog');
//         modal.css('display', 'block');
//         modal.addClass("modal-traslate");
//         dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2));
//     }
//     $('.modal').on('show.bs.modal', reposition);
//     $(window).on('resize', function() {
//         $('.modal:visible').each(reposition);
//     });
// });
</script>
@endsection
