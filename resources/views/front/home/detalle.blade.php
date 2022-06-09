
        <div class="col-md-8 col-sm-12 col-xs-12 nopadding">
          <div class="col-md-1 onlyrojo hidden-xs hidden-sm">

          </div>
          <div class="col-md-11 rojo">
            <span class="detalle-titulo">{!!trans('contenido.recientes')!!}</span>
          </div>
          @foreach ($articulos as $key)
            <div class="blanco">
              <div class="col-md-12 col-sm-12 col-xs-12 detalle-cuerpo">
                <div class="col-md-1 hidden-xs"></div>
                <div class="col-md-7 col-sm-8 col-xs-7 leftcero">
                      <ul class="lista-tag">
                        @foreach ($key['tags'] as $tag)
                          <li class="lista-tag-li">{{$tag}}</li>
                        @endforeach
                      </ul>
                      <a href="{{$key['link']}}" target="_blank">
                        <p class="detalle-titulo-art">{{$key['title']}}</p>
                      </a>
                      <p class="contenido-titulo-art">{{$key['content']}}</p>
                      <div class="padding20">
                        {{-- <span class="texto-detalle">{!!trans('contenido.por')!!} </span>
                        <strong><span class="texto-detalle">{{$key['creado_por']}}</span></strong>
                        <span class="texto-detalle"> / </span><span class="fecha-rojo">{{$key['fecha']}}</span><br> --}}
                        @if($key['creado_por']!="" && $key['creado_por']!=null)
                        <span class="texto-detalle">{!!trans('contenido.por')!!} </span>
                        <strong><span class="texto-detalle">{{$key['creado_por']}}</span></strong>
                        <span class="texto-detalle"> / </span>
                        @endif
                        <span class="fecha-black">{{$key['fecha']}}</span>

                        <span class="texto-detalle"> / </span><a href="{{$key['linkpublic']}}"><span class="publi-rojo">{{$key['publications']}}  {{$key['edition']}}</span></a>
                        <span class="text12">{{$key['columna']}}</span>
                        <br>

                      </div>
                        <a class="home-button" href="{{$key['link']}}">{!!trans('contenido.leer_mas')!!}</a>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-5 col-nopadding">
                  <a href="{{$key['link']}}" target="_blank">
                    @if($key['image']!="")
                    <img class="detalle-img img-responsive" src="{{$key['image']}}"  alt="Artículo Imagen">
                    @endif
                  </a>
                </div>
            </div>
          </div>
          @endforeach


  <!--END repeticion del detalle-->
    <div class="col-md-offset-1 col-md-11 col-xs-12 detalle-border hidden-xs">
      <a class="detalle-titulo-art" href="{{ url($ruta."/articulos") }}">{!!trans('contenido.ver_articulos_recientes')!!}</a>
    </div>
    </div>
        <div class="col-md-4 col-sm-12 hidden-xs nopadding">
          <div class="gris">
            <span class="detalle-titulo">{!!trans('contenido.recomendados')!!}</span>
          </div>
          @foreach ($articulos_recomendados as $key)
          <div class="blanco">
            <div class="col-md-10 col-sm-12 col-xs-12 detalle-cuerpo2">
              <div class="col-md-12 col-sm-4">
                <a href="{{$key['link']}}">
                  @if($key['image']!="")
                  <img class="detalle-img2 img-responsive padding20" src="{{$key['image']}}" alt="Artículo Imagen">
                  @endif
                </a>
              </div>
              <div class="col-md-12 col-sm-8">
                    <ul class="lista-tag">
                      @foreach ($key['tags'] as $tag)
                        <li class="lista-tag-li">{{$tag}}</li>
                      @endforeach
                    </ul>
                    <a href="{{$key['link']}}">
                      <p class="detalle-titulo-art">{{$key['title']}}</p>
                    </a>
                    <p class="contenido-titulo-art2">{{$key['content']}}</p>
                    <div class="text12">
                      @if($key['creado_por'] && $key['creado_por']!='')
                      <span class="texto-detalle">{!!trans('contenido.por')!!} </span>
                      <strong><span class="texto-detalle">{{$key['creado_por']}}</span></strong>
                      <span class="texto-detalle"> / </span>
                      @endif
                      <span class="fecha-black">{{$key['fecha']}}</span>
                      <span class="texto-detalle"> / </span><a href="{{$key['linkpublic']}}"><span class="publi-rojo">{{$key['publications']}}  {{$key['edition']}}</span></a>
                      <span class="text12">{{$key['columna']}}</span><br>
                    </div>
                    <a class="home-button" href="{{$key['link']}}">{!!trans('contenido.leer_mas')!!}</a>
              </div>
          </div>
        </div>
        @endforeach
        </div>
        <div class="col-md-12 col-sm-12 hidden-xs nopadding">
          <a href="{{ url($ruta."/servicioabtc") }}"><img src="{!!url('/images/publicidad-articulos.png')!!}" class="image-responsive" alt="Servicios de Tarjeta ABTC"/></a>
        </div>

        <script type="text/javascript">
        $(".home-button[href*='.pdf']").each(function() {
              console.log("this",this);
              $(this).attr('target','_blank');
          });
        </script>
