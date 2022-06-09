
$('#habilitar-lang').mousedown(function() {
    if (!$(this).is(':checked')) {
      $('.actions').addClass('hidden');
      $('.actionsNext').removeClass('hidden');
    }else{
      $('.actionsNext').addClass('hidden');
      $('.actions').removeClass('hidden');
      $('#ingles').removeClass('active');
      $('#espanol').addClass('active');
    }
});

var validator = $("#articulos").validate({
// var validator = $("form[name='articulos']").validate({
        rules: {
            'publication': {
                required: true
            },
            // 'tags[]': {
            //   required: true
            // }
        },
        messages :{
            'publication' : {
              required : '*Campo obligatorio.'
            },
            'tags[]' : {
              required : '*Campo obligatorio.'
            },
            'title_es'  : {
              required : '*Campo obligatorio.'
            },
            'title_en'  : {
              required : '*Campo obligatorio.'
            },
            'content_es' : {
              required : '*Campo obligatorio.'
            },
            'content_en' : {
              required : '*Campo obligatorio.'
            },
            'file_en' : {
              required : '*Campo obligatorio.'
            },
            'file_es' : {
              required : '*Campo obligatorio.'
            }
        },
        submitHandler: function (form) {
          // console.log('Se guardó correctamente');
          var esp=  $('#espanol').hasClass('active');
          console.log(esp);
          if(esp){
                $('#ingles').addClass('active');
                $('#espanol').removeClass('active');
                $("#lang_en").trigger("click");
                $('.actionsNext').addClass('hidden');
                $('.actions').removeClass('hidden');
                españolIngles();
          }else{
            return true;
          }
        }
    });

function españolIngles(){
  $('#ingles').addClass('active');
  $('#espanol').removeClass('active');
  $('.section-spanish').addClass('hidden');
  $('.section-english').removeClass('hidden');
  $('.actionsNext').addClass('hidden');
  $('.actions').removeClass('hidden');
  $('#select_publicacion option').each(function(){
    $(this).text($(this).attr('data-en'));
  });
  $('#select_publicacion').select2();
  $('#select_tags option').each(function(){
    $(this).text($(this).attr('data-en'));
  });
  $('#select_columnas option').each(function(){
    $(this).text($(this).attr('data-en'));
  });
  $('#select_tags').select2();
}
