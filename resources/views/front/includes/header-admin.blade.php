<div class="header header-admin container-fluid col-nopadding">
  <div class="row">
    <div class="col-md-12 col-xs-12 col-noppading">
      <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" id="menu-toggle" class="navbar-toggle navbar-left btn-menu toggle" title="menu">
            <span class="sr-only">Toggle navigation</span>
            <span class="menu-label">{!!trans('contenido.menu')!!}</span>
            <span class="icon-bar bar-one"></span>
            <span class="icon-bar bar-two"></span>
            <span class="icon-bar bar-three"></span>
          </button>
          <div class="navbar-right">
            <div class="form-horizontal">
              <span data-toggle="" data-parent="#menu-group-8" href="#sub-item-12" class="menu-login" id="titulo">
                {!!trans('contenido.bienvenido')!!}, {{Auth::user()->name}}
                <img src="{{url('images/usuario.png')}}" alt="Login Icono" class="img-login">
              </span>
              <ul class="collapse formulario list-unstyled dropdown-menu" id="sub-item-12">
                <li class="btn-salir-container">
                  @if(Auth::user()->rol_id==6)
                  <a class="btn-salir" title="Panel control" href="{{ url('/') }}">
                      Home
                  </a>
                  @endif
                </li>
                <li class="btn-salir-container">
                  <a class="btn-salir" title="Cerrar Sesión" href="{{ url('/salir') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                      SALIR
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:block;">
                      {{ csrf_field() }}
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- Sidebar -->
        <div id="sidebar-wrapper" class="sidebar-wrapper">
          <nav id="spy">
          <div class="sidebar-nav nav">
            <div class="contenido-menu">
              <div class="logo-container">
                <a href="{{ url("/") }}"><img src="{!!url('/images/logo-nuevo.svg')!!}" alt="Comex Logo" class="img-responsive comex-logo-color"></a>
              </div>
              <ul class="nav navbar-nav navbar-links">
                <li><a href="{{ url("admin/articulos") }}">ARTICULOS</a></li>
                <li><a href="{{ url("admin/publicaciones") }}">PUBLICACIONES</a></li>
                <li><a href="{{ url("admin/tags") }}">TAGS</a></li>
                <li><a href="{{ url("admin/seminars") }}">SEMINARIOS</a></li>
                <li><a href="{{ url("admin/cumbres") }}">CUMBRES</a></li>
                <li><a href="{{ url("admin/usuarios") }}">USUARIOS</a></li>
                <li><a href="{{ url("admin/empresas") }}">EMPRESAS</a></li>
                <li><a href="{{ url("admin/sliders") }}">SLIDERS</a></li>
                <li><a href="{{ url("admin/suscriptores") }}">SUSCRIPTORES</a></li>
                <li><a href="{{ url("admin/datacomexsubcripciones") }}">SUSCRIPTORES DATACOMEX</a></li>
                <li><a href="{{ url("admin/semanariosubcripciones") }}">SUSCRIPTORES SEMANARIO</a></li>
                <li><a href="{{ url("admin/negociossubcripciones") }}">SUSCRIPTORES NEGOCIOS</a></li>
                <li><a href="{{ url("admin/contactos") }}">CONTACTO</a></li>
                <li><a href="{{ url("admin/enviarnotificaciones") }}">ENVIAR NOTIFICACIONES</a></li>
                <li><a href="{{ url("admin/inscripciones") }}">INSCRIPCIONES</a></li>
                <li><a href="{{ url("admin/obstaculosalcomercio") }}">OBSTÁCULOS AL COMERCIO</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-login" style="display:none">
                <li class="link-login">
                  <a href="#collapseExample" type="button" id="login-toggle" class="form-horizontal-responsive" data-toggle="dropdown">
                    <span class="menu-login" id="titulo">
                      <img src="{!!url('/images/usuario-white.png')!!}" alt="Login Icono" class="img-login">
                      LOGIN
                    </span>
                  </a>
                </li>
              </ul>
              {{-- <ul class="nav navbar-nav navbar-languages">
                <li>
                  <p class="navbar-btn"><a class="btn-esp lang-selection active" data-lang="es">ES</a></p>
                </li>
                <li>
                  <p class="navbar-btn"><a class="btn-eng lang-selection" data-lang="en">EN</a></p>
                </li>
              </ul> --}}
              <ul class="nav navbar-nav navbar-socialmedia">
                <li>
                  <p class="navbar-btn"><a class="btn-facebook" href="https://www.facebook.com/comexperu" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></p>
                </li>
                <li>
                  <p class="navbar-btn"><a class="btn-youtube" href="https://www.youtube.com/user/comexperutv" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></p>
                </li>
              </ul>
            </div>

          </div>
          </nav>
        </div>
      </nav>
    </div>
  </div>
</div>
@if(\Session::has('language'))
  @if(\Session::get('language')=='en')
    <script>
      $('.lang-selection').removeClass('active');
      $('.btn-eng').addClass('active');
    </script>
  @else
    <script>
      $('.lang-selection').removeClass('active');
      $('.btn-esp').addClass('active');
    </script>
  @endif
@endif
