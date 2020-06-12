function traerComentario(fecha, numemp){


	

	var datos = new FormData();
	datos.append("fechaComentario", fecha);
	datos.append("numemp", numemp);
	datos.append("buscarComentario", true);

	$.ajax({
		url:"ajax/control_asistencias.ajax.php",
		method: "post",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			if(respuesta){
				$('#comentarioAsistencia').val(respuesta["comentario"]);
			}else{
				$('#comentarioAsistencia').val("");
			}
		}
	})
}

//var img = "<?php echo 'Realidad3';?>";
 

 