var validator = $("#seminars").validate({
       rules: {
         'name_es':{
           required: true
         }
       },
       messages :{
           'name_es' : {
             required : '*Campo obligatorio.'
           },
           'title_es' : {
             required : '*Campo obligatorio.'
           },
           'place_es'  : {
             required : '*Campo obligatorio.'
           },
           'name_en' : {
             required : '*Campo obligatorio.'
           },
           'title_en' : {
             required : '*Campo obligatorio.'
           },
           'place_en'  : {
             required : '*Campo obligatorio.'
           }
       },
       submitHandler: function (form) {
         var esp=  $('#espanol').hasClass('active');
         console.log(esp);
         if(esp){

            $('#ingles').addClass('active');
             $('#espanol').removeClass('active');
             $('.section-spanish').addClass('hidden');
             $('.section-english').removeClass('hidden');
             $('.actionsNext').addClass('hidden');
             $('.actions').removeClass('hidden');
                return false;
         }else{
           return true;
         }
       }
   });




   $("#cumbre").validate({
          rules: {
            'name_es':{
              required: true
            },
            'title_es'  : {
              required : true
            },
            'name_en':{
              required: true
            },
            'title_en'  : {
              required : true
            }
          },
          messages :{
              'name_es' : {
                required : '*Campo obligatorio.'
              },
              'title_es'  : {
                required : '*Campo obligatorio.'
              },
              'name_en' : {
                required : '*Campo obligatorio.'
              },
              'title_en' : {
                required : '*Campo obligatorio.'
              }
          },
          submitHandler: function (form) {
            var esp=  $('#espanol').hasClass('active');
            console.log(esp);
            if(esp){

               $('#ingles').addClass('active');
                $('#espanol').removeClass('active');
                $('.section-spanish').addClass('hidden');
                $('.section-english').removeClass('hidden');
                $('.actionsNext').addClass('hidden');
                $('.actions').removeClass('hidden');
                   return false;
            }else{
              return true;
            }
          }
      });
