

$(document).ready(function(){


});

$('#btnAgregarAsesor').click(function(){
	$('#imgNuevaFoto').attr("src", "vistas/img/asesores/anonymous.png");
});

$('#nuevoSupervisor').attr("disabled", true);


/*====================================================
=            SUBIENDO LA FOTO DEL ASESOR            =
====================================================*/
$('.nuevaFoto').change(function(){

	var imagen = this.files[0];

	/* VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG/PNG */
	if(imagen["type"]!= "image/jpeg" && imagen["type"] != "image/png"){
		$('.nuevaFoto').val("");
		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen debe estar en formato JPG o PNG!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});
	}else if(imagen["size"] > 20000000){
		$('.nuevaFoto').val("");
		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen no debe pesar mas de 20 MB!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});
	}else{
		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);
		$(datosImagen).on("load", function(event){
			$('#bandera').val("fotoCambiada");
			var rutaImagen = event.target.result;
			$('.previsualizar').attr("src", rutaImagen);
		});
	}
	

});

/*=====  End of SUBIENDO LA FOTO DEL ASESOR  ======*/


/*======================================
=            EDITAR ASESOR            =
======================================*/
$(document).on('click','.btnEditarAsesor',function(){

	$('#editTurno').empty();
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
						
						$('#editarCampana').html(respuesta["campana"]);
						$('#editarCampana').val(respuesta["id"]);
						//$('<div id="editarCampana"></div>').val(respuesta["id"]);
					}
					
				});

			var datos = new FormData();
				datos.append("idTurno", respuesta["turno"]);

				$.ajax({
					url:"ajax/turnos.ajax.php",
					method: "POST",
					data: datos,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(respuesta){
						
						$("#editTurno").append("<option value=" + respuesta["id"] + ">" + respuesta["horario_entrada"] + " - " +respuesta["horario_salida"] + "</option>");
						
					}
				});

				

				var datos = new FormData();
				datos.append("idSupervisor", respuesta["supervisor"]);
				datos.append("buscarSupervisor", true);

				$.ajax({
					url:"ajax/supervisores.ajax.php",
					method: "POST",
					data: datos,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(supervisor){
						if(supervisor)
						{
							$('#editSupervisor').html(supervisor["nombre"] + " " + supervisor["apellido_paterno"] + " " + supervisor["apellido_materno"]);
							$('#editSupervisor').attr("value", supervisor["id"]);
						}
						else{
						 	$('#editSupervisor').html("Sin supervisor asignado");
						 	$('#editSupervisor').attr("value", "");
						 }
						
												
					}
					
				});
			
				
				var datos = new FormData();
				datos.append("buscarTurnosPlaza", true);
				datos.append("idPlaza", respuesta["plaza"]);
				$.ajax({
					url:"ajax/turnos.ajax.php",
					method: "POST",
					data: datos,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(respuesta){
						
						for(var i = 0; i < respuesta.length; i++)
							{
								$("#editTurno").append("<option value=" + respuesta[i]["id"] + ">" + respuesta[i]["horario_entrada"] + " - " +respuesta[i]["horario_salida"] + "</option>");
							}
						
					}
				});
			$('#editarNumeroEmpleado').val(respuesta["numemp"]);
			$('#editarIdChecador').val(respuesta["id_checador"]);
			
			$('#editarNombre').val(UTF8.decode(respuesta["nombre_completo"]));
			$('#passwordActual').val(respuesta["password"]);
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


/*=====  End of EDITAR ASESOR  ======*/


/*=======================================
=            ACTIVAR USUARIO            =
=======================================*/
$('.tablaAsesores tbody').on("click", "button.btnActivar", function(){
	var idAsesor = $(this).attr("idAsesor");
	var statusAsesor = $(this).attr("statusAsesor");

	var datos = new FormData();
	datos.append("activarId", idAsesor);
	datos.append("activarAsesor", statusAsesor);

	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method: "post",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			
				swal({
					title: "El usuario ha sido actualizado",
					type: "success",
					confirmButtonText:"¡Cerrar!",
				}).then(function(result){
					if(result.value){
						window.location = "asesoresNominas";
					}
				});
			
		}
	})

	if(statusAsesor == 0)
	{
		$(this).removeClass('btn-primary');
		$(this).addClass('btn-danger');
		$(this).html('Deshabilitado');
		$(this).attr('statusAsesor', 1);
	}
	if(statusAsesor == 1)
	{
		$(this).removeClass('btn-danger');
		$(this).addClass('btn-primary');
		$(this).html('Activado');
		$(this).attr('statusAsesor', 0);
	}
});

