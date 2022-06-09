if(ruta!=''){ruta=ruta+'/'}
function fncconcatenarfiltros()
{var concatenar='';var i=0;$('.filtro-lista-active').each(function(){if(i==0){concatenar+="&tags="+$(this).attr('data-id')}
else{concatenar+=','+$(this).attr('data-id')}
i++});var i=0;$('.lista-ver-active').each(function(){if(i==0){concatenar+="&categorias="+$(this).attr('data-id')}
else{concatenar+=','+$(this).attr('data-id')}
i++});var keyword=$('.filtro-contenido').find('.home-input-search').val();if(keyword!=''){concatenar+="&keyword="+keyword}
return concatenar}
$(document).on('click','.home-button-buscar',function(){var page=1;var vinculacion=url+"/"+ruta+"articulos?page="+page;vinculacion=vinculacion+fncconcatenarfiltros();location.href=vinculacion})
