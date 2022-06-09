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
    <div class="servicioscont politics-publi-cont">
      <div class="cont-servicios row row-nomargin">
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
        <div class="col-md-8 col-sm-8 col-xs-12 section-servicios col-nopadding anchoservicio">
          <div class="col-md-3 col-sm-5 col-sx-12 col-nopadding">
            <h1 class="titulo30">{!!trans('contenido.politicas')!!}</h1>
          </div>
          <div class="col-md-1 col-xs-1 espacio"></div>
          <div class="col-md-8 col-sm-8 col-xs-12 col-nopadding ancho ancho100">
            <div class="">
              <p class="parrafo14">{!!trans('contenido.politicas_texto')!!}</p>
            </div>
          </div>
        </div>
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
      </div>
      <div class="cont-bannerserv row row-nomargin">
        <div class="imagenservicios">
          <img src="{!!url('/images/banner-politicas-publicas.png')!!}" class="img-responsive img-serv" alt=""/>
        </div>
      </div>
      <div class="cont-servicios row row-nomargin">
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
        <div class="col-md-8 col-sm-8 col-xs-12 section-serviciospp col-nopadding anchoservicio">
          <div class="col-md-3 col-sm-5 col-sx-12"></div>
          <div class="col-md-1 col-sm-1 hidden-xs espacio"></div>
          <div class="col-md-8 col-sm-8 col-xs-12 det-servicios rightcero ancho">
            <div class="col-md-12 col-xs-12 col-nopadding ppparte1">
              <p class="parrafo14">{!!trans('contenido.politicas_textoa')!!} </p>
            </div>
            <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
              <div class="seccionder">
                <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
              </div>
              <div class="seccionizq">
                <p class="parrafo14">{!!trans('contenido.politicas_textob')!!}</p>
              </div>
            </div>
            <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
              <div class="seccionder">
                <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
              </div>
              <div class="seccionizq">
                <p class="parrafo14">{!!trans('contenido.politicas_textoc')!!}</p>
              </div>
            </div>
            <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
              <div class="seccionder">
                <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
              </div>
              <div class="seccionizq">
                <p class="parrafo14">{!!trans('contenido.politicas_textod')!!}</p>
              </div>
            </div>
            <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
              <div class="seccionder">
                <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
              </div>
              <div class="seccionizq">
                <p class="parrafo14">{!!trans('contenido.politicas_textoe')!!}</p>
              </div>
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
