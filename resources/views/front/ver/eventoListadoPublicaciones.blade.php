@extends('app.app')
<?php
$ogdescription = 'ComexPerú es el gremio privado que agrupa a las principales empresas vinculadas al Comercio Exterior en el Perú.';
$ogimage = '';
$ogtitle = 'COMEX - Sociedad de Comercio Exterior del Perú - Inicio';
$ogurl = url('/');
?>
@section('style')
@endsection
@section('script')
@endsection
@section('content')
  <div class="container-comex">
    <div class="lista-publicaciones-cont">
      <div class="row row-nomargin cont-subcripcion">
        <div class="col-md-12 col-nopadding">
          <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
          <div class="col-md-9 col-sm-9 col-xs-12 col-nopadding cont-subcripcion-elem">
              <p class="text-subscripcion">{!!trans('contenido.foro')!!}</p>
          </div>
          <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
        </div>
      </div>
      <div class="pagination-box" align="center" style="width: 100%">
        {{$presentaciones->links()}}
      </div>
      <div class="publicaciones-cont">
        @foreach ($presentaciones as $key)
        <div class="row row-nomargin row-publicacion">
          <div class="col-md-12 col-nopadding">
            <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
            <div class="col-md-10 col-sm-10 col-xs-12 col-nopadding">
              <div class="cont-publication-elem">
                <?php
                  if($key->file!=='' && $key->file){
                      $file = url('upload/seminars/foro/'.$key->file);
                  }
                  else{
                    $file = '#';
                  }
                ?>
                {{-- <div class="publi-elem"> --}}
                  <a href="{{$file}}">
                    <p class="red">
                      {{$key->title}}
                    </p>
                  </a>
                  <p class="Contenido-Publicac">
                    <span class="Contenido-Publicac2">{{$key->name}}</span><br>
                    {{$key->theme}}
                  </p>
                  <small>{{Funciones::getDateString($key->date, $language_id)}}</small>
                {{-- </div> --}}
              </div>
            </div>
            <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="pagination-box" align="center" style="width: 100%">
        {{$presentaciones->links()}}
      </div>
    </div>
  </div>


  <script>
  $("a[href*='.pdf'],a[href*='.html']").each(function() {
        $(this).attr('target','_blank');
    });
  </script>
@endsection
