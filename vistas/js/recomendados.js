
/*======================================
=            EDITAR RECOMENDADO            =
======================================*/
$(document).on('click','.btnInfoRecomendado',function(){

	
	var idRecomendado = $(this).attr("idRecomendado");
	console.log(idRecomendado);
	var datos = new FormData();
	datos.append("buscarRecomendado", true);
	datos.append("idRecomendado", idRecomendado);

	$.ajax({
		url:"ajax/recomienda.ajax.php",
		method: "POST",
		data: datos,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			console.log(respuesta);
			$('#nombreRecomendado').val(respuesta["nombre_recomendado"]);
			$('#telRecomendado').val(respuesta["tel_recomendado"]);
			$('#comentarioContacto').val(respuesta["comentario_contacto"]);
			$('#idRecomendado').val(respuesta["id"]);
			
		}
	});
	

});