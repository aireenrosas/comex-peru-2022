@extends('app.app')
<?php
if(count($articulo)>0){
  if($articulo['abstract'] && $articulo['abstract']!=""){
    $ogdescription = Funciones::myTruncate(strip_tags($articulo['abstract']), 255, ' ', '...');
  }
  else{
    $ogdescription = Funciones::myTruncate(strip_tags($articulo['content']), 255, ' ', '...');
  }

$ogimage = $articulo['image'];
$ogtitle = $articulo['title'];
$ogurl = url($ruta.'/articulo/'.$articulo['slug']);
}else{
  $ogdescription = 'ComexPerú es el gremio privado que agrupa a las principales empresas vinculadas al Comercio Exterior en el Perú.';
  $ogimage = '';
  $ogtitle = 'COMEX - Sociedad de Comercio Exterior del Perú - Inicio';
  $ogurl = url('/');
}
?>
@section('style')
  <link href="<?php echo URL::asset('css/home.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo URL::asset('css/home-hero.css'); ?>" rel="stylesheet" type="text/css" />
@endsection
@section('script')
<script src="<?php echo URL::asset('js/media-queries.js'); ?>" type="text/javascript"></script>
@endsection
@section('content')
  <div class="container-comex">
    <div class="col-md-12 col-xs-12 leftcero rightcero">
      <div class="col-md-8 col-xs-12 cont-centro leftcero rightcero ancho">
        <div class="contbuscadorart filtro-contenido filtro-contenido-detalle-art hidden" id="oculto">
          <div class="row row-nomargin hidden-xs">
            <div class="cont-cerrar">
              <a id="btncerrar"><img src="{!!url('/images/close.png')!!}" class="image-responsive" alt=""/></a>
            </div>
          </div>
          <div class="row row-nomargin" id="search-cont">
            <div class="col-md-12 col-xs-12 col-nopadding">
              <div class="home-col-search">
                  <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
                  <div class="col-md-8 col-sm-8 col-xs-12 col-nopadding">
                    <div class="input-group col-md-12 col-xs-12">
                      <input type="text" class="form-control input-search" placeholder="{!!trans('contenido.placeholder_filtro')!!}">
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
              </div>
            </div>
          </div>

          <div class="row row-nomargin">
            <div class="col-md-12 col-xs-12 nopadding contenedorTag" id="contenedorTag">
              <ul class="filtros">

              </ul>
            </div>
          </div>

          <div class="row row-nomargin">
            <div class="hidden-lg hidden-md hidden-sm col-xs-12 col-nopadding text12-responsive">
              <!-- BUSCAR POR TAGS Y/O REVISTAS -->
              {!!trans('contenido.buscar_tags')!!}
            </div>
          </div>
          <div class="row row-nomargin">
            <div class="col-md-12 col-xs-12 nopadding">
              <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
              <div class="col-md-10 col-sm-10 col-xs-12 nopadding">
                <div class="select-responsive dropdown" role="group">
                  <button type="button" class="btn dropdown-toggle btn-select-tags hidden-lg hidden-md hidden-sm lista-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!-- SELECCIONAR TAGS -->
                    {!!trans('contenido.seleccionar_tags')!!}
                    <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                  </button>
                  <ul class="filtro-lista">
                    @foreach ($tags as $key)
                      <li class="filtro-li {{$key['active']}}" data-id="{{$key['id']}}">
                        <div class="filtro-tag-cont">
                              <span class="tag-close">X</span><p class="tag-paragraph">{{$key['name']}}</p>
                        </div>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
              <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
            </div>
          </div>
          <hr class="home-division hidden-xs">
          <div class="row row-nomargin row-filtro-revista">
            <div class="col-md-12 col-xs-12 nopadding">
              <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
              <div class=" col-md-1 col-sm-2 hidden-xs home-col-ver-filtro" >
                <span class="home-ver">{!!trans('contenido.ver_en')!!}</span>
              </div>
              <div class="col-md-9 col-sm-8 col-xs-12 nopadding">
                <div class="select-responsive dropdown" role="group">
                  <button type="button" class="btn dropdown-toggle btn-select-tags hidden-lg hidden-md hidden-sm filtro-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!-- SELECCIONAR REVISTAS -->
                    {!!trans('contenido.seleccionar_revistas')!!}
                    <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                  </button>
                  <ul class="lista-ver">
                    @foreach ($categories as $key)
                      <li class="lista-ve-li {{$key['active']}}" data-id="{{$key['id']}}">
                        <div class="filtro-tag-cont">
                              <span class="tag-close">X</span><p class="tag-paragraph">{{$key['name']}}</p>
                        </div>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
              <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
            </div>
          </div>
          <hr class="home-division hidden-xs">
          <div class="row home-row-button row-nomargin">
            <div class="col-md-12 col-nopadding">
              <button class="home-button-buscar"><i class="fa fa-search fa-md ico-buscador" aria-hidden="true" href="#"></i> {!!trans('contenido.buscar')!!}</button>
            </div>
          </div>
        </div>
        <div class="col-md-12 tab-art-det" id="detalle">
          <div class="col-md-2 hidden-sm"></div>
          <div class="col-md-7 col-xs-12  col-nopadding">
            <p class="msj-filtro">{!!trans('contenido.mensaje_filtro1')!!}</p>
            <p class="msj-filtro">{!!trans('contenido.mensaje_filtro2')!!}</p>
          </div>
          <div class="col-md-3 col-xs-12 cont-btnbusdet leftcero rightcero margenbtn respbtnmostrar" align="right">
            <a class="btn-mostrar" href="#" id="btnbuscardet"><i class="fa fa-search fa-lg ico-lupa" aria-hidden="true"></i>{!!trans('contenido.buscar')!!}</a>
          </div>
        </div>
        @if(count($articulo)>0)
        <div class="articulo-detalle col-md-12 col-sm-12 col-xs-12">
          <div class="col-md-2 hidden-sm col-nopadding"></div>
          <div class="col-md-10 col-xs-12 col-nopadding cont-contenido-total">
            <div class="art-title-container">
              <p class="titulo-plomo60 unir">{{$articulo['title']}} </p>
              <p class="art-txt16-plomo">
                @if($articulo['creado_por'] && $articulo['creado_por']!='')
                {!!trans('contenido.por')!!} <span class="art-txt16-rojo">{{$articulo['creado_por']}}</span> /
                @endif
                {!!trans('contenido.publicado_en')!!} <span class="art-txt16-rojo">{{$articulo['fecha']}}</span>
                /<a href="{{$articulo['url_publicacion']}}"><span class="art-txt16-plomo"><b> {{$articulo['publication']}}  {{$articulo['edition']}}<b></span></a>
                  @if($articulo['columna']!="")
                  - <span class="art-txt16-plomo">{{$articulo['columna']}}</span>
                  @endif
              </p>
            </div>
            <div class="cont-fotarticulo">
              <div class="foto-articulo">
                @if($articulo['image']!='')
                <img class="image-responsive img-responsive" alt="" src= {{$articulo['image']}} />
                @endif
                <p class="fuente">
                  @if($articulo['leyend'] && $articulo['leyend']!='')
                  {{$articulo['leyend']}}/
                  @endif

                  @if($articulo['source'] && $articulo['source']!='')
                  {{$articulo['source']}}
                  @endif
                </p>
              </div>
            </div>
            <div class="cont-parrafo-articulo">
              <!-- div class="txt-parrafo-art hidden-lg hidden-md hidden-sm contenidoinicios">{!!Funciones::myTruncate(($articulo['content']), 150, ' ', '...')!!}</div -->
              <div class="txt-parrafo-art contenidocompleto">{!!$articulo['content']!!}</div>
              <!-- div class="read-full-art leertodo hidden-lg hidden-md hidden-sm">
                <a href="javascript:;" class="btn-full-Art">{!!trans('contenido.leer_articulo')!!}</a>
              </div -->
            </div>
          </div>
        </div>
        <div class="cont-descargar-articulo col-md-12 col-sm-12 col-xs-12">
          <div class="col-md-1 hidden-sm col-nopadding"></div>
            @if($articulo['file']!="")
            <div class="col-sm-4 col-xs-12 col-nopadding cont-descargar-items text-center">
            {{-- <p class="txt-descarga">{!!trans('contenido.descarga')!!}</p> --}}
            <a class="btn-buscar-det" href= {{$articulo['file']}} target="_blank"><i class="fa fa-download fa-lg ico-lupa" aria-hidden="true"></i>{!!trans('contenido.descarga1')!!}</a>
            </div>
            <div class="col-sm-4 col-xs-12 col-nopadding cont-descargar-items text-center">
              <a class="btn-rojo btn-imprimir" href={{ $articulo['url_publicacion']}} ><i class="fa fa-reply" aria-hidden="true" target="_blank"></i> {!!trans('contenido.atras')!!}</a>

            </div>
            <div class="col-sm-2 col-xs-12 col-nopadding cont-descargar-items imprimir noprint text-center">
              <a class="btn-rojo btn-imprimir" onclick="printPage()"><i class="fa fa-print" aria-hidden="true" target="_blank"></i> {!!trans('contenido.print')!!}</a>
            </div>
            @else
            <div class="col-sm-5 col-xs-12 col-nopadding cont-descargar-items text-center">
                <a class="btn-rojo btn-imprimir" href={{ $articulo['url_publicacion']}}><i class="fa fa-reply" aria-hidden="true" target="_blank"></i> {!!trans('contenido.atras')!!}</a>
            </div>
            <div class="col-sm-5 col-xs-12 col-nopadding cont-descargar-items imprimir noprint text-center">
              <a class="btn-rojo btn-imprimir" onclick="printPage()"><i class="fa fa-print" aria-hidden="true" target="_blank"></i> {!!trans('contenido.print')!!}</a>
            </div>
            @endif

            <div class="col-md-1 hidden-sm col-nopadding"></div>




        </div>
        <div class="cont-datos">
          <!-- inicio redes -->
          <div class="cont-redes col-md-12 col-sm-12 col-xs-12">
            <div class="col-md-2 hidden-sm col-nopadding"></div>
            <div class="col-md-10 col-xs-12 col-nopadding">
              <a class="btn-face" href="http://www.facebook.com/sharer/sharer.php?u=<?php $url_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; echo $url_actual; ?>&amp;p[title]={{$articulo['title']}}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-facebook fa-lg ico-lupa" aria-hidden="true"></i>POST</a>
              <a class="btn-twit" href="http://twitter.com/share?text="="{{$articulo['title']}}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-twitter fa-lg ico-lupa" aria-hidden="true"></i>TWEET</a>
              <a class="btn-compartir" href="https://www.linkedin.com/shareArticle?mini=true&url={{$url_actual}}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-linkedin fa-lg ico-lupa" aria-hidden="true"></i>COMPARTIR</a>

            </div>
          </div>
          <!-- fin redes -->
          <div class="col-md-12 col-xs-12 cont-empresa">
            <div class="col-md-2 hidden-sm col-nopadding"></div>
            <div class="col-md-2 col-xs-2 col-nopadding">
              <div class="logo-empresa">
                <img src="{!!url('/images/combined-shape.png')!!}" class="img-responsive" alt="logo icono"/>
              </div>
            </div>
            <div class="col-md-8 col-xs-10 col-nopadding texto-empresa">
              <p class="titulo-blanco20">ComexPerú</p>
              <p class="parrafo-empresa">{!!trans('contenido.detalle_articulo_textoimage')!!}</p>
              <p class="url-empresa">comexperu.org.pe</p>
            </div>
          </div>
        </div>
        @else
        <div class="articulo-detalle">
          <p class="txt-descarga">{!!trans('contenido.mensaje_articulo')!!}</p>
        </div>
        @endif
      </div>
      <div class="col-md-4 col-sm-12 col-xs-12 leftcero rightcero ancho div-articulosrecomendados">
        <div class="rojo">
          <p class="detalle-titulo">{!!trans('contenido.recomendados')!!}</p>
        </div>
        <div class="cont-imgarticulo">

          @foreach ($articulos_relacionados as $key)

            <div class="art-rel-container">
              <div class="row row-nomargin">
                <div class="contenedor-articulo-rel">
                  <div class="col-md-12 col-xs-5 col-nopadding img-otrosart-cont">
                    <div class="img-otrosart">
                      <a href="{{$key['link']}}"><img src= {{$key['image']}} class="image-responsive img-responsive" alt=""/></a>
                    </div>
                  </div>
                  <div class="col-md-12 cont-tab-der">
                    <ul class="lista-tag" >
                      @foreach ($key['tags'] as $tag)
                        <li class="lista-tag-li">{{$tag}}</li>
                      @endforeach
                    </ul>
                  </div>
                  <div class="col-md-12 col-xs-7 col-nopadding textoart-cont">
                    <div class="textoart">
                      <a href="{{$key['link']}}"><p class="tituloder-plomo20">{{$key['title']}}</p></a>
                      <p class="textoder">{{$key['content']}}</p>
                      <div class="text12">
                        @if($key['creado_por'] && $key['creado_por']!='')
                        <span class="texto-detalle">{!!trans('contenido.por')!!} </span>
                        <strong><span class="texto-detalle">{{$key['creado_por']}}</span></strong>
                        <span class="texto-detalle"> / </span>
                        @endif
                        <span class="fecha-black">{{$key['fecha']}}</span>
                        <span class="texto-detalle"> / </span><a href="{{$key['linkpublic']}}"><span class="publi-rojo">{{$key['publications']}}  {{$key['edition']}}</span></a>
                        @if($key['columna']!='')
                        <span class="text12">{{$key['columna']}}</span>
                        @endif
                        <br>

                      </div>
                      <div class="cont-btnleer">
                        <a class="btn-leermas" href="{{$key['link']}}">{!!trans('contenido.mas')!!}</a>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          @endforeach
      </div>
    </div>
  </div>
  <div class="col-md-12 col-sm-12 hidden-xs nopadding">
    <a href="{{ url($ruta."/servicioabtc") }}"><img src="{!!url('/images/publicidad-articulos.png')!!}" class="image-responsive" alt="Servicios de Tarjeta ABTC"/></a>
  </div>
</div>

<script type="text/javascript">
  var ruta = '{{$ruta}}';
</script>

<script src="<?php echo URL::asset('js/detalle_articulo.js'); ?>" type="text/javascript"></script>








@endsection
