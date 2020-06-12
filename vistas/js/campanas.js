/*=======================================
=            ACTIVAR CAMPAÑA            =
=======================================*/
$(document).on('click','.btnActivarCampaña',function(){
	var idCampaña = $(this).attr("idCampaña");
	var statusCampaña = $(this).attr("statusCampaña");

	var datos = new FormData();
	datos.append("idCampañaActivar", idCampaña);
	datos.append("statusCampaña", statusCampaña);
	datos.append("activarCampaña", true);

	$.ajax({
		url:"ajax/campanas.ajax.php",
		method: "post",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			if(respuesta == "ok"){
				swal({
					title: "La campaña ha sido actualizada correctamente",
					type: "success",
					confirmButtonText:"¡Cerrar!",
				}).then(function(result){
					if(result.value){
						window.location = "campanas";
					}
				});
			}else{
				swal({
					title: "Error al editar campaña Cod. Error: " + respuesta,
					type: "error",
					confirmButtonText:"¡Cerrar!",
				}).then(function(result){
					if(result.value){
						window.location = "campanas";
					}
				});
			}
		}
	})

	if(statusCampaña == 0)
	{
		$(this).removeClass('btn-primary');
		$(this).addClass('btn-danger');
		$(this).html('Inactiva');
		$(this).attr('statusCampaña', 1);
	}
	if(statusCampaña == 1)
	{
		$(this).removeClass('btn-danger');
		$(this).addClass('btn-primary');
		$(this).html('Activa');
		$(this).attr('statusCampaña', 0);
	}
});
