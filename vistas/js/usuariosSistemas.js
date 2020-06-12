$('.tablaAsesores tbody').on("click", "button.btnLiberarUsuario", function(){
	var idUsuario = $(this).attr("idUsuario");
		swal({
		  title: '¿Liberar sesion?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'No',
		  confirmButtonText: 'Si'
		}).then(function(result){
		  if (result.value) {

		  		
		  		var datos = new FormData();
				datos.append("liberarSesion", true);
				datos.append("numemp", idUsuario);
				

		  		$.ajax({
					url:"ajax/usuarios.ajax.php",
					method: "post",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					success: function(respuesta){
						if(respuesta == "ok"){
							swal({
								title: "Sesion liberada!",
								type: "success",
								confirmButtonText:"¡Cerrar!",
							}).then(function(result){
								if(result.value){
									window.location = "asesoresNominas";
								}
							});
						}else{
							swal({
								title: "Error al tratar de liberar sesion!" + respuesta,
								type: "error",
								confirmButtonText:"¡Cerrar!",
							}).then(function(result){
								if(result.value){
									window.location = "asesoresNominas";
								}
							});
						}
					}
				})
		   
		 	 }
		})

});

$('.btnLiberarUsuario').click(function(){
	var idUsuario = $(this).attr("idUsuario");
		swal({
		  title: '¿Liberar sesion?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'No',
		  confirmButtonText: 'Si'
		}).then(function(result){
		  if (result.value) {

		  		
		  		var datos = new FormData();
				datos.append("liberarSesion", true);
				datos.append("numemp", idUsuario);
				

		  		$.ajax({
					url:"ajax/usuarios.ajax.php",
					method: "post",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					success: function(respuesta){
						if(respuesta == "ok"){
							swal({
								title: "Sesion liberada!",
								type: "success",
								confirmButtonText:"¡Cerrar!",
							}).then(function(result){
								if(result.value){
									window.location = "usuariosSistemas";
								}
							});
						}else{
							swal({
								title: "Error al tratar de liberar sesion!" + respuesta,
								type: "error",
								confirmButtonText:"¡Cerrar!",
							}).then(function(result){
								if(result.value){
									window.location = "usuariosSistemas";
								}
							});
						}
					}
				})
		   
		 	 }
		})

});

$('.btnLiberarUsuarioRoot').click(function(){
	var idUsuario = $(this).attr("idUsuario");
		swal({
		  title: '¿Liberar sesion?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'No',
		  confirmButtonText: 'Si'
		}).then(function(result){
		  if (result.value) {

		  		
		  		var datos = new FormData();
				datos.append("liberarSesion", true);
				datos.append("numemp", idUsuario);
				

		  		$.ajax({
					url:"ajax/usuarios.ajax.php",
					method: "post",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					success: function(respuesta){
						if(respuesta == "ok"){
							swal({
								title: "Sesion liberada!",
								type: "success",
								confirmButtonText:"¡Cerrar!",
							}).then(function(result){
								if(result.value){
									window.location = "usuariosRoot";
								}
							});
						}else{
							swal({
								title: "Error al tratar de liberar sesion!",
								type: "error",
								confirmButtonText:"¡Cerrar!",
							}).then(function(result){
								if(result.value){
									window.location = "usuariosRoot";
								}
							});
						}
					}
				})
		   
		 	 }
		})

});

