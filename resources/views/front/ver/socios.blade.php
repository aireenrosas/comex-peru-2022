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
    <div class="socioscont">
      <div class="row row-nomargin">
        <div class="col-md-12 col-xs-12 cont-socios col-nopadding cont-socios-first">
          <div class="col-md-4 col-xs-4 padd20 border-gris">
            <div class="det-socios">
              <a href="{{ url($ruta."/oportunidadescomerciales") }}">
                <img src="{!!url('/images/luggage.png')!!}" class="img-responsive img-socios" alt="Oportunidades Comerciales Icono"/>
                <p class="text-socios24">{!!trans('contenido.oport_comerciales')!!}</p>
                <p class="parrafo-socios14">{!!trans('contenido.oport_comerciales_texto')!!}</p>
              </a>
            </div>
          </div>
          <div class="col-md-4 col-xs-4 padd20 border-gris">
            <div class="det-socios">
              <a href="https://www.datasur.com/" target="_blank">
                <img src="{!!url('/images/bell.png')!!}" class="img-responsive img-socios" alt=""/>
                <p class="text-socios24">DATASUR</p>
                <p class="parrafo-socios14">{!!trans('contenido.datasur_texto')!!}</p>
              </a>
            </div>
          </div>
          <div class="col-md-4 col-xs-4 padd20 border-gris">
            <div class="det-socios">
              <a href="https://www.comexperu.org.pe/comexresearch/index.html">
                <img src="{!!url('/images/search.png')!!}" class="img-responsive img-socios" alt=""/>
                <p class="text-socios24">COMEXRESEARCH</p>
                <p class="parrafo-socios14">{!!trans('contenido.comex_research_texto')!!}</p>
              </a>
            </div>
          </div>
        {{-- </div>
      </div>
      <div class="row row-nomargin">
        <div class="col-md-12 col-xs-12 cont-socios col-nopadding cont-socios-second"> --}}
          <div class="col-md-4 col-xs-4 padd20 border-gris">
            <div class="det-socios">
              <a href="{{ url($ruta."/dyb") }}">
                <img src="{!!url('/images/settings-1.png')!!}" class="img-responsive img-socios" alt=""/>
                <p class="text-socios24">DUN & BRADSTREET</p>
                <p class="parrafo-socios14">{!!trans('contenido.dun_texto')!!}</p>
              </a>
            </div>
          </div>
          <div class="col-md-4 col-xs-4 padd20 border-gris">
            <div class="det-socios">
              <a href="{{ url($ruta."/servicioconsultotiaempresarial") }}">
                <img src="{!!url('/images/presentation.png')!!}" class="img-responsive img-socios" alt=""/>
                <p class="text-socios24">{!!trans('contenido.consultoria')!!}</p>
                <p class="parrafo-socios14">{!!trans('contenido.consultoria_texto')!!}</p>
              </a>
            </div>
          </div>
          <div class="col-md-4 col-xs-4 padd20 border-gris">
            <div class="det-socios">
              <a href="{{ url($ruta."/obstaculoscomerciales") }}">
                <img src="{!!url('/images/target.png')!!}" class="img-responsive img-socios" alt=""/>
                <p class="text-socios24">{!!trans('contenido.obstaculos')!!}</p>
                <p class="parrafo-socios14">{!!trans('contenido.obstaculos_texto')!!}</p>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="cont-img-socios">
        <img src="{!!url('/images/banner-socios.png')!!}" class="image-responsive" alt=""/>
      </div>
    </div>
  </div>
@endsection
