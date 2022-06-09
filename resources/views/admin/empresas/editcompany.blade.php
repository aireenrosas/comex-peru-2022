@extends('app.appadmin')
@section('style')
<link href="<?php echo URL::asset('css/home.css'); ?>" rel="stylesheet" type="text/css" />

@endsection
@section('content')

<div class="row">
  <div class="col-md-12 cont-tabla">
      <div class="portlet light ">
          <div class="portlet-title tabbable-line">
            <div class="caption caption-md">
                <h1 class="titulo-editar">Editar Empresa</h1>
            </div>
          </div>
          {!! Form::open(['url' => '/admin/empresas/'.$empresa->id, 'method' => 'PATCH'])!!}
          <div class="portlet-body">
              <div class="col-md-6">
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">RUC</label>
                  {!! Form::text('RUC',$empresa->RUC ,['class' => 'form-control input-admin', 'placeholder' => 'Escribe el RUC con el que se iniciará sesión'])!!}
                  {!! $errors->first('RUC', '<span class="help-block alert-danger">:message</span>') !!}
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Nombre</label>
                  {!! Form::text('name',$empresa->name ,['class' => 'form-control input-admin', 'placeholder' => 'Escribe el nombre del usuario'])!!}
                  {!! $errors->first('name', '<span class="help-block alert-danger">:message</span>') !!}
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Tipo</label>
                  {!! Form::select('type',$tipos, $empresa->type ,['class' => 'form-control input-admin', 'placeholder' => 'Selecciona'])!!}
                  {!! $errors->first('type', '<span class="help-block alert-danger">:message</span>') !!}
                </div>


              <div class="actions col-md-12" style="padding:20px 15px;">
                <button class="btn btn-guardar" type="submit">Guardar</button>
                <a class="btn btn-cancelar" href="{{url('/admin/empresas')}}">Cancelar</a>
            </div>
          </div>
          {!! Form::close() !!}
      </div>
  </div>
</div>
@endsection
