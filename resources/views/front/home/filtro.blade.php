<div class="row row-nomargin">
  <div class="col-md-12 col-nopadding">
    <div class="col-md-2 hidden-sm col-nopadding"></div>
    <div class="col-md-8 col-xs-12 col-nopadding">
      <div class="filtro-contenido">
        <div class="row row-nomargin">
            <div class="col-md-12 col-xs-12 nopadding">
              <div class="row row-nomargin">
                <div class="col-md-12 col-xs-12">
                  <div class="home-col-search">
                      <div class="input-group col-md-10 col-xs-12 search">
                        <label for="search-input">
                          <i class="fa fa-search search-icon" aria-hidden="true"></i>
                          <span class="sr-only">Search icons</span>
                        </label>
                        <input type="text" class="form-control home-input-search filtro-central" placeholder="{!!trans('contenido.placeholder_filtro')!!}" name="keyword" value="<?php
                        if(isset($request)){echo $request->input('keyword');}
                        ?>">
                      </div>
                  </div>
                </div>
              </div>

              <div class="row row-nomargin">
                <div class="col-md-12 col-xs-12 nopadding contenedorTag" id="contenedorTag">
                  <ul class="filtros">

                  </ul>
                </div>
              </div>

              <div class="row row-nomargin">
                <div class="hidden-lg hidden-md hidden-sm col-xs-12 col-nopadding text12-responsive">
                  {!!trans('contenido.buscar_tags')!!}
                </div>
              </div>
              <div class="row row-nomargin">
                <div class="col-md-12 col-xs-12 nopadding">
                  <div class="select-responsive dropdown" role="group">
                    <button type="button" class="btn dropdown-toggle btn-select-tags hidden-lg hidden-md hidden-sm lista-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {!!trans('contenido.seleccionar_tags')!!}
                      <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                    </button>
                    <ul class="filtro-lista">
                    <?php $i=0 ?>
                      @foreach ($tags as $key)   
                        @if ($i <= 10) 
                          <li class="filtro-li {{$key['active']}}" data-id="{{$key['id']}}">
                            <div class="filtro-tag-cont">
                                  <span class="tag-close">X</span><p class="tag-paragraph">{{$key['name']}}</p>
                            </div>
                          </li> 
                        @else                         
                          <li class="filtro-li {{$key['active']}} hidden" data-id="{{$key['id']}}" data-count="{{$i}}">
                            <div class="filtro-tag-cont">
                                  <span class="tag-close">X</span><p class="tag-paragraph">{{$key['name']}}</p>
                            </div>
                          </li>
                        @endif                       
                        <?php $i++ ?>
                      @endforeach
                      <button class="home-button" onclick="showTags()"> VER MAS </button>
                    </ul>
                  </div>
                </div>
              </div>
              <hr class="home-division hidden-xs">
              <div class="row row-nomargin row-filtro-revista">
                <div class=" col-md-1 col-sm-2 hidden-xs home-col-ver-filtro" >
                  <span class="home-ver">{!!trans('contenido.ver_en')!!}</span>
                </div>
                <div class="col-md-11 col-sm-10 col-xs-12 nopadding">
                  <div class="select-responsive dropdown" role="group">
                    <button type="button" class="btn dropdown-toggle btn-select-tags hidden-lg hidden-md hidden-sm filtro-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      {!!trans('contenido.seleccionar_revistas')!!}
                      <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                    </button>
                    <ul class="lista-ver">
                      @foreach ($categories as $key)
                        <li class="lista-ve-li {{$key['active']}}" data-id="{{$key['id']}}">
                          <div class="filtro-tag-cont">
                                <span class="tag-close">X</span><p class="tag-paragraph">{{$key['name']}}</p>
                          </div>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
              <hr class="home-division division-bajo hidden-xs">
              <div class="row home-row-button row-nomargin">
                <div class="col-md-12 col-nopadding">
                  <a class="home-button-buscar" href="#ancla" data-ancla="ancla"><i class="fa fa-search fa-md ico-buscador" aria-hidden="true" href="#"></i> {!!trans('contenido.buscar')!!}</a>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function showTags() {
 $(".filtro-li").removeClass("hidden");  
}
</script>