$(document).on('click','.btnEditarUsuarioSistemas',function(){

	
	var idAsesor = $(this).attr("idAsesor");

	var datos = new FormData();
	datos.append("idAsesor", idAsesor);

	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			var datos = new FormData();
				datos.append("idCampaña", respuesta["campana"]);

				$.ajax({
					url:"ajax/campanas.ajax.php",
					method: "POST",
					data: datos,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(respuesta){
						
						$('#editarCampanaS').html(respuesta["campana"]);
						$('#editarCampanaS').val(respuesta["id"]);
						//$('<div id="editarCampana"></div>').val(respuesta["id"]);
					}
					
				});
		
			$("#editarNivelSistemas").empty();
			$('#editarNumeroEmpleadoSistemas').val(respuesta["numemp"]);
			$('#editarNombreSistemas').val(UTF8.decode(respuesta["nombre_completo"]));
			$('#editarIdChecador').val(respuesta["id_checador"]);
			$('#passwordActualSistemas').val(respuesta["password"]);
			switch(respuesta["nivel_acceso"]){
				case '2': 
					$("#editarNivelSistemas").append("<option value='2'>" + "Calidad"+ "</option>");
					$("#editarNivelSistemas").append("<option value='3'>" + "Recrea"+ "</option>");
					$("#editarNivelSistemas").append("<option value='4'>" + "Administrativo"+ "</option>");
					$("#editarNivelRoot").append("<option value='6'>" + "Reclutamiento y Seleccion"+ "</option>");
					
					break;

				case '3':
					$("#editarNivelSistemas").append("<option value='3'>" + "Recrea"+ "</option>");
					$("#editarNivelSistemas").append("<option value='2'>" + "Calidad"+ "</option>");
					$("#editarNivelSistemas").append("<option value='4'>" + "Administrativo"+ "</option>");
					$("#editarNivelRoot").append("<option value='6'>" + "Reclutamiento y Seleccion"+ "</option>");
					
					break;

				case '4':
					$("#editarNivelSistemas").append("<option value='4'>" + "Administrativo"+ "</option>");
					$("#editarNivelSistemas").append("<option value='2'>" + "Calidad"+ "</option>");
					$("#editarNivelSistemas").append("<option value='3'>" + "Recrea"+ "</option>");
					$("#editarNivelRoot").append("<option value='6'>" + "Reclutamiento y Seleccion"+ "</option>");
					
					break;

				case '6':
					$("#editarNivelRoot").append("<option value='6'>" + "Reclutamiento y Seleccion"+ "</option>");
					
					$("#editarNivelSistemas").append("<option value='2'>" + "Calidad"+ "</option>");
					$("#editarNivelSistemas").append("<option value='3'>" + "Recrea"+ "</option>");
					$("#editarNivelSistemas").append("<option value='4'>" + "Administrativo"+ "</option>");
					
					
					break;

				default:
					$("#editarNivelSistemas").append("<option value=''>" + "Selecciona nivel"+ "</option>");
					$("#editarNivelSistemas").append("<option value='2'>" + "Calidad"+ "</option>");
					$("#editarNivelSistemas").append("<option value='3'>" + "Recrea"+ "</option>");
					$("#editarNivelSistemas").append("<option value='4'>" + "Administrativo"+ "</option>");
					
					break;

			}
		}
	});
	
});

