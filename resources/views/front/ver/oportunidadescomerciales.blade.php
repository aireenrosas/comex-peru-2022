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
<script src="<?php echo URL::asset('js/listas.js'); ?>" type="text/javascript"></script>
@endsection
@section('content')
  <div class="container-comex">
    <div class="oportunidadescont">
      <div class="col-md-12 col-xs-12 col-nopadding">
        <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
        <div class="col-md-3 col-sm-10 col-xs-12 col-nopadding titulo-cont">
          <h2 class="titulo30">{!!trans('contenido.oportunidades')!!}</h2>
        </div>
      </div>
      <div class="col-md-12 col-xs-12 container-rojo-map">
        <div class="distribution-map" id="map-container">
          <img src="images/map-plain.png" alt="Mapa Imagen" class="img-responsive map-image">
          <div class="tooltip-container">
            <a class="map-point atooltip" style="top: 27.5%;left: 48.7%;" title="<strong>Hamburgo: </strong>Granos andinos, quinua, kiwicha, paiche." data-html="true" rel="tooltip" href="#">
              <div class="outer-circle">
                <div class="inner-circle">
                </div>
              </div>
            </a>
          </div>
          <div class="tooltip-container">
            <a class="map-point atooltip" style="top:72%; left:32.5%;" title="<strong>Sao Paulo: </strong>Quinua, orégano, aceitunas, mandarinas, cítricos, trucha, anchoveta en conserva." data-html="true" rel="tooltip" href="#">
              <div class="outer-circle">
                <div class="inner-circle">
                </div>
              </div>
            </a>
          </div>
          <div class="tooltip-container">
            <a class="map-point atooltip" style="top: 30%;left: 75.6%;" title="<strong>Beijing: </strong>Pota congelada, anguila congelada, trucha, jibias, langostinos, paiche, uvas frescas, paltas, mangos, cítricos, espárragos, mangos." data-html="true" rel="tooltip" href="#">
              <div class="outer-circle">
                <div class="inner-circle">
                </div>
              </div>
            </a>
          </div>
          <div class="tooltip-container">
            <a class="map-point atooltip" style="top: 37%; left: 80.1%;" title="  <strong>Seúl: </strong>Quinua (pre cocida o tostada), frutas frescas, uvas, mangos, arándanos, paltas, pota, anguila, langostinos, café de especialidad." data-html="true" rel="tooltip" href="#">
              <div class="outer-circle">
                <div class="inner-circle">
                </div>
              </div>
            </a>
          </div>
          <div class="tooltip-container">
            <a class="map-point atooltip" style="top:50%; left:60%;" title="<strong>Dubái: </strong>Granos andinos en diversas presentaciones, uvas frescas, paiche, conchas de abanico, camarones, productos orgánicos." data-html="true" rel="tooltip" href="#">
              <div class="outer-circle">
                <div class="inner-circle">
                </div>
              </div>
            </a>
          </div>
          <div class="tooltip-container">
            <a class="map-point atooltip" style="top:42.8%; left:24%;" title="<strong>Miami: </strong>Productos 'ready to eat', productos naturales." data-html="true" rel="tooltip" href="#">
                <div class="outer-circle">
                  <div class="inner-circle">
                  </div>
                </div>
            </a>
          </div>
          <div class="tooltip-container">
            <a class="map-point atooltip" style="top: 31%;left: 45.3%;" title="<strong>Amsterdam: </strong>Frutas exóticas, lúcuma, maracuyá, maca." data-html="true" rel="tooltip" href="#">
                <div class="outer-circle">
                  <div class="inner-circle">
                  </div>
                </div>
            </a>
          </div>
          <div class="tooltip-container">
            <a class="map-point atooltip" style="top:45.8%; left:64.5%;" title="<strong>Nueva Delhi: </strong>Cacao, café, frejoles, quinua, pisco, uvas frescas." data-html="true" rel="tooltip" href="#">
                <div class="outer-circle">
                  <div class="inner-circle">
                  </div>
                </div>
              </a>
          </div>
            <div class="tooltip-container">
              <a class="map-point tooltip" style="top: 62.5%;left: 73%;" title="<strong>Jacarta: </strong>Uvas frescas, súper foods, quinua, maca, paiche." data-html="true" rel="tooltip" href="#">
                <div class="outer-circle">
                  <div class="inner-circle">
                  </div>
                </div>
              </a>
            </div>
            <div class="tooltip-container">
              <a class="map-point tooltip" style="top: 56.5%;left: 25.3%;" title="<strong>Ciudad de Panamá: </strong>Pota , maca, sacha inchi, pisco." data-html="true" rel="tooltip" href="#">
                <div class="outer-circle">
                  <div class="inner-circle">
                  </div>
                </div>
              </a>
            </div>
            <div class="tooltip-container">
              <a class="map-point atooltip" style="top: 24%;left: 54%;" title="<strong>Moscú: </strong>Uvas frescas, mariscos, conservas de pescado." data-html="true" rel="tooltip" href="#">
                  <div class="outer-circle">
                    <div class="inner-circle">
                    </div>
                  </div>
                </a>
            </div>
          <div class="tooltip-container">
            <a class="map-point atooltip" style="top: 42.5%; left: 77%;" title="<strong>Taipéi: </strong>Uvas frescas, maca espárragos, arándanos, granadas, café de especialidad, pota." data-html="true" rel="tooltip" href="#">
                <div class="outer-circle">
                  <div class="inner-circle">
                  </div>
                </div>
              </a>
          </div>
          <div class="tooltip-container">
            <a class="map-point atooltip" style="top: 40%;left: 52.5%;" title="<strong>Estambul: </strong>Café de especialidad, espárragos, alcachofas en conserva, paltas, pisco, frutas frescas, productos libre de gluten, quinua, kiwicha, granos andinos, súper foods." data-html="true" rel="tooltip" href="#">
                <div class="outer-circle">
                  <div class="inner-circle">
                  </div>
                </div>
              </a>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-xs-12 col-nopadding">
        <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
        <div class="col-md-8 col-sm-8 col-xs-12 col-nopadding lista-paises-container">
          <div class="col-md-12 col-xs-12 col-nopadding lista-paises">
            <div class="col-md-1 col-xs-2 col-nopadding">
              <div class="paises-mapa">
                <img src="images/alemania-copy.png" alt="Alemania" class="image-responsive">
              </div>
            </div>
            <div class="col-md-1 hidden-xs espacio"></div>
            <div class="col-md-10 col-xs-10 col-nopadding cont-der">
              <div class="">
                  <div class="col-md-12 col-xs-12 pais-titulo">
                    <ul class=" list-unstyled list-directorio" id="list-directorio">
                      <li>
                        <div class="col-md-9 col-xs-7 col-nopadding pais-container">
                          <span class="titulo14">Alemania</span>
                        </div>
                        <div class="col-md-3 col-xs-5 contenidodirectorio text-right col-nopadding">
                          <span class="btn-vermas">ver más</span>
                          <i class="fa fa-plus fa-lg ico-vermas" aria-hidden="true"></i>
                        </div>
                        <ul class="list-subdirectorio list-unstyled col-md-12 col-xs-12 col-nopadding lista-ciudades" style="display: none">
                          <li>
                            <div class="ciudades-container">
                              <p class=""><span class="ciudad">Hamburgo:</span> Granos andinos, quinua, kiwicha, paiche.</p>
                            </div>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </div>
              </div>
            </div>
          </div>
        <div class="col-md-12 col-xs-12 col-nopadding lista-paises">
          <div class="col-md-1 col-xs-2 col-nopadding">
            <div class="paises-mapa">
              <img src="images/brasil-copy.png" alt="Bandera Brasil" class="image-responsive">
            </div>
          </div>
          <div class="col-md-1 hidden-xs espacio"></div>
          <div class="col-md-10 col-xs-10 cont-der col-nopadding">
            <div class="">
              <div class="col-md-12 col-xs-12 pais-titulo">
                <ul class=" list-unstyled list-directorio" id="list-directorio">
                  <li>
                    <div class="col-md-9 col-xs-7 col-nopadding pais-container">
                      <span class="titulo14">Brasil</span>
                    </div>
                    <div class="col-md-3 col-xs-5 contenidodirectorio text-right col-nopadding">
                      <span class="btn-vermas">ver más</span>
                      <i class="fa fa-plus fa-lg ico-vermas" aria-hidden="true"></i>
                    </div>
                    <ul class="list-subdirectorio list-unstyled col-md-12 col-xs-12 col-nopadding lista-ciudades" style="display: none">
                      <li>
                        <div class="ciudades-container">
                          <p class=""><span class="ciudad">Sao Paulo: </span>Quinua, orégano, aceitunas, mandarinas, cítricos, trucha, anchoveta en conserva.</p>
                        </div>
                      </li>
                    </ul>
                    </li>
                  </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-xs-12 col-nopadding lista-paises">
          <div class="col-md-1 col-xs-2 col-nopadding">
            <div class="paises-mapa">
              <img src="images/china-copy.png" alt="Bandera China" class="image-responsive">
            </div>
          </div>
          <div class="col-md-1 hidden-xs espacio"></div>
          <div class="col-md-10 col-xs-10 cont-der col-nopadding">
            <div class="">
              <div class="col-md-12 col-xs-12 pais-titulo">
                <ul class=" list-unstyled list-directorio" id="list-directorio">
                  <li>
                    <div class="col-md-9 col-xs-7 col-nopadding pais-container">
                      <span class="titulo14">China</span>
                    </div>
                    <div class="col-md-3 col-xs-5 contenidodirectorio text-right col-nopadding">
                      <span class="btn-vermas">ver más</span>
                      <i class="fa fa-plus fa-lg ico-vermas" aria-hidden="true"></i>
                    </div>
                      <ul class="list-subdirectorio list-unstyled col-md-12 col-xs-12 col-nopadding lista-ciudades" style="display: none">
                        <li>
                          <div class="ciudades-container">
                            <p class=""><span class="ciudad">Beijing: </span> Pota congelada, anguila congelada, trucha, jibias, langostinos, paiche, uvas frescas, paltas, mangos, cítricos, espárragos, mangos.</p>
                          </div>
                        </li>
                      </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-xs-12 col-nopadding lista-paises">
            <div class="col-md-1 col-xs-2 col-nopadding">
              <div class="paises-mapa">
                <img src="images/corea-sur-copy.png" alt="Corea del Sur" class="image-responsive">
              </div>
            </div>
            <div class="col-md-1 hidden-xs espacio"></div>
            <div class="col-md-10 col-xs-10 cont-der col-nopadding">
              <div class="">
                <div class="col-md-12 col-xs-12 pais-titulo">
                  <ul class=" list-unstyled list-directorio" id="list-directorio">
                    <li>
                      <div class="col-md-9 col-xs-7 col-nopadding pais-container">
                        <span class="titulo14">Corea del Sur</span>
                      </div>
                      <div class="col-md-3 col-xs-5 contenidodirectorio text-right col-nopadding">
                        <span class="btn-vermas">ver más</span>
                        <i class="fa fa-plus fa-lg ico-vermas" aria-hidden="true"></i>
                      </div>
                      <ul class="list-subdirectorio list-unstyled col-md-12 col-xs-12 col-nopadding lista-ciudades" style="display: none">
                        <li>
                          <div class="ciudades-container">
                            <p class=""><span class="ciudad">Seúl:</span> Quinua (pre cocida o tostada), frutas frescas, uvas, mangos, arándanos, paltas, pota, anguila, langostinos, café de especialidad.</p>
                          </div>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-xs-12 col-nopadding lista-paises">
            <div class="col-md-1 col-xs-2 col-nopadding">
              <div class="paises-mapa">
                <img src="images/emiratos-copy.png" alt="Emiratos Árabes Unidos" class="image-responsive">
              </div>
            </div>
            <div class="col-md-1 hidden-xs espacio"></div>
            <div class="col-md-10 col-xs-10 cont-der col-nopadding">
              <div class="">
                <div class="col-md-12 col-xs-12 pais-titulo">
                  <ul class=" list-unstyled list-directorio" id="list-directorio">
                    <li>
                      <div class="col-md-9 col-xs-7 col-nopadding pais-container">
                        <span class="titulo14">Emiratos Árabes Unidos</span>
                      </div>
                      <div class="col-md-3 col-xs-5 contenidodirectorio text-right col-nopadding">
                        <span class="btn-vermas">ver más</span>
                        <i class="fa fa-plus fa-lg ico-vermas" aria-hidden="true"></i>
                      </div>
                      <ul class="list-subdirectorio list-unstyled col-md-12 col-xs-12 col-nopadding lista-ciudades" style="display: none">
                        <li>
                          <div class="ciudades-container">
                            <p class=""><span class="ciudad">Dubái: </span>Granos andinos en diversas presentaciones, uvas frescas, paiche, conchas de abanico, camarones, productos orgánicos.</p>
                          </div>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-xs-12 col-nopadding lista-paises">
              <div class="col-md-1 col-xs-2 col-nopadding">
                <div class="paises-mapa">
                  <img src="images/estados-unidos-copy.png" alt="Estados Unidos" class="image-responsive">
                </div>
              </div>
              <div class="col-md-1 hidden-xs espacio"></div>
              <div class="col-md-10 col-xs-10 cont-der col-nopadding">
                <div class="">
                  <div class="col-md-12 col-xs-12 pais-titulo">
                    <ul class=" list-unstyled list-directorio" id="list-directorio">
                      <li>
                        <div class="col-md-9 col-xs-7 col-nopadding pais-container">
                          <span class="titulo14">Estados Unidos</span>
                        </div>
                        <div class="col-md-3 col-xs-5 contenidodirectorio text-right col-nopadding">
                          <span class="btn-vermas">ver más</span>
                          <i class="fa fa-plus fa-lg ico-vermas" aria-hidden="true"></i>
                        </div>
                        <ul class="list-subdirectorio list-unstyled col-md-12 col-xs-12 col-nopadding lista-ciudades" style="display: none">
                          <li>
                            <div class="ciudades-container">
                              <p class=""><span class="ciudad">Miami: </span>Productos "ready to eat", productos naturales.</p>
                            </div>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          <div class="col-md-12 col-xs-12 col-nopadding lista-paises">
              <div class="col-md-1 col-xs-2 col-nopadding">
                <div class="paises-mapa">
                  <img src="images/holanda-copy.png" alt="Holanda" class="image-responsive">
                </div>
              </div>
              <div class="col-md-1 hidden-xs espacio"></div>
              <div class="col-md-10 col-xs-10 cont-der col-nopadding">
                <div class="">
                  <div class="col-md-12 col-xs-12 pais-titulo">
                    <ul class=" list-unstyled list-directorio" id="list-directorio">
                      <li>
                        <div class="col-md-9 col-xs-7 col-nopadding pais-container">
                          <span class="titulo14">Holanda</span>
                        </div>
                        <div class="col-md-3 col-xs-5 contenidodirectorio text-right col-nopadding">
                          <span class="btn-vermas">ver más</span>
                          <i class="fa fa-plus fa-lg ico-vermas" aria-hidden="true"></i>
                        </div>
                          <ul class="list-subdirectorio list-unstyled col-md-12 col-xs-12 col-nopadding lista-ciudades" style="display: none">
                            <li>
                              <div class="ciudades-container">
                                <p class=""><span class="ciudad">Amsterdam: </span>Frutas exóticas, lúcuma, maracuyá, maca.</p>
                              </div>
                            </li>
                          </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-xs-12 col-nopadding lista-paises">
                <div class="col-md-1 col-xs-2 col-nopadding">
                  <div class="paises-mapa">
                    <img src="images/india-copy.png" alt="India" class="image-responsive">
                  </div>
                </div>
                <div class="col-md-1 hidden-xs espacio"></div>
                <div class="col-md-10 col-xs-10 cont-der col-nopadding">
                  <div class="">
                    <div class="col-md-12 col-xs-12 pais-titulo">
                      <ul class=" list-unstyled list-directorio" id="list-directorio">
                        <li>
                          <div class="col-md-9 col-xs-7 col-nopadding pais-container">
                            <span class="titulo14">India</span>
                          </div>
                          <div class="col-md-3 col-xs-5 contenidodirectorio text-right col-nopadding">
                            <span class="btn-vermas">ver más</span>
                            <i class="fa fa-plus fa-lg ico-vermas" aria-hidden="true"></i>
                          </div>
                          <ul class="list-subdirectorio list-unstyled col-md-12 col-xs-12 col-nopadding lista-ciudades" style="display: none">
                            <li>
                              <div class="ciudades-container">
                                <p class=""><span class="ciudad">Nueva Delhi: </span>Cacao, café, frejoles, quinua, pisco, uvas frescas.</p>
                              </div>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-xs-12 col-nopadding lista-paises">
                <div class="col-md-1 col-xs-2 col-nopadding">
                  <div class="paises-mapa">
                    <img src="images/indonesia-copy.png" alt="Indonesia" class="image-responsive">
                  </div>
                </div>
                <div class="col-md-1 hidden-xs espacio"></div>
                <div class="col-md-10 col-xs-10 cont-der col-nopadding">
                  <div class="">
                      <div class="col-md-12 col-xs-12 pais-titulo">
                        <ul class=" list-unstyled list-directorio" id="list-directorio">
                          <li>
                            <div class="col-md-9 col-xs-7 col-nopadding pais-container">
                              <span class="titulo14">Indonesia</span>
                            </div>
                            <div class="col-md-3 col-xs-5 contenidodirectorio text-right col-nopadding">
                              <span class="btn-vermas">ver más</span>
                              <i class="fa fa-plus fa-lg ico-vermas" aria-hidden="true"></i>
                            </div>
                            <ul class="list-subdirectorio list-unstyled col-md-12 col-xs-12 col-nopadding lista-ciudades" style="display: none">
                              <li>
                                <div class="ciudades-container">
                                  <p class=""><span class="ciudad">Jacarta: </span>Uvas frescas, súper foods, quinua, maca, paiche.</p>
                                </div>
                              </li>
                            </ul>
                          </li>
                        </ul>
                      </div>
                  </div>
                </div>
              </div>
      <div class="col-md-12 col-xs-12 col-nopadding lista-paises">
        <div class="col-md-1 col-xs-2 col-nopadding">
          <div class="paises-mapa">
            <img src="images/panama-copy.png" alt="Panamá" class="image-responsive">
          </div>
        </div>
        <div class="col-md-1 hidden-xs espacio"></div>
        <div class="col-md-10 col-xs-10 cont-der col-nopadding">
          <div class="">
            <div class="col-md-12 col-xs-12 pais-titulo">
              <ul class=" list-unstyled list-directorio" id="list-directorio">
                <li>
                  <div class="col-md-9 col-xs-7 col-nopadding pais-container">
                    <span class="titulo14">Panamá</span>
                  </div>
                  <div class="col-md-3 col-xs-5 contenidodirectorio text-right col-nopadding">
                    <span class="btn-vermas">ver más</span>
                    <i class="fa fa-plus fa-lg ico-vermas" aria-hidden="true"></i>
                  </div>
                  <ul class="list-subdirectorio list-unstyled col-md-12 col-xs-12 col-nopadding lista-ciudades" style="display: none">
                    <li>
                      <div class="ciudades-container">
                        <p class=""><span class="ciudad">Ciudad de Panamá: </span>Pota , maca, sacha inchi, pisco.</p>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-xs-12 col-nopadding lista-paises">
          <div class="col-md-1 col-xs-2 col-nopadding">
            <div class="paises-mapa">
              <img src="images/rusia-copy.png" alt="Rusia" class="image-responsive">
            </div>
          </div>
          <div class="col-md-1 hidden-xs espacio"></div>
          <div class="col-md-10 col-xs-10 cont-der col-nopadding">
            <div class="">
                <div class="col-md-12 col-xs-12 pais-titulo">
                  <ul class=" list-unstyled list-directorio" id="list-directorio">
                    <li>
                      <div class="col-md-9 col-xs-7 col-nopadding pais-container">
                        <span class="titulo14">Rusia</span>
                      </div>
                      <div class="col-md-3 col-xs-5 contenidodirectorio text-right col-nopadding">
                        <span class="btn-vermas">ver más</span>
                        <i class="fa fa-plus fa-lg ico-vermas" aria-hidden="true"></i>
                      </div>
                        <ul class="list-subdirectorio list-unstyled col-md-12 col-xs-12 col-nopadding lista-ciudades" style="display: none">
                          <li>
                            <div class="ciudades-container">
                              <p class=""><span class="ciudad">Moscú: </span>Moscú: Uvas frescas, mariscos, conservas de pescado.</p>
                            </div>
                          </li>
                        </ul>
                    </li>
                  </ul>
                </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-xs-12 col-nopadding lista-paises">
          <div class="col-md-1 col-xs-2 col-nopadding">
            <div class="paises-mapa">
              <img src="images/taiwan-copy.png" alt="Taiwán" class="image-responsive">
            </div>
          </div>
          <div class="col-md-1 hidden-xs espacio"></div>
          <div class="col-md-10 col-xs-10 cont-der col-nopadding">
            <div class="">
                <div class="col-md-12 col-xs-12 pais-titulo">
                  <ul class=" list-unstyled list-directorio" id="list-directorio">
                    <li>
                      <div class="col-md-9 col-xs-7 col-nopadding pais-container">
                        <span class="titulo14">Taiwán</span>
                      </div>
                      <div class="col-md-3 col-xs-5 contenidodirectorio text-right col-nopadding">
                        <span class="btn-vermas">ver más</span>
                        <i class="fa fa-plus fa-lg ico-vermas" aria-hidden="true"></i>
                      </div>
                         <ul class="list-subdirectorio list-unstyled col-md-12 col-xs-12 col-nopadding lista-ciudades" style="display: none">
                          <li>
                            <div class="ciudades-container">
                              <p class=""><span class="ciudad">Taipéi: </span>Uvas frescas, maca espárragos, arándanos, granadas, café de especialidad, pota.</p>
                            </div>
                          </li>
                        </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-xs-12 col-nopadding lista-paises">
              <div class="col-md-1 col-xs-2 col-nopadding">
                <div class="paises-mapa">
                  <img src="images/turquia-copy.png" alt="Turquía" class="image-responsive">
                </div>
              </div>
              <div class="col-md-1 hidden-xs espacio"></div>
              <div class="col-md-10 col-xs-10 cont-der col-nopadding">
                <div class="">
                  <div class="col-md-12 col-xs-12 pais-titulo">
                    <ul class=" list-unstyled list-directorio" id="list-directorio">
                      <li>
                        <div class="col-md-9 col-xs-7 col-nopadding pais-container">
                          <span class="titulo14">Turquía</span>
                        </div>
                        <div class="col-md-3 col-xs-5 contenidodirectorio text-right col-nopadding">
                          <span class="btn-vermas">ver más</span>
                          <i class="fa fa-plus fa-lg ico-vermas" aria-hidden="true"></i>
                        </div>
                          <ul class="list-subdirectorio list-unstyled col-md-12 col-xs-12 col-nopadding lista-ciudades" style="display: none">
                            <li>
                              <div class="ciudades-container">
                                <p class=""><span class="ciudad">Estambul: </span>Café de especialidad, espárragos, alcachofas en conserva, paltas, pisco, frutas frescas, productos libre de gluten, quinua, kiwicha, granos andinos, súper foods.</p>
                              </div>
                            </li>
                          </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2 col-sm-2 hidden-xs col-nopadding"></div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      var vermas= "{!!trans('contenido.nosotros_vermas')!!}";
      var vermenos= "{!!trans('contenido.nosotros_vermenos')!!}";
    </script>
@endsection
