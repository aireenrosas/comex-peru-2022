@extends('app.app')
<?php
$ogdescription = 'ComexPerú es el gremio privado que agrupa a las principales empresas vinculadas al Comercio Exterior en el Perú.';
$ogimage = '';
$ogtitle = 'COMEX - Sociedad de Comercio Exterior del Perú - Inicio';
$ogurl = url('/');
?>
@section('style')
<link href="<?php echo URL::asset('css/home.css'); ?>" rel="stylesheet" type="text/css" />
@endsection
@section('script')
<script src="<?php echo URL::asset('js/articulos.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
  var idioma = '{{trim($ruta, '/')}}';
  var realizadopor = '{!!trans('contenido.por')!!}';
  var ruta = '{{$ruta}}';
  if(ruta!=''){
    ruta = ruta+'/';
  }
  var data = {};
  data._token =$('.ttoken').val();
  data.page=$('.ver_mas').attr('data-next');
  data.tags = '{{$request->input('tags')}}';
  data.categorias = '{{$request->input('categorias')}}';
  data.keyword = '{{$request->input('keyword')}}';
  data.fecha = '{{$request->input('fecha')}}';
  data.idioma = idioma;
  articulo.init('{{url('/')}}', data);
</script>
@endsection
@section('content')
  <input type="hidden" class="ttoken" name="_token" value="{{csrf_token()}}">
  <div class="container-comex">
    {{-- <div class="servicioscont"> --}}
      <!-- <div class="col-offset-2 col-xs-2">
        @include('front.home.filtro')
      </div> -->
      <div class="col-md-12 col-xs-12 filtro-contenido-articulos">
          @include('front.home.filtro')
      </div>

      <div class="col-md-12 col-xs-12 leftcero rightcero">
        <A name="ancla" id="ancla"></A>
        <div class="leftcero rightcero">
          <div class="seccion-ordenar row row-nomargin">
            <div class="fondo-ordenar col-md-12">
              <div class="col-md-2 hidden-xs"></div>
              <div class="row row-nomargin">
                <div class="col-md-7 col-xs-12 col-nopadding">
                  <div class="form-group select-ordenar">
                    <select class="selectpicker form-control ordenarFecha" data-width="fit">
                      <option value="">{!!trans('contenido.combo_1')!!}</option>
                      <option value="semana">{!!trans('contenido.combo_4')!!}</option>
                      <option value="mes">{!!trans('contenido.combo_5')!!}</option>
                      <option value="annio">{!!trans('contenido.combo_6')!!}</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="articulos-container-all">
      </div>
      <div class="row row-nomargin">
        <div class="col-md-12 col-xs-12 col-nopadding whole-cont-vermas">
          <div class="col-md-2 col-sm-1 hidden-xs"></div>
          <div class="col-md-10 col-sm-11 col-xs-12 cont-vermas">
            <!-- <p class="titulo-plomo20 left56">VER MÁS ARTÍCULOS RECIENTES</p> -->
            <!-- <input type="button" class="titulo-plomo20 left56 ver_mas" data-next='1' value="VER MÁS ARTÍCULOS RECIENTES"> -->
            <a class="titulo-plomo20 ver_mas" data-next='1'>{!!trans('contenido.ver_articulos_recientes')!!}</a>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 hidden-xs col-nopadding">
        <div class="cont-titular">
          <a href="{{ url($ruta."/servicioabtc") }}"><img src="{!!url('/images/publicidad-articulos.png')!!}" class="image-responsive" alt="Servicios de Tarjeta ABTC"/></a>
        </div>
      </div>
    {{-- </div> --}}
  </div>
  <script type="text/javascript">
  $( document ).ready(function() {
    var str = "{!!trans('contenido.ordenar_por')!!}";
    document.styleSheets[1].addRule('.filter-option:before','content: "'+str+'";');
    $('.seccion-ordenar .selectpicker').val('{{$request->input('fecha')}}');
  });
  var texto= '{!!trans("contenido.no_resultados")!!}';
  </script>
@endsection
