$(document).on('click','.btnEditarAviso',function(){

	
	var idAviso = $(this).attr("idAviso");

	var datos = new FormData();
	datos.append("idAviso", idAviso);
	datos.append("mostrarAviso", true);

	$.ajax({
		url:"ajax/avisos.ajax.php",
		method: "POST",
		data: datos,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
		
			
			$('#editarTextoAviso').val(respuesta["texto"]);
			$('#idAviso').val(respuesta["id"]);
			if(respuesta["imagen"] != ""){
				$(".previsualizar").attr("src", respuesta["imagen"]);
			}else{
				
				$(".previsualizar").attr("src", "vistas/img/avisos/sin_imagen.png");
				$(".previsualizar").attr("width", "200px");
			}

			
		}
	});
	
});

$('.btnBorrarAviso').click(function(){
	var idAviso = $(this).attr("idAviso");
		swal({
		  title: '¿Eliminar publicacion?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'No',
		  confirmButtonText: 'Si'
		}).then(function(result){
		  if (result.value) {

		  		
		  		var datos = new FormData();
				datos.append("eliminarAviso", true);
				datos.append("idAviso", idAviso);
				

		  		$.ajax({
					url:"ajax/avisos.ajax.php",
					method: "post",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					success: function(respuesta){
						if(respuesta == "ok"){
							swal({
								title: "Publicacion eliminada!",
								type: "success",
								confirmButtonText:"¡Cerrar!",
							}).then(function(result){
								if(result.value){
									window.location = "avisosRecrea";
								}
							});
						}else{
							console.log(respuesta);
							swal({
								title: "Error al tratar de eliminar la publicacion!" + respuesta,
								type: "error",
								confirmButtonText:"¡Cerrar!",
							}).then(function(result){
								if(result.value){
									window.location = "avisosRecrea";
								}
							});
						}
					}
				})
		   
		 	 }
		})

});
