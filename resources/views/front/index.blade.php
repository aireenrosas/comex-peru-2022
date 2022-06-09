@extends('app.app')
<?php
$ogdescription = 'ComexPerú es el gremio privado que agrupa a las principales empresas vinculadas al Comercio Exterior en el Perú.';
$ogimage = '';
$ogtitle = 'COMEX - Sociedad de Comercio Exterior del Perú - Inicio';
$ogurl = url('/');
?>
@section('style')
         <link href="<?php echo URL::asset('css/home.css'); ?>" rel="stylesheet" type="text/css" />
         <link href="<?php echo URL::asset('css/home-hero.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
@endsection

@section('script')
  <script src="<?php echo URL::asset('js/slider-columna-home.js'); ?>" type="text/javascript"></script>
@endsection

@section('content')
  @include('front.home.hero')
  @if(Auth::check())
    @include('front.home.columnaslogged')
  @else
    @include('front.home.columnas')
  @endif

  @include('front.home.filtro')

  @include('front.home.detalle')

  <!-- div class="modal fade" tabindex="-1" role="dialog" id="popup" data-show="true">
    <div class="modal-dialog" role="document" style="height: auto">
      <div class="modal-content">
        <div class="modal-body" style="padding:0px">
          <a href="https://www.comexperu.org.pe/foro" target="_blank">
            <img src="https://www.comexperu.org.pe/upload/seminars/foro/seminario_18112019/seminario-pacientes.jpg" alt="Poniendo al paciente en el centro del debate" title="Poniendo al paciente en el centro del debate" style="width:100%">
          </a>
        </div>
      </div>
    </div>
  </div -->

  <!-- div class="modal fade" tabindex="-1" role="dialog" id="popup" data-show="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body" style="padding:0px">
          <a href="https://cumbrepyme.org/" target="_blank">
            <img src="https://www.comexperu.org.pe/images/cumbre-pyme-2021.jpg" alt="Cumbre Pyme 2021" title="Cumbre Pyme 2021" style="width:100%">          
            </a>
        </div>
      </div>
    </div>
  </div -->

  <!-- script type="text/javascript">
    $(window).on('load',function(){
        $('#popup').modal('show');
    });
  </script -->

<!-- script type="text/javascript">
    $( function(){
        $('#popup').modal();
    } )
</script -->

  <script type="text/javascript">
    var ruta = '{{$ruta}}';
  </script>
  <script src="<?php echo URL::asset('js/index.js'); ?>" type="text/javascript"></script>

@endsection
