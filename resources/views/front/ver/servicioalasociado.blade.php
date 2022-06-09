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
    <div class="servicioscont serv-afiliado-cont">
      <div class="cont-servicios row">
        <div class="col-md-2 col-sm-2 hidden-sm hidden-xs col-nopadding"></div>
        <div class="col-md-8 col-sm-10 col-xs-12 col-nopadding anchoservicio">
          <div class="col-md-3 col-sm-10 col-xs-12 col-nopadding">
            <h3 class="titulo30">{!!trans('contenido.servicios_afiliado')!!}</h3>
          </div>
        </div>
        <div class="col-md-2 col-sm-2 hidden-sm hidden-xs col-nopadding"></div>
      </div>
      <div class="row">
        <div class="col-md-2 col-sm-2 hidden-sm hidden-xs col-nopadding"></div>
        <div class="col-md-8 col-sm-10 col-xs-12 col-nopadding parrafo14" style="margin-bottom:30px;">
          {!!trans('contenido.servicios_afiliado_sub1')!!}
        </div>
        <div class="col-md-2 col-sm-2 hidden-sm hidden-xs col-nopadding"></div>
      </div>


      <div class="socioscont">
        <div class="row">
          <div class="col-md-2 hidden-sm hidden-xs"></div>
          <div class="col-md-8 col-sm-12 col-xs-12 cont-socios col-nopadding cont-socios-first">
            <div class="col-md-4 col-sm-6 col-xs-12 padd20 border-gris">
              <div class="det-socios">
                  <img src="{!!url('/images/luggage.png')!!}" class="img-responsive img-socios" alt="Oportunidades Comerciales Icono"/>
                  <p class="text-socios24">{!!trans('contenido.oport_comerciales')!!}</p>
                  <p class="parrafo-socios14">{!!trans('contenido.oport_comerciales_texto')!!}</p>
              </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 padd20 border-gris">
                <div class="det-socios">
                  <img src="{!!url('/images/bell.png')!!}" class="img-responsive img-socios" alt=""/>
                  <p class="text-socios24">DATASUR</p>
                  <p class="parrafo-socios14">{!!trans('contenido.datasur_texto')!!}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 padd20 border-gris">
              <div class="det-socios">
                  <img src="{!!url('/images/search.png')!!}" class="img-responsive img-socios" alt=""/>
                  <p class="text-socios24">COMEX <br> RESEARCH</p>
                  <p class="parrafo-socios14">{!!trans('contenido.comex_research_texto')!!}</p>
              </div>
            </div>
          {{-- </div> --}}
          {{-- <div class="col-md-2 hidden-sm hidden-xs"></div> --}}
        {{-- </div>
        <div class="row"> --}}
          {{-- <div class="col-md-2 hidden-sm hidden-xs"></div> --}}
          {{-- <div class="col-md-12 col-sm-12 col-xs-8 cont-socios col-nopadding cont-socios-second"> --}}
            <div class="col-md-4 col-sm-6 col-xs-12 padd20 border-gris">
              <div class="det-socios">
                  <img src="{!!url('/images/settings-1.png')!!}" class="img-responsive img-socios" alt=""/>
                  <p class="text-socios24">DUN & BRADSTREET</p>
                  <p class="parrafo-socios14">{!!trans('contenido.dun_texto')!!}</p>
              </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 padd20 border-gris">
              <div class="det-socios">
                  <img src="{!!url('/images/presentation.png')!!}" class="img-responsive img-socios" alt=""/>
                  <p class="text-socios24">{!!trans('contenido.consultoria')!!}</p>
                  <p class="parrafo-socios14">{!!trans('contenido.consultoria_texto')!!}</p>
              </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 padd20 border-gris">
              <div class="det-socios">
                  <img src="{!!url('/images/target.png')!!}" class="img-responsive img-socios" alt=""/>
                  <p class="text-socios24">{!!trans('contenido.obstaculos')!!}</p>
                  <p class="parrafo-socios14">{!!trans('contenido.obstaculos_texto')!!}</p>
              </div>
            </div>
          </div>
          <div class="col-md-2 hidden-sm hidden-xs"></div>
        </div>
        <!-- <div class="cont-img-socios">
          <img src="{!!url('/images/banner-socios.png')!!}" class="image-responsive" alt=""/>
        </div> -->
      </div>


      <div class="row">
        <div class="col-md-2 col-sm-2 hidden-sm hidden-xs col-nopadding"></div>
        <div class="col-md-8 col-sm-10 col-xs-12 col-nopadding parrafo14" style="margin-top:30px;">
          {!!trans('contenido.servicios_afiliado_li1')!!}
          <div class="btnDescargar-cont text-center">
            <a href="{{url('documentos/servicios_asociado.pdf')}}" target="_blank">
              <i class="fa fa-file-pdf-o pdf-descargar" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="col-md-2 col-sm-2 hidden-sm hidden-xs col-nopadding"></div>
      </div>

      <div class="hidden-xs">
        @include('front.servicios.nuestrosservicios')
      </div>



    </div>
  </div>
@endsection
