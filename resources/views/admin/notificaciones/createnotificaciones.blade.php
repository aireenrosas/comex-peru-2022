@extends('app.appadmin')
@section('style')
<link href="<?php echo URL::asset('css/home.css'); ?>" rel="stylesheet" type="text/css" />

@endsection
@section('content')

<div class="row">
  <div class="col-md-12 cont-tabla">
      <div class="portlet light ">
          <div class="portlet-title tabbable-line">
            <div class="caption caption-md">
                <h1 class="titulo-editar">Enviar notificaciones</h1>
            </div>
          </div>
          <div class="portlet-body">
                <div class="col-md-12">
                    <div class="col-md-12 form-group">
                      <label class="label-input-format label-titulo">Título: </label>
                      {!! Form::text('titulo',null ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el mensaje', 'required', 'id'=>'title'])!!}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12 form-group">
                      <label class="label-input-format label-titulo">Mensaje: </label>
                      {!! Form::text('mensaje',null ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el mensaje', 'required', 'id'=>'body'])!!}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12 form-group">
                      <label class="label-input-format label-titulo">Url: </label>
                      {!! Form::text('url',null ,['class' => 'input-admin form-control', 'placeholder' => 'Escribe el mensaje', 'required', 'id'=>'url'])!!}
                    </div>
                </div>
                <label class="*Todos los campos son obligatorios"></label>
                <div class="actions col-md-12" style="padding:20px 15px;">
                  <button class="btn btn-guardar" onclick="sendNotification()" disabled>Enviar</button>
              </div>
          </div>
      </div>
  </div>
</div>

<script>
$("#title").on("change paste keyup", function() {
  if($("#title").val() !="" && $("#body").val() !="" && $("#url").val() !=""){
    $(".btn-guardar").removeAttr("disabled");
  }
  else{
    $(".btn-guardar").attr("disabled","disabled");
  }
});
$("#body").on("change paste keyup", function() {
  if($("#title").val() !="" && $("#body").val() !="" && $("#url").val() !=""){
    $(".btn-guardar").removeAttr("disabled");
  }
  else{
    $(".btn-guardar").attr("disabled","disabled");
  }
});
$("#url").on("change paste keyup", function() {
  if($("#title").val() !="" && $("#body").val() !="" && $("#url").val() !=""){
    $(".btn-guardar").removeAttr("disabled");
  }
  else{
    $(".btn-guardar").attr("disabled","disabled");
  }
});


function sendNotification(){
  var data = new FormData();
  data.append('title', document.getElementById('title').value);
  data.append('body', document.getElementById('body').value);
  data.append('url', document.getElementById('url').value);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', "{{url('api/send-notification/')}}", true);
    xhr.onload = function () {
        // do something to response
        swal("Se envió correctamente.");
        console.log(this.responseText);
    };
    xhr.send(data);
}
var _registration = null;
function registerServiceWorker() {
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker
         .register('../service-worker.js')
         .then(function(registration) {
           console.log('Service worker successfully registered.');
           _registration = registration;
           return registration;
         })
         .catch(function(err) {
           console.error('Unable to register service worker.', err);
         });
  }

}

function askPermission() {
  return new Promise(function(resolve, reject) {
    const permissionResult = Notification.requestPermission(function(result) {
      resolve(result);
    });

    if (permissionResult) {
      permissionResult.then(resolve, reject);
    }
  })
  .then(function(permissionResult) {
    if (permissionResult !== 'granted') {
      throw new Error('We weren\'t granted permission.');
    }
    else{
      subscribeUserToPush();
    }
  });
}

function urlBase64ToUint8Array(base64String) {
  const padding = '='.repeat((4 - base64String.length % 4) % 4);
  const base64 = (base64String + padding)
    .replace(/\-/g, '+')
    .replace(/_/g, '/');

  const rawData = window.atob(base64);
  const outputArray = new Uint8Array(rawData.length);

  for (let i = 0; i < rawData.length; ++i) {
    outputArray[i] = rawData.charCodeAt(i);
  }
  return outputArray;
}

function getSWRegistration(){
  var promise = new Promise(function(resolve, reject) {
  // do a thing, possibly async, then…

  if (_registration != null) {
    resolve(_registration);
  }
  else {
    reject(Error("It broke"));
  }
  });
  return promise;
}

function subscribeUserToPush() {
  getSWRegistration()
  .then(function(registration) {
    console.log(registration);
    const subscribeOptions = {
      userVisibleOnly: true,
      applicationServerKey: urlBase64ToUint8Array(
        keyApi
      )
    };

    return registration.pushManager.subscribe(subscribeOptions);
  })
  .then(function(pushSubscription) {
    console.log('Received PushSubscription: ', JSON.stringify(pushSubscription));
    sendSubscriptionToBackEnd(pushSubscription);
    return pushSubscription;
  });
}

function sendSubscriptionToBackEnd(subscription) {
  console.log('suscription:'+ JSON.stringify(subscription));
  var data = {};
  data.json = JSON.stringify( subscription );
  data._token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    type: "POST",
    url: url+'/api/save-subscription/'+'{{Auth::user()->id}}',
    data: data,
    success: function(data){
      console.log(data);
    },
    error: function(data){
      console.log(data);
    }
  });

}


function enableNotifications(){
  //register service worker
  //check permission for notification/ask
  askPermission();
}
registerServiceWorker();
</script>
<script type="text/javascript">

</script>
@endsection
