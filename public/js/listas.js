jQuery("document").ready(function($){
    $(".list-directorio").children().find('.contenidodirectorio').on("click", function(){
      var decision= $(this).hasClass('desplegar');
      if(decision==true)
      {
        $(this).parent().find('.list-subdirectorio').css('display','none');
        $(this).find('i').attr('class','fa fa-plus fa-lg ico-vermas');
        $(this).find('span').text(vermas);
        $(this).find('span').css('color','#d8d8d8');
        $(this).addClass('plegar');
        $(this).removeClass('desplegar');
      }
      else {
        $(this).parent().find('.list-subdirectorio').css('display','block');
        $(this).find('i').attr('class','fa fa-minus fa-lg ico-vermenos');
        $(this).find('span').text(vermenos);
        $(this).find('span').css('color','#ca0538');
        $(this).addClass('desplegar');
        $(this).removeClass('plegar');
      }
 });
 $(".list-subdirectorio").children().find('.contenidosubdirectorio').on("click", function(){

   var decision= $(this).hasClass('desplegar');
   if(decision==true)
   {
     $(this).parent().find('.list-subsubdirectorio').css('display','none');
     $(this).find('i').attr('class','fa fa-plus fa-lg ico-vermas');
     $(this).find('span').text(vermas);
     $(this).addClass('plegar');
     $(this).removeClass('desplegar');
   }
   else {
     $(this).parent().find('.list-subsubdirectorio').css('display','block');
     $(this).find('i').attr('class','fa fa-minus fa-lg ico-vermenos');
     $(this).find('span').text(vermenos);
     $(this).addClass('desplegar');
     $(this).removeClass('plegar');
   }
});
});
