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
    <div class="servicioscont est-econ-cont">
      <div class="cont-servicios row row-nomargin">
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
        <div class="col-md-8 col-sm-8 col-xs-12 col-nopadding">
          <div class="col-md-3 col-sm-12 col-xs-12 col-nopadding">
            <h1 class="titulo30">{!!trans('contenido.estudios')!!}</h1>
          </div>
        </div>
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
      </div>
      <div class="cont-bannerserv">
        <div class="imagenservicios">
          <img src="{!!url('/images/banner-estudios-economicos.png')!!}" class="img-responsive img-serv" alt=""/>
        </div>
      </div>
      <div class="cont-servicios row row-nomargin">
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
        <div class="col-md-8 col-sm-8 col-xs-12 section-serviciospp col-nopadding anchoservicio">
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="col-md-2 col-sm-2 hidden-xs"></div>
          </div>
          <div class="col-md-1 col-xs-1 espacio"></div>
          <div class="col-md-8 col-sm-8 col-xs-12 col-nopadding anchoservicio ancho100">
            <div class="col-md-12 col-xs-12 col-nopadding ppparte2 ancho100">
              <div class="">
                <p class="parrafojustify">{!!trans('contenido.estudios_I_texta')!!}</p>
                <p class="parrafojustify">{!!trans('contenido.estudios_I_textb')!!}</p>
                <p class="parrafojustify">{!!trans('contenido.estudios_I_textc')!!}</p>
                <p class="parrafojustify">{!!trans('contenido.estudios_I_textd')!!}</p>
              </div>
              <div class="cont-imagenee ">
                <img src="{!!url('/images/estudios-economicos.png')!!}" class="img-responsive img-serv" alt=""/>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
      </div>
      <div class="cont-servicios row row-nomargin">
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
        <div class="col-md-8 col-sm-8 col-xs-12 section-servicios col-nopadding anchoservicio">
          <div class="col-md-3 col-sm-12 col-xs-12 nosotros">
            <h2 class="titulo25">{!!trans('contenido.estudios_I')!!}</h2>
          </div>
          <div class="col-md-1 col-xs-1 espacio"></div>
          <div class="col-md-8 col-sm-8 col-xs-12 col-nopadding ancho100">
            <div class="col-md-12 col-xs-12 col-nopadding ppparte2 ancho100">
              <p class="parrafojustify">{!!trans('contenido.estudios_texta')!!}</p>
              <p class="parrafojustify">{!!trans('contenido.estudios_textb')!!}</p>
              <p class="parrafojustify">{!!trans('contenido.estudios_textc')!!}</p>
            </div>
          </div>
        </div>
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
      </div>
      <div class="hidden-xs">
              @include('front.servicios.nuestrosservicios')
      </div>
    </div>
  </div>
@endsection
