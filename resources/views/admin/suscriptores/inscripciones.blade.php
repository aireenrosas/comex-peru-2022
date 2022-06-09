@extends('app.appadmin')
@section('style')
<link href="<?php echo URL::asset('css/home.css'); ?>" rel="stylesheet" type="text/css" />
@endsection
@section('script')
@endsection
@section('content')

<div class="row">
  <div class="col-md-12 cont-tabla">
      <div class="portlet light ">
          <div class="portlet-title tabbable-line">
            <div class="caption caption-md">
              <h1 class="titulo-contenido">Inscripciones</h1>
            </div>
          </div>
          {!! Form::open(['url' => '/admin/inscripciones', 'method' => 'GET']) !!}
          <div class= "row panel-search">
            <div class="col-lg-6 col-xs-3 col-md-4 col-sm-12">
            </div>
          <div class="col-lg-6 col-xs-12 col-md-8 col-sm-12" style="text-align: center">
            <div class="col-xs-8">
              {!! Form::text('filtro_inscripciones', $request->input('filtro_inscripciones'),['class' => 'form-control filtro_inscripciones','placeholder'=> 'Seminario...','id'=>'filtro_inscripciones'])!!}
            </div>
            <button id="search_inscripciones" class="btn btn-nuevo" type="submit">Buscar</button>
            <a class="btn btn-nuevo" onclick="clear_input()">Limpiar</a>
          </div>
        </div>

          <div class="portlet-body">

            <!-- <div id="double-scroll" style="width: 100%"> -->
              <div class="pagination-box" align="center" style="width: 100%">
                {{$inscripciones->appends(['filtro_inscripciones'=>$request->input('filtro_inscripciones')])->links()}}
              </div>
              <div class="wrapper1">
              	<div class="div1"></div>
              </div>
              <div class="wrapper2" style="width: 100%">
                <div class="div2">

                  <table class="table table-hover table-bordered" id="inscritos" >
                    <thead>
                        <tr>
                            <th class="titulo-tabla">ID</th>
                            <th class="titulo-tabla">EVENTO</th>
                            <th class="titulo-tabla"> EMPRESA</th>
                            <th class="titulo-tabla">RUC</th>
                            <th class="titulo-tabla">SECTOR</th>
                            <th class="titulo-tabla">DIRECCION</th>
                            <th class="titulo-tabla">EMAIL</th>
                            <th class="titulo-tabla">TELEFONO</th>
                            <th class="titulo-tabla">FAX</th>
                            <th class="titulo-tabla">NOMBRE</th>
                            <th class="titulo-tabla">APELLIDOS</th>
                            <th class="titulo-tabla">TIPO DOC.</th>
                            <th class="titulo-tabla">DOCUMENTO</th>
                            <th class="titulo-tabla">CARGO</th>
                            <th class="titulo-tabla">ESTADO</th>
                            <th class="titulo-tabla">AUTORIZA</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($inscripciones as $key)
                        <tr>
                            <td>{!! $key->id !!}</td>
                            <td>{!! $key->evento !!}</td>
                            <td>{!! $key->company !!}</td>
                            <td>{!! $key->RUC !!}</td>
                            <td>{!! $key->sector !!}</td>
                            <td>{!! $key->address !!}</td>
                            <td>{!! $key->email !!}</td>
                            <td>{!! $key->phone !!}</td>
                            <td>{!! $key->fax !!}</td>
                            <td>{!! $key->name !!}</td>
                            <td>{!! $key->lastname !!}</td>
                            <td>{!! $key->document_type !!}</td>
                            <td>{!! $key->document !!}</td>
                            <td>{!! $key->position !!}</td>
                            @if($key->state==1)
                            <td>Habilitado</td>
                            @else <td>Inhabilitado</td>
                            @endif
                            @if($key->authorize==1)
                            <td>Sí</td>
                            @else
                            <td>No</td>
                            @endif

                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  </div>
                <!-- </div> -->
            </div>
            <div class="pagination-box" align="center" style="width: 100%">
              {{$inscripciones->appends(['filtro_inscripciones'=>$request->input('filtro_inscripciones')])->links()}}
            </div>
        </div>
        {!!Form::close()!!}
    </div>
</div>
<script>
function clear_input(){
$('.filtro_inscripciones').val('');
$('#search_inscripciones').click();
}
 // $('#double-scroll').doubleScroll();
</script>
<script type="text/javascript">
$(function () {
  $('.wrapper1').on('scroll', function (e) {
      $('.wrapper2').scrollLeft($('.wrapper1').scrollLeft());
  });
  $('.wrapper2').on('scroll', function (e) {
      $('.wrapper1').scrollLeft($('.wrapper2').scrollLeft());
  });
});
$(window).on('load', function (e) {
  $('.div1').width($('table').width());
  $('.div2').width($('table').width());
});
</script>
@endsection
