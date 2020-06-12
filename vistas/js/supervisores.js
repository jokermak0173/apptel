/*=======================================
=            ACTIVAR SUPERVISORES           =
=======================================*/
$(document).on('click','.btnActivarSupervisor',function(){
	var idsuper = $(this).attr("idsuper");
	var statusSuper = $(this).attr("statusSuper");

	var datos = new FormData();
	datos.append("idsuper", idsuper);
	datos.append("statusSuper", statusSuper);
	datos.append("activarSuper", true);

	$.ajax({
		url:"ajax/supervisores.ajax.php",
		method: "post",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			if(respuesta == "ok"){
				swal({
					title: "El supervisor ha sido actualizado correctamente",
					type: "success",
					confirmButtonText:"¡Cerrar!",
				}).then(function(result){
					if(result.value){
						window.location = "supervisores";
					}
				});
			}else{
				swal({
					title: "Error al actualizar supervisor Cod. Error: " + respuesta,
					type: "error",
					confirmButtonText:"¡Cerrar!",
				}).then(function(result){
					if(result.value){
						window.location = "supervisores";
					}
				});
			}
		}
	})

	if(statusSuper == 0)
	{
		$(this).removeClass('btn-primary');
		$(this).addClass('btn-danger');
		$(this).html('Inactivo');
		$(this).attr('statusSuper', 1);
	}
	if(statusSuper == 1)
	{
		$(this).removeClass('btn-danger');
		$(this).addClass('btn-primary');
		$(this).html('Activo');
		$(this).attr('statusSuper', 0);
	}
});
