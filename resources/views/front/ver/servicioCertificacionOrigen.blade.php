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
    <div class="servicioscont cert-origen-cont">
      <div class="row row-nomargin">
        <div class="col-md-12 col-xs-12 col-nopadding">
          <div class="col-md-2 col-sm-1 hidden-xs"></div>
          <div class="col-md-2 col-sm-11 col-xs-12 col-nopadding">
            <h1 class="titulo30">{!!trans('contenido.titulo_certificacion')!!}</h1>
          </div>
        </div>
      </div>
      <div class="row row-nomargin">
        <div class="imagenservicios">
          <img src="{!!url('/images/cert-origen.jpg')!!}" class="img-responsive img-serv" alt=""/>
        </div>
      </div>
      <div class="benefits-cert-container">
        <div class="row row-nomargin">
          <div class="col-md-12 col-xs-12 col-nopadding">
            <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
            <div class="col-md-8 col-sm-8 col-xs-12 col-nopadding lista-benefits-cert-container ">
              <p class="parrafojustify">{!!trans('contenido.parrafo1_origen')!!}</p>
              <ul class="list-unstyled lista-benefits-cert">
                <li>
                  <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
                  <span>{!!trans('contenido.item1_origen')!!}</span>
                </li>
                <li>
                  <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
                  <span>{!!trans('contenido.item2_origen')!!}</span>
                </li>
                <li>
                  <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
                  <span>{!!trans('contenido.item3_origen')!!}</span>
                </li>
              </ul>
            </div>
            <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
          </div>
        </div>
        <div class="row row-nomargin row-certificaciones">
          <div class="col-md-12 col-xs-12 col-nopadding">
            <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
            <div class="col-md-8 col-sm-8 col-xs-12 col-nopadding lista-benefits-cert-container ">
              @if(Auth::check())
                <p>{!!trans('contenido.beneficios_adicionales_socios')!!}</p>
              @else
                <p>{!!trans('contenido.beneficios_adicionales_origen')!!}</p>
              @endif

              <ul class="list-unstyled lista-benefits-cert">
                <li>
                  <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
                  <span>{!!trans('contenido.b_a_item1')!!}</span>
                </li>
                <li>
                  <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
                  <span>{!!trans('contenido.b_a_item2')!!}</span>
                </li>
                <li>
                  <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
                  @if(Auth::check())
                      <span>{!!trans('contenido.b_a_item3_socios')!!}</span>
                  @else
                      <span>{!!trans('contenido.b_a_item3')!!}</span>
                  @endif
                </li>
                @if($ruta=='')
                <li>
                  <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
                  @if(Auth::check())
                      <span>{!!trans('contenido.b_a_item4_socios')!!}</span>
                  @else
                      <span>{!!trans('contenido.b_a_item4')!!}</span>
                  @endif
                </li>
                @endif
              </ul>
            </div>
            <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
          </div>
        </div>
        <div class="row row-nomargin row-certificaciones">
          <div class="col-md-12 col-xs-12 col-nopadding">
            <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
            <div class="col-md-8 col-sm-8 col-xs-12 col-nopadding lista-benefits-cert-container ">
                <p>{!!trans('contenido.manuales_titulo')!!}</p>

              <ul class="list-unstyled lista-benefits-cert">
                <li>
                  <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
                  <a class="link-servicio" href="http://www.comexperu.org.pe/media/files/origen/Manual_Origen.pdf" target="_blank">
                    {!!trans('contenido.titulo_certificacion')!!}.
                  </a>
                </li>
                <li>
                  <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
                  <a  class="link-servicio" href="http://www.comexperu.org.pe/media/files/origen/declaracion_jurada.pdf" target="_blank">
                    {!!trans('contenido.item2_origen')!!}
                  </a>
                </li>
              </ul>
            </div>
            <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
          </div>
        </div>
        <div class="row row-nomargin row-certificaciones">
          <div class="col-md-12 col-xs-12 col-nopadding">
            <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
            <div class="col-md-8 col-sm-8 col-xs-12 col-nopadding">
              <p>{!!trans('contenido.contacto_origen')!!}: <span class="red">origen@comexperu.org.pe</span> / {!!trans('contenido.origen_telefono')!!}: <span span class="red">(511) 625 7700 {!!trans('contenido.anexo')!!} 234</span><br><br>
                {!!trans('contenido.derecho_tramite')!!}
              </p>
              <a class="red" target="_blank" href="http://busquedas.elperuano.pe/normaslegales/delegan-en-la-sociedad-de-comercio-exterior-del-peru-comex-resolucion-ministerial-n-240-2017-mincetur-1539593-1/">{!!trans('contenido.resolucion_origen')!!}</a>
              <p>(*) {!!trans('contenido.costo_adicional')!!}</p>
            </div>
            <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
          </div>
        </div>

      </div>
    </div>
    <div class="hidden-xs">
    @include('front.servicios.nuestrosservicios')
    </div>
  </div>
@endsection
