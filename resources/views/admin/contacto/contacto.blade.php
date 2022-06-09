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
              <h1 class="titulo-contenido">Contacto</h1>
            </div>
          </div>
          {!! Form::open(['url' => '/admin/contactos', 'method' => 'GET']) !!}
          <div class= "row panel-search">
            <div class="col-lg-6 col-xs-3 col-md-4 col-sm-12">
            </div>
          <div class="col-lg-6 col-xs-12 col-md-8 col-sm-12" style="text-align: center">
            <div class="col-xs-8">
              {!! Form::text('filtro_contactos', $request->input('filtro_contactos'),['class' => 'form-control filtro_contactos','placeholder'=> 'Nombre...','id'=>'filtro_contactos'])!!}
            </div>
            <button id="search_contactos" class="btn-nuevo" type="submit">Buscar</button>
            <a class="btn-nuevo" onclick="clear_input()">Limpiar</a>
          </div>
        </div>

          <div class="portlet-body">

            <!-- <div id="double-scroll" style="width: 100%"> -->
              <div class="pagination-box" align="center" style="width: 100%">
                {{$contactos->appends(['filtro_contactos'=>$request->input('filtro_contactos')])->links()}}
              </div>

              <div class="" style="width: 100%">
                <div class="div2">

                  <table class="table table-hover table-bordered" id="inscritos" >
                    <thead>
                        <tr>
                            <th class="titulo-tabla">NOMBRE</th>
                            <th class="titulo-tabla"> EMPRESA</th>
                            <th class="titulo-tabla">EMAIL</th>
                            <th class="titulo-tabla">TELEFONO</th>
                            <th class="titulo-tabla">MENSAJE</th>
                            <th class="titulo-tabla">AUTORIZA</th>
                            <th class="titulo-tabla">FECHA</th>

                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($contactos as $key)
                        <tr>
                            <td>{!! $key->name !!}</td>
                            <td>{!! $key->company !!}</td>
                            <td>{!! $key->email !!}</td>
                            <td>{!! $key->phone !!}</td>
                            <td>{!! $key->message !!}</td>
                            @if($key->authorize==1)
                            <td>Sí</td>
                            @else
                            <td>No</td>
                            @endif
                            <td>{!! $key->created_at !!}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  </div>
                  <div class="pagination-box" align="center" style="width: 100%">
                    {{$contactos->appends(['filtro_contactos'=>$request->input('filtro_contactos')])->links()}}
                  </div>
                    {!!Form::close()!!}

                <!-- </div> -->
            </div>
        </div>
    </div>
</div>
<script>
function clear_input(){
$('.filtro_contactos').val('');
$('#search_contactos').click();
}
 // $('#double-scroll').doubleScroll();
</script>
@endsection
