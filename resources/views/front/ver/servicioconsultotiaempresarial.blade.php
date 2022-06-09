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
    <div class="servicioscont consultoria-cont">
      <div class="cont-servicios row row-nomargin">
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
        <div class="col-md-8 col-sm-8 col-xs-12 section-servicios leftcero rightcero anchoservicio">
          <div class="col-md-3 col-sm-5 col-xs-12 sinline-servicios ancho titservancho">
            <h1 class="titulo30">{!!trans('contenido.consultoria_text1')!!}</h1>
          </div>
          <div class="col-md-1 col-sm-1 hidden-xs espacio"></div>
          <div class="col-md-8 col-sm-8 col-xs-12 leftcero rightcero ancho parservancho">
            <div class="">
              <p class="parrafo14">{!!trans('contenido.consultoria_text1_content')!!}</p>
            </div>
          </div>
        </div>
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
      </div>
      <div class="cont-bannerserv row row-nomargin">
        <div class="imagenservicios">
          <img src="{!!url('/images/banner-consultoria-empresarial.png')!!}" class="img-responsive img-serv" alt=""/>
        </div>
      </div>
      <div class="cont-servicios row row-nomargin">
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
        <div class="col-md-8 col-sm-8 col-xs-12 section-servicios leftcero rightcero anchoservicio">
          <div class="col-md-3 col-sm-12 col-xs-12 nosotros ancho titservancho">
            <h2 class="titulo25">{!!trans('contenido.consultoria_text2')!!}</h2>
          </div>
          <div class="col-md-1 col-sm-1 hidden-xs espacio"></div>
          <div class="col-md-8 col-sm-8 col-xs-12 det-servicios leftcero rightcero ancho">
            <div class="col-md-12 col-xs-12 leftcero rightcero ceparte1 ancho">
              <p class="parrafo14">{!!trans('contenido.consultoria_text2_content')!!}</p>
            </div>
            <div class="col-md-12 col-xs-12 leftcero rightcero ceparte2">
              <div class="">
                <div class="titulo20"><i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>{!!trans('contenido.consultoria_text2_I')!!}</div>
                <p class="padd-parrafo14">{!!trans('contenido.consultoria_text2_Ia')!!}</p>
                <p class="padd-parrafo14">{!!trans('contenido.consultoria_text2_Ib')!!}</p>
              </div>
              <div class="cont-imagenserv">
                <img src="{!!url('/images/consultoria-empresarial.png')!!}" class="img-responsive img-serv" alt=""/>
              </div>
              <div class="">
                <div class="titulo20"><i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>{!!trans('contenido.consultoria_text2_II')!!}</div>
                <p class="padd-parrafo14">{!!trans('contenido.consultoria_text2_IIa')!!}</p>
                <p class="padd-parrafo14">{!!trans('contenido.consultoria_text2_IIb')!!}</p>
              </div>
            </div>
            <div class="col-md-12 col-xs-12 leftcero rightcero ceparte2">
              <div class="">
                <div class="titulo20"><i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>{!!trans('contenido.consultoria_text2_III')!!}</div>
                <p class="padd-parrafo14">{!!trans('contenido.consultoria_text2_IIIa')!!}</p>
                <p class="padd-parrafo14">{!!trans('contenido.consultoria_text2_IIIb')!!}</p>
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
