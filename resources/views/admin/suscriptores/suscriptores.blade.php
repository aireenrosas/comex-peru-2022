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
              <h1 class="titulo-contenido">Suscriptores</h1>
            </div>
          </div>
          {!! Form::open(['url' => '/admin/suscriptores', 'method' => 'GET']) !!}
          <div class= "row panel-search">
            <div class="col-lg-6 col-xs-3 col-md-4 col-sm-12">

            </div>
          <div class="col-lg-6 col-xs-12 col-md-8 col-sm-12" style="text-align: center">
            <div class="col-xs-8">
              {!! Form::text('filtro_sus', $request->input('filtro_sus'),['class' => 'form-control filtro_sus','placeholder'=> 'Email...','id'=>'filtro_sus'])!!}
            </div>
            <button id="search_sus" class="btn btn-nuevo" type="submit">Buscar</button>
            <a class="btn btn-nuevo" onclick="clear_input()">Limpiar</a>
          </div>
        </div>
          <div class="portlet-body">
              <div class="table-scrollable">
                <div class="pagination-box" align="center" style="width: 100%">
                  {{$suscriptores->appends(['filtro_sus'=>$request->input('filtro_sus')])->links()}}
                </div>
                  <table class="table table-hover table-bordered" id="suscriptores">
                    <thead>
                        <tr>
                            <th class="titulo-tabla"> EMAIL</th>
                            <th class="titulo-tabla"> FECHA SUSCRIPCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($suscriptores as $key)
                         <tr>
                             <td>{!! $key->email !!}</td>
                             <td>{!! $key->created_at !!}</td>
                         </tr>
                       @endforeach

                    </tbody>
                  </table>
                  <div class="pagination-box" align="center" style="width: 100%">
                    {{$suscriptores->appends(['filtro_sus'=>$request->input('filtro_sus')])->links()}}
                  </div>
                    {!!Form::close()!!}
                </div>
          </div>
      </div>
    </div>
</div>
<script>
function clear_input(){
$('.filtro_sus').val('');
$('#search_sus').click();
}
</script>
@endsection
