function limpiar()
  {
    // console.log("reset");
    $('#formproblematic')[0].reset();
  }

  //validaciones formulario

  $( document ).ready(function() {

    $.validator.addMethod("customemail",
    function(value, element) {
        return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
        // return .test(value);
    },
    customemail
    );

  });


  $('#formproblematic').validate({ // initialize the plugin
      rules: {
        nombre: {
            required: true
            //minlength: 5
        },
        apellido: {
            required: true
            //minlength: 5
        },
        telefono:{
          required: true,
          number : true,
          minlength: 8,
        },
        email:{
          required: true,
          email: true,
          customemail: true
        },
        empresa: {
            required: true,
            alphanumerico: true
        },
        descripcion: {
            required: true
        },
      },
      messages :{
          nombre : {
              required :required
          },
          apellido : {
              required : required
          },
          telefono: {
            required :  required,
            number: number,
            minlength: minlength,
          },
          email : {
              required : required,
              email: email,
          },
          empresa: {
            required :  required
          },
          descripcion: {
            required :  required,
          }
        },
      });
