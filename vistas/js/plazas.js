$(document).on('click','.btnActivarPlaza',function(){
	var idPlaza = $(this).attr("idPlaza");
	var statusPlaza = $(this).attr("statusPlaza");

	var datos = new FormData();
	datos.append("idPlaza", idPlaza);
	datos.append("statusPlaza", statusPlaza);
	datos.append("activarPlaza", true);

	$.ajax({
		url:"ajax/plazas.ajax.php",
		method: "post",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			if(respuesta == "ok"){
				swal({
					title: "La plaza ha sido actualizada correctamente",
					type: "success",
					confirmButtonText:"¡Cerrar!",
				}).then(function(result){
					if(result.value){
						window.location = "plazasRoot";
					}
				});
			}else{
				swal({
					title: "Error al actualizar plaza Cod. Error: " + respuesta,
					type: "error",
					confirmButtonText:"¡Cerrar!",
				}).then(function(result){
					if(result.value){
						window.location = "plazasRoot";
					}
				});
			}
		}
	})

	if(statusSuper == 0)
	{
		$(this).removeClass('btn-primary');
		$(this).addClass('btn-danger');
		$(this).html('Inactiva');
		$(this).attr('statusPlaza', 1);
	}
	if(statusSuper == 1)
	{
		$(this).removeClass('btn-danger');
		$(this).addClass('btn-primary');
		$(this).html('Activa');
		$(this).attr('statusPlaza', 0);
	}
});


$(document).on('click','.btnEditarPlaza',function(){

	var idPlaza = $(this).attr("idPlaza");

	var datos = new FormData();
	datos.append("idPlaza", idPlaza);
	datos.append("editarPlaza", true);
	
	$.ajax({
		url:"ajax/plazas.ajax.php",
		method: "POST",
		data: datos,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$('#editarPlaza').val(respuesta["nombre"]);
			$('#idPlazaActual').val(respuesta["id"]);
			
		}
	});
	

});