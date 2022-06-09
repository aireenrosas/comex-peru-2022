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
    <div class="obstaculoscont">
      <div class="row row-nomargin">
        <div class="col-md-12 col-xs-12 col-nopadding">
          <div class="col-md-1 col-sm-1 hidden-xs"></div>
          <div class="col-md-10 col-xs-12 col-nopadding">
            <div class="col-md-12 col-xs-12 col-nopadding">
              <div class="col-md-4 col-sm-4 col-xs-12 col-nopadding">
                <h2 class="obtaculos-titulo">Dun & Bradstreet</h2>
              </div>
              <div class="col-md-8 col-sm-8 col-xs-12 col-nopadding cont-der">
                <p class="obtaculos-parrafo">
                    ComexPerú ha firmado un convenio con Dun & Bradstreet (D&B) compañía global de suministro de información comercial, riesgo y financiera de empresas; con el fin de brindarles una herramienta de información integral y a un precio exclusivo por ser asociado.
                    <br><br>
                    Esta información consiste en una base de más de 250 millones de perfiles empresariales (clientes/proveedores) o Business Information Report (BIR) del mundo, donde encontrarán información detallada de principales ejecutivos, riesgo crediticio, capacidad financiera, principales acreedores, entre otros indicadores comerciales y financieros. Con esta informaciónsu empresa logrará:
                    <br><br>
                    <ul>
                      <li>Prospectar clientes estratégicos.</li>
                      <li>Evaluar mercados potenciales y emergentes.</li>
                      <li>Tener una adecuada planificación financiera.</li>
                      <li>Disminución de riesgos potenciales, entre otros.</li>
                      <li>En caso de estar interesados, escríbanos al correo consultoria@comexperu.org.pe solicitando mayor información.</li>
                    </ul>
                    <br>
                    En caso de estar interesados, escríbanos al correo consultoria@comexperu.org.pe solicitando mayor información.
                </p>
                <div class="btnDescargar-cont text-center">
                  <a href="{{url('documentos/ModeloBIR.pdf')}}" target="_blank">
                    <i class="fa fa-file-pdf-o pdf-descargar" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <div class="col-md-1 col-sm-1 hidden-xs"></div>
      </div>
    </div>
  </div>
</div>
@endsection
