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
                <h1 class="titulo-editar">Nueva Publicación</h1>
            </div>
          </div>
          {!! Form::open(['url' => '/admin/publicaciones', 'method' => 'POST'])!!}
          <div class="portlet-body col-md-6">
              <div class="section-spanish">
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Nombre (ES)</label>
                  {!! Form::text('name_es',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escribe el nombre de la categoría', 'required'])!!}
                </div>
              </div>
              <div class="section-english">
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Nombre (EN)</label>
                  {!! Form::text('name_en',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escribe el nombre de la categoría', 'required'])!!}
                </div>
              </div>
              <div class="col-md-12 form-group">
                <label class="label-input-format label-titulo">Privacidad</label>
                <div class="col-md-12 col-xs-12" style="padding-left: 0px;">
                  <div class="onoffswitch">
                    <input type="checkbox" name="privacity" class="onoffswitch-checkbox" id="myonoffswitch" value="0" unchecked>
                    <label class="onoffswitch-label" for="myonoffswitch">
                      <span class="onoffswitch-inner onoffswitch-inner-privacity"></span>
                      <span class="onoffswitch-switch"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-md-12 form-group">
                <label class="label-input-format label-titulo">Tipo</label>
                <select name="type" class="form-control input-admin">
                  <option value="0">Seleccionar tipo</option>
                  @foreach ($tipos as $key)
                    <option value="{{$key->id}}">{{$key->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="actions col-md-12" style="padding:20px 15px;">
                <button class="btn btn-guardar" type="submit">Guardar</button>
                <a class="btn btn-cancelar" href="{{url('/admin/publicaciones')}}">Cancelar</a>
            </div>
          </div>
          {!! Form::close() !!}
      </div>
  </div>
</div>
<script>
$("#myonoffswitch").on( 'change', function() {
    if( $(this).is(':checked') ) {
        $(this).attr('value','1');
    } else {
      $(this).attr('value','0');
    }
});
</script>
@endsection
