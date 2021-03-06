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
    <div class="servicioscont abtc-cont">
      <div class="cont-servicios row row-nomargin">
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
        <div class="col-md-8 col-sm-8 col-xs-12 section-servicios col-nopadding anchoservicio">
          <div class="col-md-3 col-sm-5 col-xs-12 col-nopadding">
            <h1 class="titulo30">{!!trans('contenido.abtc')!!}</h1>
          </div>
          <div class="col-md-1 col-sm-1 hidden-xs espacio"></div>
          <div class="col-md-8 col-sm-8 col-xs-12 col-nopadding anchoservicio ancho100 ">
            <div class="">
              <p class="parrafo14">{!!trans('contenido.abtc_texto')!!}</p>
            </div>
          </div>
        </div>
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
      </div>
      <div class="cont-bannerserv">
        <div class="imagenservicios">
          <img src="{!!url('/images/banner-abtc.png')!!}" class="img-responsive img-serv" alt=""/>
        </div>
      </div>
      <div class="cont-servicios row row-nomargin">
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
        <div class="col-md-8 col-sm-8 col-xs-12 section-serviciospp col-nopadding anchoservicio">
          <div class="col-md-3 col-sm-5 col-xs-12"></div>
          <div class="col-md-1 col-sm-1 hidden-xs espacio"></div>
          <div class="col-md-8 col-sm-8 col-xs-12 det-servicios rightcero advantages-abtc">
            <div class="col-md-12 col-xs-12 col-nopadding ppparte1">
              <p class="parrafo14">{!!trans('contenido.abtc_ventajas')!!}</p>
            </div>
            <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
              <div class="seccionder">
                <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
              </div>
              <div class="seccionizq">
                <p class="parrafo14">{!!trans('contenido.abtc_textoa')!!}</p>
              </div>
            </div>
            <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
              <div class="seccionder">
                <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
              </div>
              <div class="seccionizq">
                <p class="parrafo14">{!!trans('contenido.abtc_textob')!!}</p>
              </div>
            </div>
            <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
              <p class="parrafo14 parrafo-pri">{!!trans('contenido.abtc_textoc')!!}</p>
              <p class="parrafo14">{!!trans('contenido.abtc_textod')!!}</p>
            </div>
          </div>
        </div>
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
      </div>
      <div class="cont-servicios row row-nomargin">
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
        <div class="col-md-8 col-sm-8 col-xs-12 section-serviciospp col-nopadding anchoservicio">
          <div class="col-md-3 col-sm-5 col-xs-12 line-servicios ancho100">
            <h3 class="titulo25">{!!trans('contenido.abtc_documentos')!!}</h3>
          </div>
          <div class="col-md-1 col-sm-1 hidden-xs espacio"></div>
          <div class="col-md-8 col-sm-8 col-xs-12 det-servicios rightcero">
            <div class="col-md-12 col-xs-12 col-nopadding  docs-needed ppparte1">
              <p class="parrafo14">{!!trans('contenido.abtc_documentostexto')!!}</p>
            </div>
            <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
              <div class="seccionder">
                <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
              </div>
              <div class="seccionizq">
                <a class="download" href="{{url('archivos/abtc/Anexo%201%20-%20REQUISITOS.pdf')}}" download="anexo-1"><p class="parrafo14">{!!trans('contenido.abtc_documentosa')!!}</p>
              </div>
            </div>
            <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
              <div class="seccionder">
                <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
              </div>
              <div class="seccionizq">
                <a class="download" href="{{url('archivos/abtc/Anexo%202%20-Solicitud%20de%20Elegibilidad.pdf')}}" download="anexo-2"><p class="parrafo14">{!!trans('contenido.abtc_documentosb')!!}</p>
              </div>
            </div>
            <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
              <div class="seccionder">
                <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
              </div>
              <div class="seccionizq">
                <a class="download" href="{{url('archivos/abtc/Anexo%203%20-%20Carta%20de%20presentación%20empresa.doc')}}" download="anexo-3"><p class="parrafo14">{!!trans('contenido.abtc_documentosc')!!}</p>
              </div>
            </div>
            <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
              <div class="seccionder">
                <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
              </div>
              <div class="seccionizq">
                <a class="download" href="{{url('archivos/abtc/Anexo%204%20-%20Carta%20Autorizacion.doc')}}" download="anexo-4"><p class="parrafo14">{!!trans('contenido.abtc_documentosd')!!}</p>
              </div>
            </div>
            <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
			<div class="seccionder">
                <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
              </div>
              <div class="seccionizq">
                <a class="download" href="{{url('archivos/abtc/Anexo%205%20-%20Carta%20Declaracion.doc')}}" download="anexo-5"><p class="parrafo14">{!!trans('contenido.abtc_documentosf')!!}</p>
              </div>
            </div>
            <!--<div class="col-md-12 col-xs-12 col-nopadding ppparte2">
              <div class="seccionder">
                <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
              </div>
              <div class="seccionizq">
                <a class="download" href="{{url('archivos/abtc/Anexo%206%20-%20Carta%20Declaración.doc')}}" download="anexo-6"><p class="parrafo14">{!!trans('contenido.abtc_documentosf')!!}</p>
              </div>
            </div>-->
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
