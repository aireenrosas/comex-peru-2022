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
    <div class="servicioscont">
      <div class="col-md-2 col-sm-2 hidden-xs"></div>
      <div class="col-md-8 col-sm-8 col-xs-12 col-nopadding comex-serv-cont">
        <div class="texto30">
          <strong>ComexPerú</strong> {!!trans('contenido.nuestrosservicios_texto')!!}
        </div>
      </div>
      <div class="col-md-2 col-sm-2 hidden-xs"></div>
      <div class="cont-bannerserv" style="padding: 0px">
        <div class="imagenservicios">
          <img src="{!!url('/images/banner-servicios.png')!!}" class="img-responsive img-serv" alt=""/>
        </div>
      </div>
      @include('front.servicios.nuestrosservicios')
    </div>
  </div>
@endsection
