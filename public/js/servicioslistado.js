function reset()
  {
    $('#inscription_negocios_form')[0].reset();
  }
  function reset_1()
    {
      $('#logout-form')[0].reset();
    }


    $( document ).ready(function() {

      $.validator.addMethod("customemail",
      function(value, element) {
          return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
          // return .test(value);
      },
      customemail
      );

    });


    $("#inscrip-form").validate({
    // var validator = $("form[name='articulos']").validate({
            ignore: ".ignore",
            rules: {
                'empresa': {
                  required: true
                },
                'email': {
                  required: true,
                  email: true,
                  customemail: true
                },
                'nombre': {
                  required: true,
                  lettersonly: true
                },
                'cargo': {
                  required: true,
                  lettersonly: true
                }
                ,datos_accept:{
                  required:!0
                }
                ,imagen_accept:{
                  required:!0
                }
                ,hiddenRecaptchaPublicacion: {
                  required: function () {if (grecaptcha.getResponse(1) == '') {return true;} else {return false;}}
                }
            },
            messages :{
                empresa : {
                  required : required
                },
                email : {
                  required : required,
                  email: email
                },
                telefono  : {
                  required : required,
                  number:number,
                  minlength: minlength
                },
                nombre : {
                  required : required
                },
                cargo : {
                  required : required
                }
                ,datos_accept:{
                  required:must_accept_terms
                }
                ,imagen_accept:{
                  required:must_accept_terms
                }
                ,hiddenRecaptchaPublicacion:{
                  required:must_accept_terms
                }
            }
            ,errorPlacement:function(e,r){
              var t=$(r).data("error");
              t?$(t).append(e):e.insertAfter(r)
            },
            submitHandler: function (form) {
              return true;
            }
        });


        $("#inscription_negocios_form").validate({
        // var validator = $("form[name='articulos']").validate({
                ignore: ".ignore",
                rules: {
                    'institution': {
                      required: true
                    },
                    'email': {
                      required: true,
                      email: true,
                      customemail: true
                    },
                    'phone': {
                      required: true,
                      number : true,
                      minlength: 8
                    },
                    'name': {
                      required: true,
                      lettersonly: true
                    },
                    'position': {
                      required: true,
                      lettersonly: true
                    },
                    'address': {
                      required: true
                    }
                    ,datos_accept:{
                      required:!0
                    }
                    ,imagen_accept:{
                      required:!0
                    }
                    ,hiddenRecaptchaRevista: {
                      required: function () {if (grecaptcha.getResponse(2) == '') {return true;} else {return false;}}
                    }
                },
                messages :{
                    institution : {
                      required : required
                    },
                    email : {
                      required : required,
                      email: email
                    },
                    phone  : {
                      required : required,
                      number:number,
                      minlength: minlength
                    },
                    name : {
                      required : required
                    },
                    position : {
                      required : required
                    },
                    address : {
                      required : required
                    },
                    radio : {
                      required : required
                    }
                    ,datos_accept:{
                      required:must_accept_terms
                    }
                    ,imagen_accept:{
                      required:must_accept_terms
                    }
                    ,hiddenRecaptchaRevista:{
                      required:must_accept_terms
                    }
                }
                ,errorPlacement:function(e,r){
                  var t=$(r).data("error");
                  t?$(t).append(e):e.insertAfter(r)
                },
                submitHandler: function (form) {
                  return true;
                }
            });

            $("a[href*='.pdf'],a[href*='.html']").each(function() {
                  $(this).attr('target','_blank');
              });
