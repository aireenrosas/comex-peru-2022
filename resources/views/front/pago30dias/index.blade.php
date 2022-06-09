@extends('app.app')
<?php
$ogdescription = 'ComexPerú es el gremio privado que agrupa a las principales empresas vinculadas al Comercio Exterior en el Perú.';
$ogimage = '';
$ogtitle = 'COMEX - Sociedad de Comercio Exterior del Perú - Inicio';
$ogurl = url('/');
?>
@section('style')
<!-- Aquí van las hojas de estilos que sean propias para nosotros.blade.php-->
<link href="<?php echo URL::asset('css/nosotros.css'); ?>" rel="stylesheet" type="text/css" />
@endsection
@section('script')
<!-- Aquí van los js propios para nosotros.blade-->
<script src="<?php echo URL::asset('js/listas.js'); ?>" type="text/javascript"></script>
@endsection

@section('content')
<div class="container-comex">
  <div class="nosotroscont">
      <div class="col-md-12 col-xs-12 leftcero rightcero">
        <div class="col-md-2 col-sm-2 hidden-xs"></div>
        <div class="col-md-8 col-sm-8 col-xs-12 leftcero rightcero ancho intro">

            <h1 style="font-family: 'Roboto',sans-serif; font-size: 30px; text-align: left; color: #434343;">Compromiso Voluntario Pago a MYPES</h1>
            <br><br>
            <p style="font-size: 10pt; font-family: Arial; color: #000000; line-height: 1.38; text-align: justify;">En el marco de la XIV edición de la Cumbre PYME del APEC, organizada por ComexPerú con el apoyo de la Asociación PYME Perú, anunciamos una nueva práctica empresarial por la cual distintos asociados y aliados asumen el compromiso voluntario de pago como máximo a 30 días para sus Mypes proveedoras. Este compromiso contribuirá a impulsar la recuperación y sostenibilidad de las Mypes, mejorando sus flujos de efectivo.</p>
            <p style="font-size: 10pt; font-family: Arial; color: #000000; line-height: 1.38; text-align: justify;">Algunas empresas ya lo tienen implementado y, antes de fin de año, todas habrán establecido procesos que garanticen el pago a sus Mypes proveedoras en un plazo no mayor a 30 días. Ello, permitirá dinamizar el sector emprendedor e incentivar a las pequeñas empresas a insertarse en encadenamientos empresariales que generan mejores oportunidades para todos y un crecimiento más inclusivo. El compromiso está abierto a todas las empresas grandes y medianas que quieran participar, si desea sumarse a esta iniciativa por favor llene el <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=V1EJyTgehUufqW0GHOErMHyXCua-0rtGoelzV9dJQUZUNUJKM0FWWlBTWk1aNVhFNzRTVVk3MDBJWC4u" target="_blank">siguiente formulario</a> y lo contactaremos. </p>
            <p style="font-size: 10pt; font-family: Arial; color: #000000; line-height: 1.38; text-align: justify;">¡Las empresas toman acción y son parte de la solución!</p>
            <p style="font-size: 10pt; font-family: Arial; color: #000000; line-height: 1.38; text-align: justify;">Agradecemos a las siguientes empresas por acompañarnos y comprometerse con el desarrollo de nuestras mypes:</p>

            <ul style="margin: 0 !important; padding: 0 !important;">
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/acp-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/apoyo-consultoria-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/austral-group-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/banco-falabella-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/bcp-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/casa-andina-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/cerro-verde-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/crediscotia-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/fargo-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/ferreycorp-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/ferrenergy-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/ferreyros-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/forbis-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/icp-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/inkafarma-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/interbank-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/interseguro-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/la-rambla-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/latam-airlines-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/makro-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/mall-plaza-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/mass-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/maquinarias-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/mi-banco-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/mi-farma-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/oechsle-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/open-plaza-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/orvisa-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/pacifico-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/parque-arauco-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/plaza-vea-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/prima-afp-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/promart-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/pwc-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/qali-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/qroma-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/real-plaza-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/rimac-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/ripley-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/saga-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/scotiabank-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/sitech-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/sodimac-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/talma-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/tasa-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/tottus-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/unimaq-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/urbanova-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/utp-logo.jpg"></li>
              <li style="display: inline;"><img style="max-width: 170px;" src="https://www.comexperu.org.pe/images/pago30dias-logos/vivanda-logo.jpg"></li>

            </ul>

            <!-- p style="font-size: 10pt; font-family: Arial; color: #000000; line-height: 1.38; text-align: justify;">Si su empresa desea sumarse a esta iniciativa asumiendo este compromiso voluntario favor contactarse con <a href="mailto:comexperu@comexperu.org.pe">comexperu@comexperu.org.pe</a></p -->
            <!-- p style="font-size: 10pt; font-family: Arial; color: #000000; line-height: 1.38; text-align: justify;">¡Las empresas toman acción y son parte de la solución!</p --><br><br>


      </div>



  
    </div>
  </div>



</div>

<!-- div class="modal fade" tabindex="-1" role="dialog" id="popup" data-show="true">
    <div class="modal-dialog" role="document" style="height: auto">
      <div class="modal-content">
        <div class="modal-body" style="padding:0px">
          <iframe width="640px" height= "480px" src= "https://forms.office.com/Pages/ResponsePage.aspx?id=V1EJyTgehUufqW0GHOErMHyXCua-0rtGoelzV9dJQUZUNUJKM0FWWlBTWk1aNVhFNzRTVVk3MDBJWC4u&embed=true" frameborder= "0" marginwidth= "0" marginheight= "0" style= "border: none; max-width:100%; max-height:100vh" allowfullscreen webkitallowfullscreen mozallowfullscreen msallowfullscreen> </iframe>
        </div>
      </div>
    </div>
  </div -->

<!-- script type="text/javascript">
    $( function(){
        $('#popup').modal();
    } )
</script -->

  <script type="text/javascript">
    var vermas= "{!!trans('contenido.nosotros_vermas')!!}";
    var vermenos= "{!!trans('contenido.nosotros_vermenos')!!}";
  </script>



@endsection