$('.tablaAsesoresBaja tbody').on("click", "button.btnActivar", function(){
	var idAsesor = $(this).attr("idAsesor");
	var statusAsesor = $(this).attr("statusAsesor");

	var datos = new FormData();
	datos.append("activarId", idAsesor);
	datos.append("activarAsesor", statusAsesor);

	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method: "post",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			
				swal({
					title: "El usuario ha sido actualizado",
					type: "success",
					confirmButtonText:"¡Cerrar!",
				}).then(function(result){
					if(result.value){
						window.location = "asesoresBaja";
					}
				});
			
		}
	})

	if(statusAsesor == 0)
	{
		$(this).removeClass('btn-primary');
		$(this).addClass('btn-danger');
		$(this).html('Deshabilitado');
		$(this).attr('statusAsesor', 1);
	}
	if(statusAsesor == 1)
	{
		$(this).removeClass('btn-danger');
		$(this).addClass('btn-primary');
		$(this).html('Activado');
		$(this).attr('statusAsesor', 0);
	}
});

$('.btnActivar').click(function(){
	var idAsesor = $(this).attr("idAsesor");
	var statusAsesor = $(this).attr("statusAsesor");

	var datos = new FormData();
	datos.append("activarId", idAsesor);
	datos.append("activarAsesor", statusAsesor);

	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method: "post",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			
				swal({
					title: "El usuario ha sido actualizado",
					type: "success",
					confirmButtonText:"¡Cerrar!",
				}).then(function(result){
					if(result.value){
						window.location = "usuariosSistemas";
					}
				});
			
		}
	})

	if(statusAsesor == 0)
	{
		$(this).removeClass('btn-primary');
		$(this).addClass('btn-danger');
		$(this).html('Deshabilitado');
		$(this).attr('statusAsesor', 1);
	}
	if(statusAsesor == 1)
	{
		$(this).removeClass('btn-danger');
		$(this).addClass('btn-primary');
		$(this).html('Activado');
		$(this).attr('statusAsesor', 0);
	}
});


/*======================================
=            REVISAR NUMEMP REPETIDO            
======================================*/
$('#nuevoNumEmpleado').change(function(){
	$(".alert").remove();
	var numemp = $(this).val();
	var datos = new FormData();
	datos.append("validarAsesor", numemp);
	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method: "post",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			console.log(respuesta);
			if(respuesta["numemp"] == $('#nuevoNumEmpleado').val()){
				$('#nuevoNumEmpleado').parent().after('<div class="alert alert-warning">Este NUMERO ya existe</div>')
				$('#nuevoNumEmpleado').val("");
			}

		}
	})
});

/*======================================
=            REVISAR ID CHECADOR REPETIDO            
======================================*/
$('#nuevoIdChecador').change(function(){
	$(".alert").remove();
	var checador = $(this).val();
	var plaza = $(this).attr('plaza');
	var datos = new FormData();
	datos.append("validarChecador", checador);
	datos.append("validarPlaza", plaza);
	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method: "post",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			console.log(respuesta);
			if(respuesta["id_checador"] == $('#nuevoIdChecador').val()){
				$('#nuevoIdChecador').parent().after('<div class="alert alert-warning">Este ID CHECADOR ya existe en esta plaza</div>')
				$('#nuevoIdChecador').val("");
			}

		}
	})
});

$("#nuevaCampaña").change(function(){
		$('#nuevoSupervisor').attr("disabled", false);
		campañaSeleccionada = $('#nuevaCampaña').val();
		var plaza = $(this).attr('plaza');
		var datos = new FormData();
		datos.append("campaña", campañaSeleccionada);
		datos.append("Plaza", plaza);
		datos.append("buscarSupervisores", true);
		$.ajax({
			url:"ajax/supervisores.ajax.php",
			method:"POST",
			data:datos,
			cache:"false",
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(supervisor) {  	
				
				
				$("#nuevoSupervisor").empty();
				
				
				$("#nuevoSupervisor").append('<option value="">Ninguno</option>');
				for(var i = 0; i < supervisor.length; i++)
				{
					$("#nuevoSupervisor").append("<option value=" + supervisor[i]["id"] + ">" + supervisor[i]["nombre"] + " " +supervisor[i]["apellido_paterno"] + " " + supervisor[i]["apellido_materno"] + "</option>");
				}
				
			}
		})	
	});

$("#editarCampaña").change(function(){
		
		campañaSeleccionada = $('#editarCampaña').val();
		var plaza = $(this).attr('plaza');
		var datos = new FormData();
		datos.append("campaña", campañaSeleccionada);
		datos.append("Plaza", plaza);
		datos.append("buscarSupervisores", true);
		$.ajax({
			url:"ajax/supervisores.ajax.php",
			method:"POST",
			data:datos,
			cache:"false",
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(supervisor) {  	
				
				
				$("#editarSupervisor").empty();
				$("#editarSupervisor").append("<option value=''>" + "Seleccionar Supervisor"+ "</option>");
				
					
				for(var i = 0; i < supervisor.length; i++)
				{
					$("#editarSupervisor").append("<option value=" + supervisor[i]["id"] + ">" + supervisor[i]["nombre"] + " " +supervisor[i]["apellido_paterno"] + " " + supervisor[i]["apellido_materno"] + "</option>");
				}
				
			}
		})	
	});

