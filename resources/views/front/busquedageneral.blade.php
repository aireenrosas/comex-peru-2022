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
    <div class="lista-publicaciones-cont busquedageneral">

      <div class="publicaciones-cont">
        <p class="col-md-offset-1 msj-coincidencias">{!!trans('contenido.coincidencias')!!} <span>{{$busqueda}}</span></p>

      @if($data_active['web']==1)
        <div class="row row-nomargin cont-subcripcion">
          <div class="col-md-12 col-nopadding">
            <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
            <div class="col-md-9 col-sm-9 col-xs-12 col-nopadding cont-subcripcion-elem">
                <p class="text-title-busqueda">{!!trans('contenido.secciones_web')!!}</p>
            </div>
            <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
          </div>
        </div>

        @if(count($data_secciones)>0)
          @foreach ($data_secciones as $key)
            <div class="row row-nomargin row-publicacion">
              <div class="col-md-12 col-nopadding">
                <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
                <div class="col-md-10 col-sm-10 col-xs-12 col-nopadding">
                  <div class="cont-publication-elem">
                    <a href="{{Funciones::getUrl($key->tipo, $key->ruta, $key->idpubli, $ruta)}}">
                      <p class="red">
                         <span class="tag-busqueda">{{Funciones::getTipoBusqueda($key->tipo, $key->idpubli, $ruta)}}</span> {!!preg_replace('#<[^>]+>#', ' ', $key->titulo)!!}
                      </p>
                    </a>
                    <p class="Contenido-Publicac">
                      <span class="Contenido-Publicac2">
                        {!!Funciones::myTruncate(strip_tags($key->detalle), 150, ' ', '...')!!}
                      </span>
                      @if($key->publicacion!="1")
                      <a href="{{url($ruta.'/publicaciones?id='.$key->idpubli.'&publicacion='.  $key->publicacion.'&edicion='.$key->edition)}}" class="Contenido-Publicac">
                        <span>{{$key->publicacion}}  {{$key->edition}}</span>
                      </a>
                      @endif
                    </p>
                    <small>{{Funciones::getDateString($key->fecha, $language_id)}}</small>

                  </div>
                </div>
                <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
              </div>
            </div>
            @endforeach
            @if($data_active['completo']==0)
            <div class="div-todosresultados row">
              <a href="{{url($ruta.'/busquedageneral?busqueda='.$busqueda.'&section=web')}}" class="link-mas">{!!trans('contenido.todos_resultados')!!}<span class="section-busqueda">{!!trans('contenido.secciones_web')!!}</span></a>
            </div>
            @endif
        @else
          <p class="col-md-offset-1 msj-coincidencias">{!!trans('contenido.no_resultados1')!!}</p>
        @endif

      @endif

      @if($data_active['revista']==1)
        <div class="row row-nomargin cont-subcripcion">
          <div class="col-md-12 col-nopadding">
            <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
            <div class="col-md-9 col-sm-9 col-xs-12 col-nopadding cont-subcripcion-elem">
                <p class="text-title-busqueda">{!!trans('contenido.revistas')!!}</p>
            </div>
            <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
          </div>
        </div>
        {{-- <div class="pagination-box" align="center" style="width: 100%">
          {{$data_revistas->appends(['busqueda'=>$busqueda, 'section'=>'revistas'])->links()}}
        </div> --}}
        @if(count($data_revistas)>0)
          @foreach ($data_revistas as $key)
            <div class="row row-nomargin row-publicacion">
              <div class="col-md-12 col-nopadding">
                <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
                <div class="col-md-10 col-sm-10 col-xs-12 col-nopadding">
                  <div class="cont-publication-elem">
                    <a href="{{Funciones::getUrl($key->tipo, $key->ruta, $key->idpubli, $ruta)}}">
                      <p class="red">
                        {!!preg_replace('#<[^>]+>#', ' ', $key->titulo)!!}
                      </p>
                    </a>
                    <p class="Contenido-Publicac">
                      @if($key->columna!="" && $key->columna!='1')
                      <span class="Contenido-Publicac2">
                        ({!!trim($key->columna)!!})
                      </span>
                      <br>
                      @endif
                      @if($key->publicacion!="1")
                      <a href="{{url($ruta.'/publicaciones?id='.$key->idpubli.'&publicacion='.  $key->publicacion.'&edicion='.$key->edition)}}" class="Contenido-Publicac">
                        <span>{{$key->publicacion}}  {{$key->edition}}</span>
                      </a>
                      @endif
                    </p>
                    <small>{{Funciones::getDateString($key->fecha, $language_id)}}</small>
                  </div>
                </div>
                <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
              </div>
            </div>
            @endforeach
            @if($data_active['completo']==0)
            <div class="div-todosresultados row">
              <a href="{{url($ruta.'/busquedageneral?busqueda='.$busqueda.'&section=revistas')}}" class="link-mas">{!!trans('contenido.todos_resultados')!!}<span class="section-busqueda">{!!trans('contenido.revistas')!!}</span></a>
            </div>
            @endif
        @else
          <p class="col-md-offset-1 msj-coincidencias">{!!trans('contenido.no_resultados1')!!}</p>
        @endif

      @endif

      @if($data_active['semanario']==1)
        <div class="row row-nomargin cont-subcripcion">
          <div class="col-md-12 col-nopadding">
            <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
            <div class="col-md-9 col-sm-9 col-xs-12 col-nopadding cont-subcripcion-elem">
                <p class="text-title-busqueda">{!!trans('contenido.semanarios')!!}</p>
            </div>
            <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
          </div>
        </div>
        @if(count($data_semanarios)>0)
          @foreach ($data_semanarios as $key)
            <div class="row row-nomargin row-publicacion">
              <div class="col-md-12 col-nopadding">
                <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
                <div class="col-md-10 col-sm-10 col-xs-12 col-nopadding">
                  <div class="cont-publication-elem">
                    <a href="{{Funciones::getUrl($key->tipo, $key->ruta, $key->idpubli, $ruta)}}">
                      <p class="red">
                        {!!preg_replace('#<[^>]+>#', ' ', $key->titulo)!!}
                      </p>
                    </a>
                    <p class="Contenido-Publicac">
                      @if($key->columna!="" && $key->columna!='1')
                      <span class="Contenido-Publicac2">
                        ({!!trim($key->columna)!!})
                      </span>
                      <br>
                      @endif
                      @if($key->publicacion!="1")
                      <a href="{{url($ruta.'/publicaciones?id='.$key->idpubli.'&publicacion='.  $key->publicacion.'&edicion='.$key->edition)}}" class="Contenido-Publicac">
                        <span>{{$key->publicacion}}  {{$key->edition}}</span>
                      </a>
                      @endif
                    </p>
                    <small>{{Funciones::getDateString($key->fecha, $language_id)}}</small>
                  </div>
                </div>
                <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
              </div>
            </div>
            @endforeach
            @if($data_active['completo']==0)
            <div class="div-todosresultados row">
              <a href="{{url($ruta.'/busquedageneral?busqueda='.$busqueda.'&section=semanarios')}}" class="link-mas">{!!trans('contenido.todos_resultados')!!}<span class="section-busqueda">{!!trans('contenido.semanarios')!!}</span></a>
            </div>
            @endif
        @else
          <p class="col-md-offset-1 msj-coincidencias">{!!trans('contenido.no_resultados1')!!}</p>
        @endif

      @endif

      @if($data_active['foro']==1)
        <div class="row row-nomargin cont-subcripcion">
          <div class="col-md-12 col-nopadding">
            <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
            <div class="col-md-9 col-sm-9 col-xs-12 col-nopadding cont-subcripcion-elem">
                <p class="text-title-busqueda">{!!trans('contenido.seminarios')!!}</p>
            </div>
            <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
          </div>
        </div>

        @if(count($data_foro)>0)
          @foreach ($data_foro as $key)
            <div class="row row-nomargin row-publicacion">
              <div class="col-md-12 col-nopadding">
                <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
                <div class="col-md-10 col-sm-10 col-xs-12 col-nopadding">
                  <div class="cont-publication-elem">
                    <a href="{{Funciones::getUrl($key->tipo, $key->ruta, $key->idpubli, $ruta)}}">
                      <p class="red">
                         {!!preg_replace('#<[^>]+>#', ' ', $key->titulo)!!}
                      </p>
                    </a>
                    <p class="Contenido-Publicac">
                      <span class="Contenido-Publicac2">
                        {!!Funciones::myTruncate(strip_tags($key->detalle), 150, ' ', '...')!!}
                      </span>
                    </p>
                    <small>{{Funciones::getDateString($key->fecha, $language_id)}}</small>
                  </div>
                </div>
                <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
              </div>
            </div>
            @endforeach
            @if($data_active['completo']==0)
            <div class="div-todosresultados row">
              <a href="{{url($ruta.'/busquedageneral?busqueda='.$busqueda.'&section=foro')}}" class="link-mas">{!!trans('contenido.todos_resultados')!!}<span class="section-busqueda">{!!trans('contenido.seminarios')!!}</span></a>
            </div>
            @endif
        @else
          <p class="col-md-offset-1 msj-coincidencias">{!!trans('contenido.no_resultados1')!!}</p>
        @endif

      @endif
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function(){
      $('.cont-publication-elem').removeClass('topCero');
    });

  </script>
  <script>
  $("a[href*='.pdf'],a[href*='.html']").each(function() {
        $(this).attr('target','_blank');
    });
  </script>

@endsection
