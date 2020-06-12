$(document).on('click','.btnBorrarPermuta',function(){
		
		var idPermuta = $("#idPermuta").val();
		swal({
		  title: '¿Borrar Permuta?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'No',
		  confirmButtonText: 'Si'
		}).then(function(result){
		  if (result.value) {

		  		var datos = new FormData();
				datos.append("borrarPermuta", true);
				datos.append("idPermuta", idPermuta);
				

		  		$.ajax({
					url:"ajax/permutas.ajax.php",
					method: "post",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					success: function(respuesta){
						if(respuesta == "eliminada"){
							swal({
								title: "Permuta borrada!",
								type: "success",
								confirmButtonText:"¡Cerrar!",
							}).then(function(result){
								if(result.value){
									window.location = "crear-permuta";
								}
							});
						}else if(respuesta == "aceptada"){
							swal({
								title: "No permitido borrar permutas aceptadas",
								type: "error",
								confirmButtonText:"¡Cerrar!",
							}).then(function(result){
								if(result.value){
									window.location = "crear-permuta";
								}
							});
						}
						else{
							swal({
								title: "Error: " + respuesta[2],
								type: "error",
								confirmButtonText:"¡Cerrar!",
							}).then(function(result){
								if(result.value){
									window.location = "crear-permuta";
								}
							});
						}
					}
				})
		   
		 	 }
		})

});