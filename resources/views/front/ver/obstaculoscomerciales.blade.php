@extends('app.app')
<?php
$ogdescription = 'ComexPerú es el gremio privado que agrupa a las principales empresas vinculadas al Comercio Exterior en el Perú.';
$ogimage = '';
$ogtitle = 'COMEX - Sociedad de Comercio Exterior del Perú - Inicio';
$ogurl = url('/');
?>
@section('style')
@endsection
@section('script')
@endsection
@section('content')
  <div class="container-comex">
    <div class="servicioscont obstaculoscont">
      <div class="row row-nomargin">
        {!! Form::open(['url' => '/sendproblematic', 'method' => 'POST', 'id'=> 'formproblematic' ])!!}
        <div class="col-md-12 col-xs-12 col-nopadding">
          <div class="col-md-1 col-sm-1 hidden-xs"></div>
          <div class="col-md-10 col-sm-10 col-xs-12 col-nopadding">
            <div class="col-md-12 col-xs-12 col-nopadding">
              <div class="col-md-4 col-sm-12 col-xs-12 col-nopadding">
                <h2 class="obtaculos-titulo">OBSTÁCULOS AL COMERCIO</h2>
              </div>
              <div class="col-md-8 col-sm-12 col-xs-12 col-nopadding cont-der">
                <p class="obtaculos-parrafo">
                  {!!trans('contenido.obstaculos_texto')!!}
                </p>
                <p class="advertencia-parrafo">
                  {!!trans('contenido.obstaculos_texto1')!!}(*)
                </p>
                <!-- BEGIN CONTENT -->
                <div class="formulario-container">
                  <div class="contendor-form">
                    <form action="" class="formCotizacion" id="cotizacion">
                      <div class="row row-nomargin">
                        <div class="col-md-12 col-xs-12 col-nopadding">
                         <div class="form-group">
                           <p class='lbl'>{!!trans('contenido.contacto_nombre')!!} *</p>
                            <div class="controls">
                              <input type="text" name="nombre" class="form-control" placeholder="">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row row-nomargin">
                        <div class="col-md-12 col-xs-12 col-nopadding">
                          <div class="form-group">
                            <p class='lbl'>{!!trans('contenido.contacto_apellido')!!} *</p>
                            <div class="controls">
                              <input type="text" name="apellido" class="form-control" placeholder="">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row row-nomargin">
                        <div class=" col-md-12 col-xs-12 col-nopadding email-phone-cont">
                          <div class=" col-md-6 col-xs-12 leftcero">
                           <div class="form-group">
                             <p class='lbl'>{!!trans('contenido.contacto_email')!!} *</p>
                            <div class="controls">
                              <input type="text" name="email" placeholder="ejemplo@ejemplo.com" class="form-control" placeholder="">
                            </div>
                          </div>
                          </div>
                          <div class=" col-md-6 col-xs-12 rightcero">
                           <div class="form-group">
                             <p class='lbl'>{!!trans('contenido.contacto_telefono')!!} *</p>
                            <div class="controls">
                              <input type="text" name="telefono" class="form-control" placeholder="">
                            </div>
                          </div>
                          </div>
                        </div>
                      </div>

                      <div class="row row-nomargin">
                        <div class="col-md-12 col-xs-12 col-nopadding">
                          <div class="form-group">
                            <p class='lbl'>{!!trans('contenido.contacto_empresa')!!} *</p>
                            <div class="controls">
                              <input type="text" name="empresa" class="form-control" placeholder="">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row row-nomargin">
                        <div class="col-md-12 col-xs-12 col-nopadding">
                          <div class="form-group">
                            <p class='lbl'>{!!trans('contenido.obstaculos_texto2')!!} *</p>
                            <div class="controls">
                              <textarea class="form-control" rows="7" id="comment" name="descripcion"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row row-nomargin">
                        <div class="col-md-12 col-xs-12 col-nopadding">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-botones col-nopadding">
                            <div class="col-md-3 col-sm-3 col-xs-12 col-nopadding btnEnviar-cont">
                              <button type="submit" class="btnEnviar" style="margin-bottom:30px;">{!!trans('contenido.contacto_enviar')!!}</button>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12 col-nopadding btnLimpiar-cont">
                              <button type="" class="btnLimpiar" onclick="limpiar()">{!!trans('contenido.contacto_limpiar')!!}</button>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6 hidden-xs col-nopadding"></div>
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            <div class="col-md-1 col-sm-1 hidden-xs"></div>
          </div>
        </div>
        {!! Form::close()!!}
      </div>
    </div>

    <script>
        var required="{!!trans('contenido.contacto_obligatorio')!!}";
        var number="{!!trans('contenido.contacto_solonumeros')!!}";
        var minlength="{!!trans('contenido.contacto_validtele')!!}";
        var email="{!!trans('contenido.contacto_validmail')!!}";
        var alphanumerico="{!!trans('contenido.contacto_sololetras')!!}"+' '+"{!!trans('contenido.contacto_solonumeros')!!}";
        var customemail="{!!trans('contenido.contacto_validmail')!!}";
    </script>

    <script src="<?php echo URL::asset('js/obstaculos.js'); ?>" type="text/javascript"></script>


@endsection
