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
  <div class="eventoscont">
    <div class="">
      <div class="cont-servicios row row-nomargin">
        <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
        <!-- <div class="col-md-8 col-sm-8 col-xs-12 col-nopadding anchoservicio">
          <p class="texto30"><strong>ComexPerú</strong> {!!trans('contenido.eventos_contenido')!!}</p>
        </div> -->
        <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
      </div>
      <div class="banner-cont">
        <div class="imagenservicios">
          <img src="{!!url('/images/banner-eventos.png')!!}" class="img-responsive img-serv" alt=""/>
        </div>
      </div>
      <!-- div class="cont-inscripcion-elem">
        <p class="text-inscripcion">{!!trans('contenido.eventos_txt_inscripcion')!!}</p>
        <button type="button" name="button" class="btn-inscripcion" data-toggle="modal" data-target="#modalInscripcion">{!!trans('contenido.eventos_btn_inscripcion')!!}</button>
        <a href="#" target="_blank" class="btn-inscripcion">{!!trans('contenido.eventos_btn_inscripcion')!!}</a>
      </div -->
      <div class="cont-seminarios col-nopadding row row-nomargin">
        <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
        <div class="col-md-8 col-sm-8 col-xs-12 section-servicios leftcero rightcero anchoservicio">
          <div class="cont-box-subscribe"></div>
          <div class="hidden-lg hidden-md hidden-sm col-xs-12 col-nopadding"><p class="title-cronograma">{!!trans('contenido.eventos_txt_cronograma')!!}</p></div>
          <div class="col-md-3 col-sm-12 col-xs-12 nosotros ancho100"><h1 class="titulo25">{!!trans('contenido.eventos_seminarios')!!}</h1></div>
          <div class="col-md-1 col-xs-1 espacio"></div>
          <div class="col-md-8 col-sm-12 col-xs-8 leftcero rightcero ancho100">
            <div class="col-md-12 col-xs-12 leftcero rightcero ppparteev"><p class="parrafo14">COMEXPERÚ {!!trans('contenido.eventos_seminarios_text')!!}</p></div>
            <div class="col-md-12 col-xs-12 leftcero rightcero titulo-presentaciones">
              <div class="lista-serv">
                <a class="link-servicio link-ver-anteriores" href="{{ url($ruta."/foro") }}"><i class="fa fa-circle-thin ico-circle" aria-hidden="true"></i>{!!trans('contenido.presentaciones_anteriores')!!}</a>
              </div>
            </div>
            <div class="col-md-12 col-xs-12 leftcero rightcero titulo-evento">
              <p class="titulo14">{!!trans('contenido.eventos_seminarios_cronograma')!!}</p>
            </div>
            <?php $i = 0;?>
            <div class="col-md-12 col-xs-12 leftcero rightcero cont-seminario">
              @foreach ($meses as $key)
                <?php $mes = Funciones::getNameMonth($key->month, $language_id);
                  $mes = strtoupper($mes);
                  $seminarios = Funciones::getSeminarByMonth($key->month, $key->year, $language_id);

                ?>
                  <div class="col-md-6 col-sm-6 col-xs-12 leftcero eventodet">

                        @foreach ($seminarios as $seminario)

                          @if($i%2==0)
                          <div class="seminario-resp row hidden-lg hidden-md hidden-sm red-evento">
                          @else
                          <div class="seminario-resp row hidden-lg hidden-md hidden-sm grey-evento">
                          @endif
                            <div class="fecha-resp col-xs-4 leftcero">
                              <p>{{$seminario['day']}} {{$mes}}</p>
                              <p>{{$seminario['day_name']}}</p>
                            </div>
                            <div class="lugar-resp col-xs-8 rightcero">
                              <p class="seminario-title">{{$seminario['name']}}</p>
                              <p class="lugar">{!!trans('contenido.eventos_seminarios_lugar')!!}{{$seminario['place']}}</p>
                              <i class="fa fa-check-circle ico-verprograma" aria-hidden="true"><a target="blank" href= '{{$seminario['file']}}' class="ver-programa">{!!trans('contenido.eventos_seminarios_programa')!!}</a></i>
                            </div>
                        </div>
                        <?php $i++;?>
                        @endforeach

                    <div class="hidden-xs  cont-seminario-sm" id="cont-seminario-sm">
                      <p class="titulo-mes">{{$mes}}</p>
                      @foreach ($seminarios as $seminario)
                        <p class="titulo-blanco12">{{$seminario['name']}}</p>
                        <p class="dia">{{$seminario['day_name']}} {{$seminario['day']}}</p>
                        <p class="lugar">{!!trans('contenido.eventos_seminarios_lugar')!!} <span class="direccion">{{$seminario['place']}}</span></p>
                        @if($seminario['file'] != "")
                        <i class="fa fa-check-circle ico-verprograma" aria-hidden="true"><a target="blank" href= '{{$seminario['file']}}' class="ver-programa">{!!trans('contenido.eventos_seminarios_programa')!!}</a></i>
                        @endif
                      @endforeach
                    </div>

                  </div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
      </div>
      <div class="cont-servicios row row-nomargin cumbres_empresariales">
        <!-- a id="cumbres" name="cumbres"> <a/ -->
        <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
        <div class="col-md-8 col-sm-8 col-xs-12 section-servicios leftcero rightcero anchoservicio">

          <div class="col-md-3 col-xs-12 nosotros ancho titservancho" data-toggle="collapse" data-target="#titservancho" aria-expanded="false" aria-controls="titservancho">
            <h1 class="titulo25">{!!trans('contenido.eventos_cumbres')!!}</h1><!-- i class="fa fa-chevron-right" style="position:absolute;right:0;top:28px;font-size: 20px;"></i -->
          </div>

          <div class="cumbres-resp hidden-lg hidden-md hidden-sm">
            @foreach ($cumbres as $data)
            <?php $mes_m = strtoupper( $data['month']);?>
            <div class="col-xs-12 cumbres-resp-cont">
              @if($data['day']!="")
              <div class="fecha-resp col-xs-4 leftcero">
              <p>{{$data['day']}} {{$mes_m}}</p>
              <p>{{$data['day_name']}}</p>
              </div>
              @endif


            <div class="lugar-resp col-xs-8 rightcero">
              <p class="seminario-title">{{$data['title']}}</p>
              @if($data['place']!="")
              <p class="lugar">{!!trans('contenido.eventos_seminarios_lugar')!!} {{$data['place']}}</p>
              @endif
            </div>
            </div>
            @endforeach
          </div>
          <div class="col-md-1 col-sm-1 hidden-xs espacio"></div>

          <div class="col-md-8 leftcero rightcero ancho100 cumbres-cont" id="titservancho">
            <!-- introduccion de la cumbres -->
            <div class="col-md-12 col-xs-12 leftcero rightcero evparte">
              <p class="parrafo14">COMEXPERÚ {!!trans('contenido.eventos_cumbres_text')!!}</p>
              <p class="parrafo14">{!!trans('contenido.eventos_cumbres_text1')!!}</p>
            </div>
            <!-- inicio de la lista de la cumbres -->
            @foreach ($cumbres as $data)

             
            <div class="col-md-12 col-xs-12 leftcero rightcero ppparteev cumbres_li" data="{{$data['id']}}" data-toggle="collapse" data-target="#collapse{{$data['id']}}" aria-expanded="false" aria-controls="collapse{{$data['id']}}">
              <div class="seccionder">
                <i class="fa fa-circle-thin ico-circle2" aria-hidden="true"></i>
              </div>
              <div class="seccionizq">
                <p class="parrafo14">{{$data['name']}}</p>
                @if($data['description']!="")
                <i class="fa fa-chevron-down" style="float: right;"></i>
                @endif
              </div>
            </div>

            @if($data['description']!="")
            <div class="col-md-12 col-xs-12 leftcero rightcero cont-textos collapse" data="{{$data['id']}}" id="collapse{{$data['id']}}">
              <div class="col-md-9 col-xs-9 leftcero texto-izq ancho100">
                <p class="titulo-rojo20"> {{$data['name']}}</p>
                <div class="">
                  <p class="parrafo14"> {{$data['description']}}</p>
                </div>
              </div>
              <div class="col-md-3 col-xs-3 rightcero ancho100">
                <?php $mes_m = strtoupper( $data['month'] );?>
                <p class="titulo-mes">{{$mes_m}}</p>

                <p class="titulo2-blanco12"> {{$data['title']}}</p>
                @if($data['day']!="")
                <p class="dia">{{$data['day_name']}} {{$data['day']}}</p>
                @endif
                @if($data['place']!="")
                <p class="lugar">{!!trans('contenido.eventos_seminarios_lugar')!!} <span class="direccion"> {{$data['place']}}</span></p>
                @endif
                @if($data['time']!="")
                <p class="lugar">{!!trans('contenido.eventos_horas')!!} <span class="direccion">{{$data['time']}}</span></p>
                @endif
                @if($data['url']!="")
                <a class="ver-programa" href= "{{'http://'.$data['url']}}" target="_blank">{{$data['url']}}</a>
                @endif
              </div>
            </div>
            @endif

            @endforeach
          </div>

        </div>
        <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
      </div>
      <!-- div class="cont-bannerserv">
        <div class="imagenservicios">
          <img src="{!!url('/images/banner-eventos2.png')!!}" class="img-responsive img-serv" alt=""/>
        </div>
      </div -->
      <div class="cont-servicios row row-nomargin">
        <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
        <div class="col-md-8 col-sm-8 col-xs-12 section-servicios leftcero rightcero anchoservicio">
          <div class="col-md-3 col-xs-12 nosotros ancho anchoancho" data-toggle="collapse" data-target="#anchoancho" aria-expanded="false" aria-controls="anchoancho">
            <h3 class="titulo25">{!!trans('contenido.eventos_talleres')!!}</h3><!-- i class="fa fa-chevron-right" style="position:absolute;right:0;top:19px;font-size: 20px;"></i -->
          </div>
          <div class="col-md-1 hidden-sm espacio"></div>
          <div class="col-md-8 col-xs-12 leftcero rightcero anchoancho ancho100" id="anchoancho">
            <div class="col-md-12 col-xs-12 leftcero rightcero evparte">
              <p class="parrafo14">ComexPerú {!!trans('contenido.eventos_talleres_text')!!}</p>
            </div>
          </div>
        </div>
        <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
      </div>
      {{-- <div class="row row-nomargin cont-inscripcion">
        <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
        <div class="col-md-8 col-xs-8 leftcero rightcero anchoservicio"> --}}
          <div class="cont-inscripcion-elem hidden-xs">
            <p class="text-inscripcion">{!!trans('contenido.eventos_txt_inscripcion')!!}</p>
            <button type="button" name="button" class="btn-inscripcion" data-toggle="modal" data-target="#modalInscripcion">{!!trans('contenido.eventos_btn_inscripcion')!!}</button>
            <!-- a href="#" target="_blank" class="btn-inscripcion">{!!trans('contenido.eventos_btn_inscripcion')!!}</a -->
          </div>
        {{-- </div>
        <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
      </div> --}}

    </div>
    @include('front.servicios.nuestrosservicios')
    <div class="modal-suscripcion-cont">
      <!-- Modal subscripcion-->
      <div class="modal fade" id="modalInscripcion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              {!! Form::open(['url' => '/eventos', 'method' => 'POST', 'id'=>'inscripcion', 'data-confirm' => 'test'])!!}
              @if (session('status'))
                <script>
                jQuery(function(){
                  swal("", "{!!trans('contenido.inscripcion_ok')!!}", "success")
                });
                </script>
              @endif
                <div class="titulo-contacto">{!!trans('contenido.eventos_form')!!}</div>
                <div class="cont-parrafocontc">
                  <p class="parrafo-contacto">
                  {!!trans('contenido.eventos_form_text')!!}
                  </p>
                </div>
                <input name="language_id" value="{{$language_id}}" type="hidden"/>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-3 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.contacto_empresa')!!}</label>
                  </div>
                  <div class="col-md-9 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto empresaC" name="company">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-3 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">RUC</label>
                  </div>
                  <div class="col-md-9 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto ruc" name="ruc" >
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-3 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">Sector</label>
                  </div>
                  <div class="col-md-9 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto sectorC" name="sector">
                  </div>
                </div>

                <div class="row form-contacto row-nomargin">
                  <div class="col-md-3 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.contacto_direccion')!!}*</label>
                  </div>
                  <div class="col-md-9 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto direccionC" name="address">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-3 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.contacto_email')!!}*</label>
                  </div>
                  <div class="col-md-9 col-sm-9 col-xs-12 col-nopadding">
                    <input type="email" class="input-contacto emailC" placeholder="ejemplo@ejemplo.com" name="email">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-3 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.contacto_telefono')!!}</label>
                  </div>
                  <div class="col-md-9 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto phoneC" name="phone">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-3 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">Fax</label>
                  </div>
                  <div class="col-md-9 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto faxC" name="fax">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-3 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.contacto_nombre')!!}*</label>
                  </div>
                  <div class="col-md-9 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto nameC" name="name">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-3 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.contacto_apellido')!!}*</label>
                  </div>
                  <div class="col-md-9 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto apellidoC" name="lastname">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-3 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.tipo_documento')!!}</label>
                  </div>
                  <div class="col-md-9 col-sm-9 col-xs-12 col-nopadding">
                    <select id="documento" class="form-control" name="document_type">
                        <option value="hide">{!!trans('contenido.tipo_documento')!!}</option>
                        <option value="DNI">DNI</option>
                        <option value="Pasaporte">Pasaporte</option>
                        <option value="Carnet de Extranjeria">Carnet de Extranjeria</option>
                    </select>
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-3 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.documento')!!}</label>
                  </div>
                  <div class="col-md-9 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto documentoC" name="document">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-3 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.cargo')!!}</label>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
                    <input type="text" class="input-contacto cargoC" name="position">
                  </div>
                </div>
                <div class="row form-contacto row-nomargin">
                  <div class="col-md-3 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.foro_desea')!!}*</label>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
                   <select id="evento" name="seminar_id">
                     @foreach ($list_events as $list_events)
                       <option value="{!!$list_events->id!!}">{!!$list_events->name!!}</option>
                     @endforeach
                  </select>
                  <div class="row row-nomargin">
                    <div class="col-md-10 col-sm-9 col-xs-12 col-nopadding">
                      <label id="seminar_id-error" class="error" for="seminar_id"></label>
                    </div>
                  </div>

                  </div>
                </div>
                <div class="row row-nomargin padbo20">
                  <div class="col-md-2 col-sm-3 col-xs-12 col-nopadding">
                    <label class="label-contacto">{!!trans('contenido.codigo_val')!!}*</label>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <div id="RecaptchaInscripcion"></div>
                    <input type="hidden" class="hiddenRecaptchaEvento required" name="hiddenRecaptchaEvento" id="hiddenRecaptchaEvento">
                  </div>
                </div>
                <div class="row row-nomargin padbo20">
                  <div class="col-md-12 col-nopadding d-flex">
                    <span class="parrafo-contacto pdr d-flex-son"> {!!trans('contenido.datos_accept')!!}</span>
                    <div class="">
                      <input class="terminos-contacto" type="radio" name="datos_accept" data-error="#errDatosAcceptIns" value="1"/><span class="parrafo-contacto"> Sí &nbsp;&nbsp;</span>
                      <br class="br-movil"><input class="terminos-contacto padlef15" type="radio" name="datos_accept" data-error="#errDatosAcceptIns" value="0"/><span class="parrafo-contacto"> No </span>
                    </div>
                  </div>
                  <div class="col-md-12 col-nopadding">
                    <span id="errDatosAcceptIns"></span>
                  </div>
                </div>
                <div class="row row-nomargin padbo20">
                  <div class="col-md-12 col-nopadding d-flex">
                    <span class="parrafo-contacto pdr"> {!!trans('contenido.imagen_accept')!!}</span>
                    <input class="terminos-contacto" type="checkbox" name="imagen_accept" data-error="#errImgAcceptIns"/>
                  </div>
                  <div class="col-md-12 col-nopadding">
                    <span id="errImgAcceptIns"></span>
                  </div>
                </div>
                <div class="form-botones">
                  <button type="submit" class="btn btn-enviar">{!!trans('contenido.contacto_enviar')!!}</button>
                  <span type="button" class="btn btn-reset hidden-xs" onclick="reset_eventos()">Reset</span>
                  <button data-dismiss="modal" class="btn btn-cancelar">{!!trans('contenido.cancelar')!!}</button>
                </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- div class="modal fade" tabindex="-1" role="dialog" id="popup">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body" style="padding:0px">
          <a href="https://cumbrepyme.org/" target="_blank">
            <img src="https://www.comexperu.org.pe/images/cumbre-pyme-2021.jpg" alt="Cumbre Pyme 2021" title="Cumbre Pyme 2021" style="width:100%">
          </a>
        </div>
      </div>
    </div>
  </div -->

  <!-- script type="text/javascript">
      $(window).load(function(){
        $('#popup').modal({
          show: true,
          backdrop: true,
        });
      });
    </script -->



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

  <script src="<?php echo URL::asset('js/eventos.js?v=1.3'); ?>" type="text/javascript"></script>


@endsection
