$(document).ready(function(){
	
	$(".mensaje_lg").css("width","540px","important");
	$(".mensaje_lg").css("height","35px","important");
	$(".mensaje_lg").css("display","none","important");
	$(".mensaje_lg").css("color","#CC0000","important");
	$(".mensaje_lg").css("fontWeight","Bold","important");
	$(".mensaje_lg").css("textAlign","center","important");
	
	/*$("section#contactos").css("display","none");*/
	
	
	$("#acceso").on("click", function(){
		/* e.preventDefault(); */
	
		var lg_usuario = $("#html_usuario").val();
		var lg_clave = $("#html_clave").val();
		var msj = "";
		
		if(lg_usuario.length == 0){
			msj = "<span>Ingrese Usuario</span>";
			$(".mensaje_lg").css("display","block","important");
			$(".mensaje_lg").html(msj);
			$("#html_usuario").focus();
		}else if(lg_clave.length == 0){
			msj = "<span>Ingrese Clave</span>";
			$(".mensaje_lg").css("display","block","important");
			$(".mensaje_lg").html(msj);
			$("#html_clave").focus();
		}else{
			
			$.ajax({
				type: "POST",
				url: "s_login.php",
				data: "html_usuario=" + lg_usuario + "&html_clave=" + lg_clave,
				
				success: function(data){
					data = JSON.parse(data);
					
					if(data[0].correcto == 'true'){
						console.log("acceso correcto");
						window.location = "index.php";
						$("section#contactos").css("display","block","important");
						//console.log(data);
					}else{
					    //console.log("acceso incorrecto");
						msj = "<span>¡¡Credenciales Incorrectas!!</span>";
						$(".mensaje_lg").css("display","block","important");
						$(".mensaje_lg").html(msj);
						$("#html_usuario").focus();
					}
				}
			});
			
		}
		
	});
	
	
	
	// Enter Caja Texto Usuario
	
	$("#html_usuario").keypress( function(e){
		if(e.which == 13){
			$("#html_clave").val("");
			$("#html_clave").focus();
		}
	});
	
	// Enter Caja Texto Clave y posterior validacion y login
	
	$("#html_clave").keypress( function(e){
		if(e.which == 13){
			var lg_usuario = $("#html_usuario").val();
			var lg_clave = $("#html_clave").val();
			var msj = "";
		
			if(lg_usuario.length == 0){
				msj = "<span>Ingrese Usuario</span>";
				$(".mensaje_lg").css("display","block","important");
				$(".mensaje_lg").html(msj);
				$("#html_usuario").focus();
			}else if(lg_clave.length == 0){
				msj = "<span>Ingrese Clave</span>";
				$(".mensaje_lg").css("display","block","important");
				$(".mensaje_lg").html(msj);
				$("#html_clave").focus();
			}else{
				
				$.ajax({
					type: "POST",
					url: "s_login.php",
					data: "html_usuario=" + lg_usuario + "&html_clave=" + lg_clave,
					
					success: function(data){
						data = JSON.parse(data);
						
						if(data[0].correcto == 'true'){
							console.log("acceso correcto");
							window.location = "index.php";
							$("section#contactos").css("display","block","important");
							//console.log(data);
						}else{
							//console.log("acceso incorrecto");
							msj = "<span>¡¡Credenciales Incorrectas!!</span>";
							$(".mensaje_lg").css("display","block","important");
							$(".mensaje_lg").html(msj);
							$("#html_usuario").focus();
						}
					}
				});
				
			}
		}
	});
	
	
	
	
	
});