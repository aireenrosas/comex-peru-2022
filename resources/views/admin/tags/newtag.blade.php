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
                <h1 class="titulo-editar">Nuevo Tag</h1>
            </div>
          </div>
          {!! Form::open(['url' => '/admin/tags', 'method' => 'POST'])!!}
          <div class="portlet-body col-md-6">
              <div class="section-spanish">
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Nombre (ES)</label>
                  {!! Form::text('name_es',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escribe el nombre del tag','required'])!!}
                </div>
              </div>
              <div class="section-english">
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Nombre (EN)</label>
                  {!! Form::text('name_en',null ,['class' => 'form-control input-admin', 'placeholder' => 'Escribe el nombre del tag','required'])!!}
                </div>
              </div>
              <div class="actions col-md-12" style="padding:20px 15px;">
                <button class="btn btn-guardar" type="submit">Guardar</button>
                <a class="btn btn-cancelar" href="{{url('/admin/tags')}}">Cancelar</a>
            </div>
          </div>
          {!! Form::close() !!}
      </div>
  </div>
</div>
@endsection
