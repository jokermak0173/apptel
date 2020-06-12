/*=======================================
=            ACTIVAR SUPERVISORES           =
=======================================*/
$(document).on('click','.btnActivarTurno',function(){
	var idTurno = $(this).attr("idTurno");
	var statusTurno = $(this).attr("statusTurno");

	var datos = new FormData();
	datos.append("idTurnoActivar", idTurno);
	datos.append("statusTurno", statusTurno);
	datos.append("activarTurno", true);

	$.ajax({
		url:"ajax/turnos.ajax.php",
		method: "post",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			if(respuesta == "ok"){
				swal({
					title: "El turno ha sido actualizado correctamente",
					type: "success",
					confirmButtonText:"¡Cerrar!",
				}).then(function(result){
					if(result.value){
						window.location = "turnos";
					}
				});
			}else{
				swal({
					title: "Error al actualizar turno Cod. Error: " + respuesta,
					type: "error",
					confirmButtonText:"¡Cerrar!",
				}).then(function(result){
					if(result.value){
						window.location = "turnos";
					}
				});
			}
		}
	})

	if(statusTurno == 0)
	{
		$(this).removeClass('btn-primary');
		$(this).addClass('btn-danger');
		$(this).html('Inactivo');
		$(this).attr('statusTurno', 1);
	}
	if(statusTurno == 1)
	{
		$(this).removeClass('btn-danger');
		$(this).addClass('btn-primary');
		$(this).html('Activo');
		$(this).attr('statusTurno', 0);
	}
});

$('.clockpicker').clockpicker();