$(document).on('click','.btnEditarUsuarioRoot',function(){

	
	
	var idAsesor = $(this).attr("idAsesor");

	var datos = new FormData();
	datos.append("idAsesor", idAsesor);

	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
		
			$("#editarNivelRoot").empty();
			$('#editarNumeroEmpleadoRoot').val(respuesta["numemp"]);
			
			$('#editarNombreRoot').val(UTF8.decode(respuesta["nombre_completo"]));
			$('#passwordActualRoot').val(respuesta["password"]);
			switch(respuesta["nivel_acceso"]){
				case '1':
					$("#editarNivelRoot").append("<option value='1'>" + "Sistemas"+ "</option>");
					$("#editarNivelRoot").append("<option value='2'>" + "Calidad"+ "</option>");
					$("#editarNivelRoot").append("<option value='3'>" + "Recrea"+ "</option>");
					$("#editarNivelRoot").append("<option value='4'>" + "Administrativo"+ "</option>");
					$("#editarNivelRoot").append("<option value='6'>" + "Reclutamiento y Seleccion"+ "</option>");
					$("#editarNivelRoot").append("<option value='7'>" + "Director"+ "</option>");
					

					break;
				case '2': 
					$("#editarNivelRoot").append("<option value='2'>" + "Calidad"+ "</option>");
					$("#editarNivelRoot").append("<option value='1'>" + "Sistemas"+ "</option>");
					$("#editarNivelRoot").append("<option value='3'>" + "Recrea"+ "</option>");
					$("#editarNivelRoot").append("<option value='4'>" + "Administrativo"+ "</option>");
					$("#editarNivelRoot").append("<option value='6'>" + "Reclutamiento y Seleccion"+ "</option>");
					$("#editarNivelRoot").append("<option value='7'>" + "Director"+ "</option>");
					
					
					break;

				case '3':
					$("#editarNivelRoot").append("<option value='3'>" + "Recrea"+ "</option>");
					$("#editarNivelRoot").append("<option value='1'>" + "Sistemas"+ "</option>");
					$("#editarNivelRoot").append("<option value='2'>" + "Calidad"+ "</option>");
					$("#editarNivelRoot").append("<option value='4'>" + "Administrativo"+ "</option>");
					$("#editarNivelRoot").append("<option value='6'>" + "Reclutamiento y Seleccion"+ "</option>");
					$("#editarNivelRoot").append("<option value='7'>" + "Director"+ "</option>");				
					break;

				case '4':
					$("#editarNivelRoot").append("<option value='4'>" + "Administrativo"+ "</option>");
					$("#editarNivelRoot").append("<option value='1'>" + "Sistemas"+ "</option>");
					$("#editarNivelRoot").append("<option value='2'>" + "Calidad"+ "</option>");
					$("#editarNivelRoot").append("<option value='3'>" + "Recrea"+ "</option>");
					$("#editarNivelRoot").append("<option value='6'>" + "Reclutamiento y Seleccion"+ "</option>");
					$("#editarNivelRoot").append("<option value='7'>" + "Director"+ "</option>");				
					break;

				case '6':
					$("#editarNivelRoot").append("<option value='6'>" + "Reclutamiento y Seleccion"+ "</option>");
					$("#editarNivelRoot").append("<option value='1'>" + "Sistemas"+ "</option>");
					$("#editarNivelRoot").append("<option value='2'>" + "Calidad"+ "</option>");
					$("#editarNivelRoot").append("<option value='3'>" + "Recrea"+ "</option>");
					$("#editarNivelRoot").append("<option value='4'>" + "Administrativo"+ "</option>");
					$("#editarNivelRoot").append("<option value='7'>" + "Director"+ "</option>");
					
					break;

				case '7':
					$("#editarNivelRoot").append("<option value='7'>" + "Director"+ "</option>");
					
					$("#editarNivelRoot").append("<option value='1'>" + "Sistemas"+ "</option>");
					$("#editarNivelRoot").append("<option value='2'>" + "Calidad"+ "</option>");
					$("#editarNivelRoot").append("<option value='3'>" + "Recrea"+ "</option>");
					$("#editarNivelRoot").append("<option value='4'>" + "Administrativo"+ "</option>");
					$("#editarNivelRoot").append("<option value='6'>" + "Reclutamiento y Seleccion"+ "</option>");
					
					
					break;

				

				default:
					$("#editarNivelRoot").append("<option value=''>" + "Selecciona nivel"+ "</option>");
					$("#editarNivelRoot").append("<option value='1'>" + "Sistemas"+ "</option>");
					$("#editarNivelRoot").append("<option value='2'>" + "Calidad"+ "</option>");
					$("#editarNivelRoot").append("<option value='3'>" + "Recrea"+ "</option>");
					$("#editarNivelRoot").append("<option value='4'>" + "Administrativo"+ "</option>")
					$("#editarNivelRoot").append("<option value='6'>" + "Reclutamiento y Seleccion"+ "</option>");;
					
					break;

			}

			$('#fotoActual').val(respuesta["foto"]);
			if(respuesta["foto"] != ""){
				$(".previsualizar").attr("src", respuesta["foto"]);
			}else{
				ruta = "vistas/img/usuarios/default/anonymous.png"
				$(".previsualizar").attr("src", ruta);
			}
		}
	});
	
});


