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
  <!--[if lt IE 9]>
      <script src="../assets/global/plugins/respond.min.js"></script>
      <script src="../assets/global/plugins/excanvas.min.js"></script>
      <![endif]-->
@endsection
@section('content')
  <div class="container-comex">
    <div class="servicioscont serv-publicaciones-cont">
      <div class="cont-servicios row row-nomargin">
        <div class="col-md-2 col-sm-2 hidden-xs bordesserv"></div>
        <div class="col-md-8 col-sm-8 col-xs-12 col-nopadding ">
          <div class="col-md-3 col-sm-5 col-xs-12 col-nopadding">
            <h1 class="titulo30">{!!trans('contenido.publicaciones')!!}</h1>
          </div>
        </div>
        <div class="col-md-2 col-sm-2 hidden-xs bordesserv"></div>
      </div>
      <div class="cont-bannerserv">
        <div class="imagenservicios">
          <img src="{!!url('/images/banner-publicaciones.png')!!}" class="img-responsive img-serv" alt=""/>
        </div>
      </div>
      <div class="publications-main-list row row-nomargin">
        <div class="col-md-2 col-sm-2 hidden-xs bordesserv"></div>
        <div class="col-md-8 col-sm-8 col-xs-12 col-nopadding">
          <div class="col-md-3 col-sm-3 hidden-xs"></div>
          <div class="col-md-1 col-sm-1 hidden-xs espacio"></div>
          <div class="col-md-8 col-sm-8 col-xs-12 col-nopadding ancho100">
            <?php $i=1;?>
            @foreach ($publicaciones_publicas as $key)
              @if($i==1)
                <div class="col-md-12 col-xs-12 col-nopadding saparte">
              @else
                <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
              @endif
                  <div class="seccionder">
                    <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
                  </div>
                  <div class="seccionizq">
                    <p class="parrafo14"><a class="link-servicio" href="{{ url($ruta."/publicaciones?id=".$key->id."&publicacion=".$key->name) }}">{!! $key->name !!}</a></p>
                  </div>
                </div>
              <?php $i++;?>
            @endforeach
            {{-- <div class="col-md-12 col-xs-12 col-nopadding saparte">
              <div class="seccionder">
                <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
              </div>
              <div class="seccionizq">
                <p class="parrafo14"><a class="link-servicio" href="{{ url($ruta."/publicaciones?id=1&publicacion=Semanario") }}">{!!trans('contenido.publicaciones_textoa')!!}</a></p>
                <!-- <p class="parrafo14">{!!trans('contenido.publicaciones_textoa')!!}</p> -->
              </div>
            </div>
            <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
              <div class="seccionder">
                <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
              </div>
              <div class="seccionizq">
                <p class="parrafo14"><a class="link-servicio" href="{{ url($ruta."/publicaciones?id=4&publicacion=Datacomex") }}">{!!trans('contenido.publicaciones_textob')!!}</a></p>
                <!-- <p class="parrafo14">{!!trans('contenido.publicaciones_textob')!!}</p> -->
              </div>
            </div>
            <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
              <div class="seccionder">
                <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
              </div>
              <div class="seccionizq">
                <p class="parrafo14"><a class="link-servicio" href="{{ url($ruta."/publicaciones?id=3&publicacion=Agrocomex") }}">{!!trans('contenido.publicaciones_textoc')!!}</a></p>
                <!-- <p class="parrafo14">{!!trans('contenido.publicaciones_textoc')!!}</p> -->
              </div>
            </div>
            <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
              <div class="seccionder">
                <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
              </div>
              <div class="seccionizq">
                <p class="parrafo14"><a class="link-servicio" href="{{ url($ruta."/publicaciones?id=2&publicacion=Revista%20Negocios") }}">{!!trans('contenido.publicaciones_textod')!!}</a></p>
                <!-- <p class="parrafo14">{!!trans('contenido.publicaciones_textod')!!}</p> -->
              </div>
            </div>
            <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
              <div class="seccionder">
                <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
              </div>
              <div class="seccionizq">
                  <p class="parrafo14"><a class="link-servicio" href="{{ url($ruta."/publicaciones?id=5&publicacion=Memoria%20anual") }}">{!!trans('contenido.publicaciones_textoe')!!}</a></p>
                <!-- <p class="parrafo14">{!!trans('contenido.publicaciones_textoe')!!}</p> -->
              </div>
            </div> --}}
            @if(Auth::check())
              @foreach ($publicaciones_privadas as $key)
                <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
                  <div class="seccionder">
                    <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
                  </div>
                  <div class="seccionizq">
                      <p class="parrafo14"><a class="link-servicio" href="{{ url($ruta."/publicaciones?id=".$key->id."&publicacion=".$key->name) }}">{!! $key->name !!}</a></p>
                  </div>
                </div>
              @endforeach
            @endif
          </div>
        </div>
        <div class="col-md-2 col-sm-2 hidden-xs bordesserv"></div>
      </div>
      <div class="hidden-xs">
        @include('front.servicios.nuestrosservicios')
      </div>
    </div>
  </div>
@endsection
