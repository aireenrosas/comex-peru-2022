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
    <div class="lista-publicaciones-cont">
      <div class="row row-nomargin cont-subcripcion">
        <div class="col-md-12 col-nopadding">
          <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
          <div class="col-md-9 col-sm-9 col-xs-12 col-nopadding cont-subcripcion-elem">
              @if($publicacion_id==2)
              <p class="text-subscripcion">{!!trans('contenido.publicaciones')!!}</p>
              <button type="button" name="button" class="btn-subscripcion" data-toggle="modal" data-target="#modalSuscripcionRevista">{!!trans('contenido.suscripcion')!!}</button>
              @endif
              @if($publicacion_id==1 || $publicacion_id==4)
              <button type="button" name="button" class="btn-subscripcion" data-toggle="modal" data-target="#modalSuscripcion">{!!trans('contenido.suscripcion')!!}</button>
              @endif
          </div>
          <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
        </div>
      </div>
      <div class="pagination-box" align="center" style="width: 100%">
        {{$articulos->appends(['id'=>$request->input('id'), 'publicacion'=>$request->input('publicacion'), 'edicion'=>$request->input('edicion')])->links()}}
      </div>
      <div class="publicaciones-cont">
        @foreach ($articulos as $key)
        <div class="row row-nomargin row-publicacion">
          <div class="col-md-12 col-nopadding">
            <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
            <div class="col-md-10 col-sm-10 col-xs-12 col-nopadding">
              <div class="cont-publication-elem">
                <?php
                if($key->only_file==1){
                    $link = url('upload/articles/'.$key->directory.'/'.$key->file);
                }
                else{
                  $link = url($ruta.'/articulo/'.$key->slug);
                }
                if($ruta==''){
                  $data['publications'] = $key->name_es;
                  $publicacion = $key->name_es;
                }else{
                  $data['publications'] = $key->name_en;
                  $publicacion = $key->name_en;
                }

                ?>
                <a href="{{$link}}">
                  <p class="red">
                    {!!preg_replace('#<[^>]+>#', ' ', $key->title)!!}
                  </p>
                </a>

                <p class="Contenido-Publicac">
                  @if($key->columna!="")
                  <span class="Contenido-Publicac2">
                    ({!!trim($key->columna)!!})
                  </span>
                  <br>
                  @endif
                  <a href="{{url($ruta.'/publicaciones?id='.$key->idpubli.'&publicacion='.$publicacion.'&edicion='.$key->edition)}}" class="Contenido-Publicac">
                    <span>{{$publicacion}}  {{$key->edition}}</span>
                  </a></p>
                <small>{{Funciones::getDateString($key->published_at, $language_id)}}</small>

              </div>
            </div>
            <div class="col-md-1 col-sm-1 hidden-xs col-nopadding"></div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="pagination-box" align="center" style="width: 100%">
        {{$articulos->appends(['id'=>$request->input('id'), 'publicacion'=>$request->input('publicacion'), 'edicion'=>$request->input('edicion')])->links()}}
      </div>
    </div>

    <div class="modal-suscripcion-cont">
      <!-- Modal subscripcion-->
      <div class="modal fade" id="modalSuscripcion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <form id="inscrip-form" action="{{ url('subscriptionpublication') }}" method="POST" style="display:block;">
                  {{ csrf_field() }}
                  @if (session('okey'))
                    <script>
                    jQuery(function(){
                      swal("", "{!!trans('contenido.suscripcion_ok')!!}", "success")
                    });
                    </script>
                  @endif
                  @if (session('errorA'))
                    <script>
                    jQuery(function(){
                      $('#modalSuscripcion').modal('show');
                      $('.error_negocios').css('display','block');
                    //  swal("", "Se olvido de llenar el captcha xD", "error")
                    });
                    </script>
                  @endif
                <div class="titulo-contacto">{!!trans('contenido.suscripcion')!!}</div>
                <div class="cont-parrafocontc">
                  <p class="parrafo-contacto">
                  {!!trans('contenido.suscripcion_texto',['attribute' => strtoupper($request->publicacion)])!!}
                  </p>
                </div>
                <input type="hidden" name="id_publicacion" value="{{$publicacion_id}}"/>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.contacto_nombre')!!}*</label>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto nameC" name="nombre">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.contacto_email')!!}*</label>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto emailC" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" name="email">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.contacto_empresa')!!}*</label>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto empresaC" name="empresa">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.cargo')!!}*</label>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto cargoC" name="cargo">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.contacto_telefono')!!}</label>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto phoneC" name="telefono">
                  </div>
                </div>

                <div class="row row-nomargin padbo20">
                  <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.codigo_val')!!}*</label>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <div id="RecaptchaPublicacion"></div>
                    <input type="hidden" class="hiddenRecaptchaPublicacion required" name="hiddenRecaptchaPublicacion" id="hiddenRecaptchaPublicacion">
                  </div>
                </div>
                <div class="row row-nomargin padbo20">
                  <div class="col-md-12 col-nopadding d-flex">
                    <span class="parrafo-contacto pdr d-flex-son"> {!!trans('contenido.datos_accept')!!}</span>
                    <div class="">
                      <input class="terminos-contacto" type="radio" name="datos_accept" data-error="#errDatosAcceptPub" value="1"/><span class="parrafo-contacto"> Sí &nbsp;&nbsp;</span>
                      <br class="br-movil"><input class="terminos-contacto padlef15" type="radio" name="datos_accept" data-error="#errDatosAcceptPub" value="0"/><span class="parrafo-contacto"> No </span>
                    </div>
                  </div>
                  <div class="col-md-12 col-nopadding">
                    <span id="errDatosAcceptPub"></span>
                  </div>
                </div>
                <div class="row row-nomargin padbo20">
                  <div class="col-md-12 col-nopadding d-flex">
                    <span class="parrafo-contacto pdr"> {!!trans('contenido.imagen_accept')!!}</span>
                    <input class="terminos-contacto" type="checkbox" name="imagen_accept" data-error="#errImgAcceptPub"/>
                  </div>
                  <div class="col-md-12 col-nopadding">
                    <span id="errImgAcceptPub"></span>
                  </div>
                </div>
                <div class="form-botones">
                  <button type="submit" class="btn btn-enviar">{!!trans('contenido.contacto_enviar')!!}</button>
                  <span type="button" class="btn btn-reset limpiar hidden-xs" onclick="reset_1()">Reset</span>
                  <button data-dismiss="modal" class="btn btn-cancelar">{!!trans('contenido.cancelar')!!}</button>
                </div>
                <div class="cont-line hidden-xs"><div class="line-contacto"></div></div>
                <p class="direccion-contacto hidden-xs">Bartolomé Herrera 254, Lima 18. Lima-Perú </p>
                <p class="direccion-contacto hidden-xs">{!!trans('contenido.contacto_telefono')!!}: (511) 625-7700 / Fax: (511) 625-7701</p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--  Another Modal subscripcion-->
    <div class="modal-suscripcion-cont">
      <div class="modal fade" id="modalSuscripcionRevista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <form id="inscription_negocios_form" action="{{ url('subscriptionnegocios') }}" method="POST" style="display:block;">
                  {{ csrf_field() }}
                  @if (session('status'))
                    <script>
                    jQuery(function(){
                      swal("", "{!!trans('contenido.suscripcion_ok')!!}", "success")
                    });
                    </script>
                  @endif
                  @if (session('error'))
                    <script>
                    jQuery(function(){
                      $('#modalSuscripcionRevista').modal('show');
                      $('.error_negocios').css('display','block');
                    //  swal("", "Se olvido de llenar el captcha xD", "error")
                    });
                    </script>
                  @endif
                <div class="titulo-contacto">{!!trans('contenido.suscripcion')!!}</div>
                <div class="cont-parrafocontc">
                  <p class="parrafo-contacto">
                    {!!trans('contenido.suscripcion_texto1')!!}
                  </p>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.contacto_nombre')!!}*</label>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto nameC" name="name">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.cargo')!!}*</label>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto cargoC" name="position">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.contacto_empresa')!!}*</label>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto empresaC" name="institution">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.contacto_direccion')!!}*</label>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto direccionPersonalC" name="address">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.direccion_empresa')!!}</label>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto direccionInstitucionC" name="address_institution">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">RUC</label>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto rucC" name="ruc" maxlength=11 minlength=11>
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.contacto_telefono')!!}*</label>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto phoneC" name="phone">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">Fax</label>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto faxC" name="fax">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.contacto_email')!!}*</label>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
                    <input type="email" class="input-contacto emailC" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" name="email">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.suscripcion_minu')!!}*</label>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
                    <div class=" checkbox-cont">
                      <div class="anual-cont">
                          <p>{!!trans('contenido.anual')!!}</p>
                          <div class="radio">
                            <label><input type="radio" value="1" name="radio" required>{!!trans('contenido.peru')!!}<span class="black"> US$ 150</span></label>
                          </div>
                          <div class="radio">
                            <label><input type="radio" value="2" name="radio">{!!trans('contenido.otros_lati')!!}<span class="black"> US$ 170</span></label>
                          </div>
                          <div class="radio">
                            <label><input type="radio" value="3" name="radio">{!!trans('contenido.otros_conti')!!}<span class="black"> US$ 180</span></label>
                          </div>
                        <p>{!!trans('contenido.semestral')!!}</p>
                          <div class="radio">
                            <label><input type="radio" value="4" name="radio">{!!trans('contenido.peru')!!} <span class="black">US$ 80</span></label>
                          </div>
                          <div class="radio">
                            <label><input type="radio" value="5" name="radio">{!!trans('contenido.otros_lati')!!}<span class="black"> US$ 100</span></label>
                          </div>
                          <div class="radio">
                            <label><input type="radio" value="6" name="radio">{!!trans('contenido.otros_conti')!!}<span class="black"> US$ 110</span></label>
                          </div>
                          <label id="radio-error" class="error" for="radio"></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row row-nomargin padbo20">
                  <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.codigo_val')!!}*</label>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <div id="RecaptchaRevista"></div>
                    <input type="hidden" class="hiddenRecaptchaRevista required" name="hiddenRecaptchaRevista" id="hiddenRecaptchaRevista">
                  </div>
                </div>

                <div class="row row-nomargin padbo20">
                  <div class="col-md-12 col-nopadding d-flex">
                    <span class="parrafo-contacto pdr d-flex-son"> {!!trans('contenido.datos_accept')!!}</span>
                    <div class="">
                      <input class="terminos-contacto" type="radio" name="datos_accept" data-error="#errDatosAcceptRevista" value="1"/><span class="parrafo-contacto"> Sí &nbsp;&nbsp;</span>
                      <br class="br-movil"><input class="terminos-contacto padlef15" type="radio" name="datos_accept" data-error="#errDatosAcceptRevista" value="0"/><span class="parrafo-contacto"> No </span>
                    </div>
                  </div>
                  <div class="col-md-12 col-nopadding">
                    <span id="errDatosAcceptRevista"></span>
                  </div>
                </div>
                <div class="row row-nomargin padbo20">
                  <div class="col-md-12 col-nopadding d-flex">
                    <span class="parrafo-contacto pdr"> {!!trans('contenido.imagen_accept')!!}</span>
                    <input class="terminos-contacto" type="checkbox" name="imagen_accept" data-error="#errImgAcceptRevista"/>
                  </div>
                  <div class="col-md-12 col-nopadding">
                    <span id="errImgAcceptRevista"></span>
                  </div>
                </div>
                <div class="form-botones">
                  <button type="submit" class="btn btn-enviar">{!!trans('contenido.contacto_enviar')!!}</button>
                  <span type="button" class="btn btn-reset hidden-xs" onclick="reset()">Reset</span>
                  <button class="btn btn-cancelar" data-dismiss="modal">{!!trans('contenido.cancelar')!!}</button>
                </div>
                <div class="cont-line"><div class="line-contacto"></div></div>
                <p class="direccion-contacto">Bartolomé Herrera 254, Lima 18. Lima-Perú </p>
                <p class="direccion-contacto">{!!trans('contenido.contacto_telefono')!!}: (511) 625-7700 / Fax: (511) 625-7701</p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
      var required="{!!trans('contenido.contacto_obligatorio')!!}";
      var lettersonly="{!!trans('contenido.contacto_sololetras')!!}";
      var number="{!!trans('contenido.contacto_solonumeros')!!}";
      var minlength="{!!trans('contenido.contacto_validtele')!!}";
      var minlengthdoc="{!!trans('contenido.contacto_document')!!}";
      var email="{!!trans('contenido.contacto_validmail')!!}";
      var alphanumerico="{!!trans('contenido.contacto_sololetras')!!}"+' '+"{!!trans('contenido.contacto_solonumeros')!!}";
      var customemail="{!!trans('contenido.contacto_validmail')!!}";
      var minlengthruc="{!!trans('contenido.contacto_numDoc')!!}";
      var maxlengthruc="{!!trans('contenido.contacto_numDoc')!!}";
      var must_accept_terms = "*{!!trans('contenido.must_accept_terms')!!}";
  </script>

  <script src="<?php echo URL::asset('js/servicioslistado.js?v=1.3'); ?>" type="text/javascript"></script>
@endsection
