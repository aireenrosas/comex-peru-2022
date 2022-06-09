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
    <div class="servicioscont asuntos-inter-cont">
      <div class="row row-nomargin">
        <div class="col-md-12 col-nopadding">
          <div class="col-md-2 col-sm-2 hidden-xs"></div>
          <div class="col-md-8 col-sm-8 col-xs-12 col-nopadding">
            <div class="col-md-3 col-sm-12 col-nopadding">
              <h1 class="titulo30">{!!trans('contenido.asuntos_inter')!!}</h1>
            </div>
          </div>
          <div class="col-md-2 col-sm-2 hidden-xs"></div>
        </div>
      </div>
      <div class="cont-bannerserv">
        <div class="imagenservicios">
          <img src="{!!url('/images/banner-asuntos-internacionales.png')!!}" class="img-responsive img-serv" alt=""/>
        </div>
      </div>
      <div class="cont-asuntos-servicios row row-nomargin">
        <div class="col-md-12 col-nopadding">
          <div class="col-md-2 col-sm-2 hidden-xs"></div>
          <div class="col-md-8 col-sm-8 col-xs-12 section-servicios col-nopadding">
            <div class="col-md-12 col-nopadding">
              <div class="col-md-3 col-sm-12 col-xs-12 linea-respo nosotros titservancho">
                <h2 class="titulo25">{!!trans('contenido.asuntos_inter_textoa')!!}</h2>
              </div>
              <div class="col-md-1 hidden-xs espacio"></div>
              <div class="col-md-8 col-sm-12 col-xs-12 col-nopadding">
                <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
                  <p class="parrafojustify">{!!trans('contenido.asuntos_inter_textob')!!}</p>
                  <p class="parrafojustify">{!!trans('contenido.asuntos_inter_textoc')!!}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2 col-sm-2 hidden-xs"></div>
        </div>
      </div>
      <div class="cont-asuntos-servicios row row-nomargin">
        <div class="col-md-12 col-nopadding">
          <div class="col-md-2 col-sm-2 hidden-xs"></div>
          <div class="col-md-8 col-sm-8 col-xs-12 section-servicios col-nopadding">
            <div class="col-md-12 col-nopadding">
              <div class="col-md-3 col-sm-12 col-xs-12 linea-respo nosotros titservancho">
                <h2 class="titulo25">{!!trans('contenido.asuntos_inter_textod')!!}</h2>
              </div>
              <div class="col-md-1 hidden-xs espacio"></div>
              <div class="col-md-8 col-sm-12 col-xs-12 col-nopadding">
                <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
                  <p class="parrafojustify">{!!trans('contenido.asuntos_inter_textoe')!!}</p>
                  <p class="parrafojustify"><b>{!!trans('contenido.asuntos_inter_textof')!!}</b></p>
                  <p class="parrafojustify">{!!trans('contenido.asuntos_inter_textog')!!}</p>
                  <p class="parrafojustify"><b>{!!trans('contenido.asuntos_inter_textoh')!!}</b></p>
                  <p class="parrafojustify">{!!trans('contenido.asuntos_inter_textoi')!!}</p>
                  <p class="parrafojustify">{!!trans('contenido.asuntos_inter_textoj')!!}</p>
                  <p class="parrafojustify">{!!trans('contenido.asuntos_inter_textok')!!}</p>
                  <p class="parrafojustify"><b>{!!trans('contenido.asuntos_inter_textol')!!}</b></p>
                  <p class="parrafojustify">{!!trans('contenido.asuntos_inter_textom')!!}</p>
                  <p class="parrafojustify">{!!trans('contenido.asuntos_inter_texton')!!}</p>

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2 col-sm-2 hidden-xs"></div>
        </div>
      </div>
      <div class="cont-asuntos-servicios row row-nomargin">
        <div class="col-md-12 col-nopadding">
          <div class="col-md-2 col-sm-2 hidden-xs"></div>
          <div class="col-md-8 col-sm-8 col-xs-12 section-servicios col-nopadding">
            <div class="col-md-12 col-nopadding">
              <div class="col-md-3 col-sm-12 col-xs-12 linea-respo nosotros titservancho">
                <h2 class="titulo25">{!!trans('contenido.asuntos_inter_textop')!!}</h2>
              </div>
              <div class="col-md-1 hidden-xs espacio"></div>
              <div class="col-md-8 col-sm-12 col-xs-12 col-nopadding">
                <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
                  <p class="parrafojustify">{!!trans('contenido.asuntos_inter_textoq')!!}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2 col-sm-2 hidden-xs"></div>
        </div>
      </div>
      <div class="cont-asuntos-servicios row row-nomargin">
        <div class="col-md-12 col-nopadding">
          <div class="col-md-2 col-sm-2 hidden-xs"></div>
          <div class="col-md-8 col-sm-8 col-xs-12 section-servicios col-nopadding">
            <div class="col-md-12 col-nopadding">
              <div class="col-md-3 col-sm-12 col-xs-12 linea-respo nosotros titservancho">
                <h2 class="titulo25">{!!trans('contenido.asuntos_inter_textor')!!}</h2>
              </div>
              <div class="col-md-1 hidden-xs espacio"></div>
              <div class="col-md-8 col-sm-12 col-xs-12 col-nopadding">
                <div class="col-md-12 col-xs-12 col-nopadding ppparte2">
                  <p class="parrafojustify">{!!trans('contenido.asuntos_inter_textos')!!}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2 col-sm-2 hidden-xs"></div>
        </div>
      </div>
      <div class="hidden-xs">
          @include('front.servicios.nuestrosservicios')
      </div>
    </div>
  </div>
@endsection
