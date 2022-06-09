<!-- Modal contacto -->
<div class="modal fade" id="ModalContacto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      {{-- <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> --}}
      {!! Form::open(['url' => '/sendmail', 'method' => 'POST', 'id'=> 'myform' ])!!}

      <div class="modal-body">

          @if (session('status'))
            <script>
            jQuery(function(){
              swal("", "{!!trans('contenido.correctamente')!!}", "success")
            });
            </script>
          @endif
          <div class="titulo-contacto">{!!trans('contenido.contacto')!!}</div>
          <div class="cont-parrafocontc">
            <p class="parrafo-contacto">
              {!!trans('contenido.contacto_contenido')!!}
            </p>
          </div>
          <div class="row row-nomargin form-contacto">
            <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
              <label class="label-contacto">{!!trans('contenido.contacto_nombre')!!}</label>
            </div>
            <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
              <input type="text" class="input-contacto nameC" name="nombre">
            </div>
          </div>
          <div class="row row-nomargin form-contacto">
            <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
              <label class="label-contacto">{!!trans('contenido.contacto_telefono')!!}</label>
            </div>
            <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
              <input type="text" class="input-contacto phoneC" name="telefono">
            </div>
          </div>
          <div class="row row-nomargin form-contacto">
            <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
              <label class="label-contacto">{!!trans('contenido.contacto_email')!!}</label>
            </div>
            <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
              <input type="text" class="input-contacto emailC" name="email">
            </div>
          </div>
          <div class="row row-nomargin form-contacto">
            <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
              <label class="label-contacto">{!!trans('contenido.contacto_empresa')!!}</label>
            </div>
            <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
              <input type="text" class="input-contacto compannyC" name="empresa">
            </div>
          </div>
          <div class="row row-nomargin form-contacto">
            <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
              <label for="message-text" class="label-contacto">{!!trans('contenido.contacto_mensaje')!!}</label>
            </div>
            <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
              <textarea class="textarea-contacto messageC" name="mensaje"></textarea>
            </div>
          </div>
          <div class="row row-nomargin padbo20">
            <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
              <label class="label-contacto">{!!trans('contenido.codigo_val')!!}*</label>
            </div>
            <div class="col-md-10 col-sm-9 col-xs-12">
              <div id="RecaptchaContacto"></div>
              <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
            </div>
          </div>
          <div class="row row-nomargin padbo20">
            <div class="col-md-12 col-nopadding d-flex">
              <span class="parrafo-contacto pdr d-flex-son"> {!!trans('contenido.datos_accept')!!}</span>
              <div class="">
                <input class="terminos-contacto" type="radio" name="datos_accept" data-error=".errDatosAccept" value="1"/><span class="parrafo-contacto"> Sí &nbsp;&nbsp;</span>
                <br class="br-movil"><input class="terminos-contacto padlef15" type="radio" name="datos_accept" data-error=".errDatosAccept" value="0"/><span class="parrafo-contacto"> No </span>
              </div>
            </div>
            <div class="col-md-12 col-nopadding">
              <span class="errDatosAccept"></span>
            </div>
          </div>
          <div class="row row-nomargin padbo20">
            <div class="col-md-12 col-nopadding d-flex">
              <span class="parrafo-contacto pdr"> {!!trans('contenido.imagen_accept')!!}</span>
              <input class="terminos-contacto" type="checkbox" name="imagen_accept" data-error=".errImgAccept"/>
            </div>
            <div class="col-md-12 col-nopadding">
              <span class="errImgAccept"></span>
            </div>
          </div>

          <div class="form-botones">
            <button type="submit" class="btn btn-enviar">{!!trans('contenido.contacto_enviar')!!}</button>
            <span type="button" class="btn btn-limpiar limpiar hidden-xs">{!!trans('contenido.contacto_limpiar')!!}</span>
            <button data-dismiss="modal" class="btn btn-cancelar hidden-lg hidden-md hidden-sm">{!!trans('contenido.cancelar')!!}</button>
          </div>
          <div class="cont-line"><div class="line-contacto"></div></div>
          <p class="direccion-contacto">Bartolomé Herrera 254, Lima 18. Lima-Perú </p>
          <p class="direccion-contacto">{!!trans('contenido.contacto_telefono')!!}: (511) 625-7700 / Fax: (511) 625-7701</p>
        {!! Form::close()!!}
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var required="{!!trans('contenido.contacto_obligatorio')!!}";
  var lettersonly="{!!trans('contenido.contacto_sololetras')!!}";
  var number="{!!trans('contenido.contacto_solonumeros')!!}";
  var minlength="{!!trans('contenido.contacto_validtele')!!}";
  var email="{!!trans('contenido.contacto_validmail')!!}";
  var alphanumerico="{!!trans('contenido.contacto_sololetras')!!}"+' '+"{!!trans('contenido.contacto_solonumeros')!!}";
  var customemail="{!!trans('contenido.contacto_validmail')!!}";
  var must_accept_terms = "*{!!trans('contenido.must_accept_terms')!!}";
</script>
<script src="<?php echo URL::asset('js/validacion_modal.js?v=1.3'); ?>" type="text/javascript"></script>
