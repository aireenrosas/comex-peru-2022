<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
  <html lang="en">
  <head><!-- BEGIN HEAD -->
  <meta charset="utf-8" />
  <!-- D.S. viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- fin D.S. viewport -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="robots" content="index, follow">
  <title>ComexPerú - Sociedad de Comercio Exterior del Perú</title>
  <meta name="keywords" content="ComexPeru, peru, comercio exterior, exportacion, importación">
  <meta name="description" content="ComexPeru es el gremio privado que agrupa a las principales empresas vinculadas al Comercio Exterior en el Perú.">
  <meta property="og:site_name" content="COMEX - Sociedad de Comercio Exterior del Perú">
  <meta property="og:title" content="COMEX - Sociedad de Comercio Exterior del Perú - Inicio">
  <meta property="og:description" content="ComexPeru es el gremio privado que agrupa a las principales empresas vinculadas al Comercio Exterior en el Perú.">
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <meta content="author" name="Studio Tigres"/>
  <meta content="{{csrf_token()}}" name="csrf-token"/>
  <!--<link rel="shortcut icon" href="{!!url('/images/atsalogo-favi.png')!!}" /> colocar aquí favicon-->

  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <!--BEGIN SCRIPTS-->
  <script src="<?php echo URL::asset('assets/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
  <!--END SCRIPTS-->

  <!--BEGIN CSS PLUGGINS-->
  <link href="<?php echo URL::asset('assets/global/plugins/jquery-ui/jquery-ui.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo URL::asset('assets/global/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo URL::asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo URL::asset('assets/global/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo URL::asset('assets/global/plugins/select2/css/select2.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo URL::asset('assets/global/plugins/select2/css/select2-bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo URL::asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css'); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo URL::asset('assets/global/plugins/bootstrap-summernote/summernote.css'); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo URL::asset('css/sweetalert.css'); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo URL::asset('assets/global/plugins/datatables/datatables.min.css'); ?>" rel="stylesheet" type="text/css">
  <!--END CSS PLUGGINS-->

  <!--BEGIN GLOBAL STYLE-->
  <link href="<?php echo URL::asset('css/style.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo URL::asset('css/style-admin.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo URL::asset('css/main.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo URL::asset('css/footer.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo URL::asset('css/media-queries.css'); ?>" rel="stylesheet" type="text/css" />
  <script src="<?php echo URL::asset('assets/global/plugins/select2/js/select2.full.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo URL::asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo URL::asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo URL::asset('js/sweetalert.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo URL::asset('assets/global/plugins/bootstrap-summernote/summernote.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo URL::asset('assets/global/plugins/datatables/datatables.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo URL::asset('js/jqDoubleScroll.js'); ?>" type="text/javascript"></script>

  <!--END GLOBAL STYLE-->
  <script>
    var url = "{!! url('/') !!}";
  </script>
  @yield('style')
  </head> <!-- END HEAD -->
    <body class="fondo-body">
      <style>
      .btn-success{
        background-color: #ca0538!important;
        border-color: #ca0538!important;
      }
      </style>
        @include('front.includes.header-admin')
        <div class="wrapper" id="wrapper">
        <!-- Page content -->
        <div id="page-content-wrapper" class="page-content-wrapper">
          <div class="page-content">
            <div class="container-fluid">
              <div class="contenido">
                <div  class="row">
                  <div class="col-md-12 col-xs-12" style="padding: 0">
                    <div class="" >
                      <div class="col-md-12 col-xs-12 col-nopadding">
                        <div class="boletin ocultar" id="boletinD">
                          <div class="col-md-6 col-nopadding">
                            <p class="aviso-boletin">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                          </div>
                          <div class="col-md-5 col-nopadding">
                            <div class="search-box">
                              <form action="" method="GET">
                                <div class="input-group-btn">
                                  <div class="input-group">
                                    <input type="text" class="form-control home-input-search" placeholder="">
                                    <span class="input-group-btn fondo-rojo">
                                      <button class="btn btn-secondary fondo-rojo border-cero"><span class="text-blanco">SUSCRIBETE</span></button>
                                    </span>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                          <div class="col-md-1 col-nopadding pull-right">
                            <i class="glyphicon glyphicon-remove-sign icon-boletin"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--boletin-->
                    @yield('content')
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-container">
      @include('front.includes.footer-admin')
      </div>
    </body>
    <script type="text/javascript">
      var keyApi = '{{env('VAPID_PUBLIC_KEY')}}';
      // var keyApi = 'BNBwEuMY8QZywt7oVndaGEnO2iYXAE/wdgQQ2ia7cGJlNoCRhQUWF1nUSFL9kIMEA1t9xAXwOomPxIesE2+fjEA=';
    </script>
    <script src="<?php echo URL::asset('assets/global/plugins/jquery-ui/jquery-ui.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo URL::asset('assets/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo URL::asset('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo URL::asset('js/main.js'); ?>" type="text/javascript"></script>
     @yield('script')
     <script>
       if (window.matchMedia('(display-mode: standalone)').matches) {
         $('.homescreen').css('display','none');
         $('.fab__push').css('display','flex');
        }

        var attachMobileSafariAddressBarHelpTip = function (target) {
          var $target = $(target);
          $target.tooltip({
              title: 'Scroll up to hide Safari address bar',
              trigger: 'manual',
              placement: 'bottom'
          });
          $(window).on('resize', function () {
              var bodyHeight = document.body.offsetHeight;
              var windowHeight = window.innerHeight;
              var isLandscape = Math.abs(window.orientation) === 90;
              var showTooltip = (windowHeight < bodyHeight);
              if(!isLandscape) return;
              $target.tooltip(showTooltip ? 'show' : 'hide');
          });
        }
        var ua = window.navigator.userAgent;
        if(ua.indexOf('iPhone') !== -1 && ua.indexOf('Safari') !== -1) {
            attachMobileSafariAddressBarHelpTip('.navbar');
        }
     </script>
</html>
