<div class="hero row">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner" role="listbox">
        @foreach ($sliders as $key)
        <div class="item" style="background: url({{url('/upload/sliders/'.$key->image)}}) no-repeat center center; background-size: cover;">
          <div class="container">
            <div class="carousel-caption">
              <div class="col-md-12 col-nopadding">
                <div class="col-md-1 hidden-sm"></div>
                <div class="col-md-10 col-sm-10 col-xs-12 col-nopadding">
                  @if($key->title!="")
                  <?php $titulo = strtoupper( $key->title );?>
                  <h1 class="hidden-xs">{{$titulo}}</h1>
                  @endif
                  @if($key->text !="")
                  <p class=" hidden-xs por-ComexPeru">{{ $key->text}}</p>
                  @endif
                  @if($key->url !="")
                  <p class="btn-LeerMas-container top-45">
                    <a class="home-button" href="{{ $key->url}} " role="button" target="_blank">

                      {{ $key->button_text }}
                    </a>
                  </p>
                  @endif
                </div>
                <div class="col-md-1 hidden-sm"></div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <a class="right carousel-control" href=".carousel" role="button" data-slide="next"><span class="glyphicon glyphicon glyphicon-menu-right" aria-hidden="true"></span><span class="sr-only">Next</span></a>
    </div>
</div>

<div id="Carousel1" class="carousel slide" data-ride="carousel">
    <div class="titulo-container-responsive hidden-lg hidden-md hidden-sm">
      <div class="carousel-inner">
        @foreach ($sliders as $key)
        <div class="item">
            @if($key->title!="")
            <?php $titulo = strtoupper( $key->title );?>
              <h3>{{$titulo}}</h3>
            @endif
            @if($key->text!="")
              <p>{!!trans('contenido.por')!!} {{ $key->text}}</p>
            @endif
        </div>
        @endforeach
    </div>
  </div>
</div>
