@extends('app.appadmin')
@section('style')
<link href="<?php echo URL::asset('css/home.css'); ?>" rel="stylesheet" type="text/css" />

@endsection
@section('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.min.js"></script>
@endsection
@section('content')

<div class="row">
  <div class="col-md-12 cont-tabla">
      <div class="portlet light ">
          <div class="portlet-title tabbable-line">
            <div class="caption caption-md">
                <h3 class="titulo-editar">Nuevo Usuario</h3>
            </div>
          </div>
          {!! Form::open(['url' => '/admin/usuarios', 'method' => 'POST'])!!}
          <div class="portlet-body">
              <div class="col-md-6">
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Rol</label>
                  {!! Form::select('rol_id',$roles, null ,['class' => 'form-control input-admin', 'placeholder' => 'Selecciona'])!!}
                  {!! $errors->first('rol_id', '<span class="help-block alert-danger">:message</span>') !!}
                  </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Nombre</label>
                  {!! Form::text('name',old('name') ,['class' => 'form-control input-admin', 'placeholder' => 'Escribe el nombre del usuario'])!!}
                  {!! $errors->first('name', '<span class="help-block alert-danger">:message</span>') !!}
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Usuario</label>
                  {!! Form::text('login',old('autor') ,['class' => 'form-control input-admin', 'placeholder' => 'Escribe el login con el que se iniciará sesión'])!!}
                  {!! $errors->first('login', '<span class="help-block alert-danger">:message</span>') !!}
                </div>

                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">EMPRESA</label>
                  {!! Form::select('ruc',$empresas, old('ruc') ,['class' => 'form-control input-admin empresa-select', 'placeholder' => 'Selecciona'])!!}
                  {!! $errors->first('ruc', '<span class="help-block alert-danger">:message</span>') !!}
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Descripción</label>
                  {{ Form::textarea('description','', ['class' => 'form-control input-admin', 'placeholder'=>'Ingrese una descripción']) }}
                  {!! $errors->first('description', '<span class="help-block alert-danger">:message</span>') !!}
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Estado</label>

                  <div class="col-md-12 col-xs-12" style="padding-left: 0px;">
                    <div class="onoffswitch">
                      <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="onoffswitch" checked>
                      <label class="onoffswitch-label" for="onoffswitch">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                      </label>
                    </div>
                </div>
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Contraseña</label>
                  {!! Form::password('password', ['class' => 'form-control input-admin', 'type' => 'password', 'placeholder' => 'Escribe la Contraseña'])!!}
                  {!! $errors->first('password', '<span class="help-block alert-danger">:message</span>') !!}
                </div>

              <div class="actions col-md-12" style="padding:20px 15px;">
                <button class="btn btn-guardar" type="submit">Guardar</button>
                <a class="btn btn-cancelar" href="{{url('/admin/usuarios')}}">Cancelar</a>
            </div>
          </div>
          {!! Form::close() !!}
      </div>
  </div>
</div>
<script type="text/javascript">
  $('.empresa-select').select2();
  $( document ).ready(function() {
          $('#fecha').datepicker();

  });
</script>
@endsection
