if(ruta!=''){
  ruta = ruta+'/';
}
!function ($) {
    $(document).on("click","#btnbuscardet", function(){
        $('#detalle').addClass("hidden");
        $('#oculto').removeClass("hidden");
        $('#oculto2').removeClass("hidden");
    });
    $(document).on("click","#btncerrar", function(){
        $('#oculto').addClass("hidden");
        $('#oculto2').addClass("hidden");
        $('#detalle').removeClass("hidden");
    });
}(window.jQuery);
$(document).on("click","#buscar-det", function(){
    $('#submit-search').click();
});
$(document).on('click', '.leertodo', function(){

  $('.contenidocompleto').removeClass('hidden-xs');
  $('.contenidoinicios').addClass('hidden');
  $('.leertodo').addClass('hidden');
});



function printPage() {
    window.print();
}

function fncconcatenarfiltros()
{
  var concatenar = '';
  var i = 0;
  $('.filtro-lista-active').each(function(){
    if(i==0){
      concatenar+= "&tags="+$(this).attr('data-id');
    }
    else{
      concatenar+=','+$(this).attr('data-id');
    }

    i++;
  });
  var i = 0;
  $('.lista-ver-active').each(function(){
    if(i==0){
      concatenar+= "&categorias="+$(this).attr('data-id');
    }
    else{
      concatenar+=','+$(this).attr('data-id');
    }

    i++;
  });
  var keyword=$('.home-col-search').find('.input-search').val();
  if(keyword!=''){
    concatenar+= "&keyword="+keyword;
  }
  return concatenar;
}
// $(document).on('click', '.btn-buscar-det', function(){
//   var page=1;
//   var vinculacion=url+"/"+ruta+"articulos?page="+page;
//   vinculacion=vinculacion+fncconcatenarfiltros();
//   location.href = vinculacion;
// });
$(document).on('click', '.home-button-buscar', function(){
  var page=1;
  var vinculacion=url+"/"+ruta+"articulos?page="+page;
  vinculacion=vinculacion+fncconcatenarfiltros();
  location.href = vinculacion;
});



$('.input-search').keypress(function(e){
      if(e.which == 13){
          $('.home-button-buscar').click();
      }
  });

  function check(x) {
      elements = $(".cont-parrafo-articulo p");
      for (var i = 0; i < elements.length; i++) {
        elements[i].addClass('txt-parrafo-art');
          // elements[i].style.backgroundColor="blue";
      }
  }
  var element = document.getElementsByTagName("table");
  $(element).wrap( "<div class='table-responsive'></div>" );
  var element = document.getElementsByTagName("img");
  $(element).addClass("img-responsive");


  $(".home-button[href*='.pdf']").each(function() {
        console.log("this",this);
        $(this).attr('target','_blank');
    });
