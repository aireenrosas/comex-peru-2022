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
    <div class="servicioscont comunicacion-cont">
      <div class="cont-servicios row row-nomargin">
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
        <div class="col-md-8 col-sm-8 col-xs-12 section-servicios col-nopadding">
          <div class="col-md-3 col-sm-5 col-xs-12 col-nopadding">
            <h2 class="titulo30">{!!trans('contenido.comunicacion')!!}</h2>
          </div>
        </div>
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
      </div>
      <div class="cont-bannerserv">
        <div class="imagenservicios">
          <img src="{!!url('/images/banner-comunicacion.png')!!}" class="img-responsive img-serv" alt=""/>
        </div>
      </div>
      <div class="cont-servicios row row-nomargin">
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
        <div class="col-md-8 col-sm-8 col-xs-12 section-serviciospp col-nopadding">
          <div class="col-md-3 col-sm-3 hidden-xs"></div>
          <div class="col-md-1 col-sm-1 hidden-xs espacio"></div>
          <div class="col-md-8 col-sm-12 col-xs-12 det-servicios rightcero serv-comu">
            <div class="col-md-12 col-xs-12 leftcero rightcero ceparte1">
              <p class="parrafo14">{!!trans('contenido.comunicacion_texto')!!}</p>
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
