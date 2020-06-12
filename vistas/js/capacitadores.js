/*=======================================
=            ACTIVAR SUPERVISORES           =
=======================================*/
$(document).on('click','.btnActivarCapacitador',function(){
	var idCapa = $(this).attr("idCapa");
	var statusCapa = $(this).attr("statusCapa");

	var datos = new FormData();
	datos.append("idCapa", idCapa);
	datos.append("statusCapa", statusCapa);
	datos.append("activarCapa", true);

	$.ajax({
		url:"ajax/capacitadores.ajax.php",
		method: "post",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			if(respuesta == "ok"){
				swal({
					title: "El capacitador ha sido actualizado correctamente",
					type: "success",
					confirmButtonText:"¡Cerrar!",
				}).then(function(result){
					if(result.value){
						window.location = "capacitadores";
					}
				});
			}else{
				swal({
					title: "Error al actualizar capacitador Cod. Error: " + respuesta,
					type: "error",
					confirmButtonText:"¡Cerrar!",
				}).then(function(result){
					if(result.value){
						window.location = "capacitadores";
					}
				});
			}
		}
	})

	if(statusCapa == 0)
	{
		$(this).removeClass('btn-primary');
		$(this).addClass('btn-danger');
		$(this).html('Inactivo');
		$(this).attr('statusCapa', 1);
	}
	if(statusCapa == 1)
	{
		$(this).removeClass('btn-danger');
		$(this).addClass('btn-primary');
		$(this).html('Activo');
		$(this).attr('statusCapa', 0);
	}
});
