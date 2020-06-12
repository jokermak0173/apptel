

$(document).on('click','.btnRecomendar',function(){
	var numEmp = $(this).attr('numEmp');
	var nombreRecomendado = $("#nombreRecomendado").val();
	var telRecomendado = $("#telRecomendado").val();
	var comentarioContacto = $("#comentarioContacto").val();


	if(telRecomendado.length == 10 && nombreRecomendado.length > 0){
			swal({
		  html: '<h3>¿Estas seguro que quieres recomendar a <b>' + nombreRecomendado.toUpperCase() + '</b> ?</h3>',
		

		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'No',
		  confirmButtonText: 'Si'
		 
		}).then(function (result) {
		  if (result.value) {

		  			var datos = new FormData();
		  			datos.append("enviarRecomendado", true);
					datos.append("numEmp", numEmp);
					datos.append("nombreRecomendado", nombreRecomendado);
					datos.append("telRecomendado", telRecomendado);
					datos.append("comentarioContacto", comentarioContacto);
		
			 		$.ajax({
						url:"ajax/recomienda.ajax.php",
						method: "post",
						data: datos,
						cache: false,
						contentType: false,
						processData: false,
						dataType: 'json',
						success: function(respuesta){

							if(respuesta == 1){
								swal({
									title: "Se envio tu recomendado correctamente",
									type: "success",
									confirmButtonText:"¡Cerrar!",
								}).then(function(result){
									if(result.value){
										window.location = "recomienda";
									}
								});
							}
							else{
								swal({
									title: "Error al enviar recomendado Cod. Error: " + respuesta,
									type: "error",
									confirmButtonText:"¡Cerrar!",
								}).then(function(result){
									if(result.value){
										window.location = "recomienda";
									}
								});
							}
											
										
						}
					})

			 

		  		}
		   
		 	 })
	}else{
		swal("Cel/Tel 10 digitos & nombre no vacio");
	}

})

