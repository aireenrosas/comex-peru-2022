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
                <h1 class="titulo-editar">Editar Usuario</h1>
            </div>
          </div>
          {!! Form::open(['url' => '/admin/usuarios/'.$usuarios->id, 'method' => 'PATCH'])!!}

          <div class="portlet-body">
              <div class="col-md-6">
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Rol</label>
                  {{ Form::select('rol_id', $roles, $usuarios->rol_id, ['class' => 'form-control input-admin']) }}
                  {!! $errors->first('rol_id', '<span class="help-block alert-danger">:message</span>') !!}
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Nombre</label>
                  {!! Form::text('name',$usuarios->name ,['class' => 'form-control input-admin', 'placeholder' => 'Escribe el nombre del usuario'])!!}
                  {!! $errors->first('name', '<span class="help-block alert-danger">:message</span>') !!}
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Usuario</label>
                  {!! Form::text('login',$usuarios->login  ,['class' => 'form-control input-admin', 'placeholder' => '','readonly'])!!}
                  {!! $errors->first('login', '<span class="help-block alert-danger">:message</span>') !!}
                </div>

                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Empresa</label>
                  {!! Form::select('ruc',$empresas, $usuarios->ruc ,['class' => 'form-control input-admin empresa-select', 'placeholder' => 'Selecciona'])!!}

                  {!! $errors->first('ruc', '<span class="help-block alert-danger">:message</span>') !!}
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Descripción</label>
                  {{ Form::textarea('description', $usuarios->description, ['class' => 'form-control input-admin']) }}
                  {!! $errors->first('description', '<span class="help-block alert-danger">:message</span>') !!}
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Estado</label>
                  @if($usuarios->state==2)
                  <?php
                  $texto= 'unchecked';
                  ?>
                  @else
                  <?php
                  $texto= 'checked';
                  ?>
                  @endif

                  <div class="col-md-12 col-xs-12" style="padding-left: 0px;">
                    <div class="onoffswitch">
                      <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" {{$texto}}>
                      <label class="onoffswitch-label" for="myonoffswitch">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                      </label>
                    </div>
                </div>
                </div>
                <div class="col-md-12 form-group">
                  <label class="label-input-format label-titulo">Cambiar Contraseña</label>
                  {!! Form::password('password',['class' => 'form-control input-admin pass', 'type' => 'password', 'placeholder' => 'Escribe el Contraseña','disabled','minlength'=>'6'])!!}
                  {!! $errors->first('password', '<span class="help-block alert-danger">:message</span>') !!}
                  <div class="checkbox">
                    <label><input id='checkbox_check' class="checkbox_check" type="checkbox" value="false" name="check">Cambiar contraseña</label>
                  </div>
                </div>
              <div class="actions col-md-12" style="padding:20px 15px;">
                <button class="btn btn-guardar" type="submit">Guardar</button>
                <a class="btn btn-cancelar" href="{{url('/admin/usuarios')}}">Cancelar</a>
            </div>
          </div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          {!! Form::close() !!}
      </div>
  </div>
</div>
</div>
<script type="text/javascript">

  var url='{!!url('/')!!}';
  var token='{!!csrf_token()!!}';

  $('.empresa-select').select2();

  $( document ).ready(function() {

    $('#fecha').datepicker();

    $("#checkbox_check").on( 'change', function() {
        if( $(this).is(':checked') ) {
            $('.pass').removeAttr('disabled');
            $('#checkbox_check').attr('value','true');
        } else {
          $('.pass').attr('disabled','true');
          $('#checkbox_check').attr('value','false');
        }
    });

    $("#checkActivo").on( 'change', function() {
        if( $(this).is(':checked') ) {
            $('#checkActivo').attr('value','2');
            $('#checkActivo').parent().find('.estado').text('Inactivo');
        } else {
          $('#checkActivo').attr('value','1');
          $('#checkActivo').parent().find('.estado').text('Activo');
        }
    });
});

</script>
@endsection
