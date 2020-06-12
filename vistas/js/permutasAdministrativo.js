

$(".tablas").on("click", ".btnAutorizarPermuta", function(){

	idPermuta = $(this).attr("idPermuta");
	reviso = $(this).attr("reviso");
	swal({
		  title: '¿Autorizar Permuta?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'No',
		  confirmButtonText: 'Si'
		}).then(function(result){
		  if (result.value) {

		  		
		  		var datos = new FormData();
				datos.append("autorizarPermuta", true);
				datos.append("idPermuta", idPermuta);
				datos.append("reviso", reviso);
				

		  		$.ajax({
					url:"ajax/permutas.ajax.php",
					method: "post",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					success: function(respuesta){
						if(respuesta == "ok"){
							swal({
								title: "Permuta Autorizada!",
								type: "success",
								confirmButtonText:"¡Cerrar!",
							}).then(function(result){
								if(result.value){
									window.location = "permutasAdministrativo";
								}
							});
						}else{
							swal({
								title: "Error al tratar de autorizar la permuta!" + respuesta,
								type: "error",
								confirmButtonText:"¡Cerrar!",
							}).then(function(result){
								if(result.value){
									window.location = "permutasAdministrativo";
								}
							});
						}
					}
				})
		   
		 	 }
		})

})

$(".tablas").on("click", ".btnDenegarPermuta", function(){

	idPermuta = $(this).attr("idPermuta");
	reviso = $(this).attr("reviso");
	
	swal({
		  title: '¿Denegar Permuta?',
		  text: 'Escribe razón',
		  html:
		  	'<h5>Escribe razón</h5>'+
		    '<input id="swal-input1" class="swal2-input">',

		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'No',
		  confirmButtonText: 'Si',
		 
		  onOpen: function () {
		    $('#swal-input1').focus()
		  }
		}).then(function (result) {
		  if (result.value) {

		  		comentario = $('#swal-input1').val();
		  		if(comentario.length > 0 ){
		  		var datos = new FormData();
				datos.append("denegarPermuta", true);
				datos.append("idPermuta", idPermuta);
				datos.append("reviso", reviso);
				datos.append("comentario", comentario);

		  		$.ajax({
					url:"ajax/permutas.ajax.php",
					method: "post",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					success: function(respuesta){
						if(respuesta == "ok"){
							swal({
								title: "Permuta Denegada!",
								type: "success",
								confirmButtonText:"¡Cerrar!",
							}).then(function(result){
								if(result.value){
									window.location = "permutasAdministrativo";
								}
							});
						}else{
							swal({
								title: "Error al tratar de denegar la permuta!" + respuesta,
								type: "error",
								confirmButtonText:"¡Cerrar!",
							}).then(function(result){
								if(result.value){
									window.location = "permutasAdministrativo";
								}
							});
						}
					}
				})

		  		}else{
		  			swal({
						title: "Tienes que añadir un comentario!",
						type: "error",
						confirmButtonText:"¡Cerrar!",
					}).then(function(result){
						if(result.value){
							window.location = "permutasAdministrativo";
						}
					});
		  		}
		   
		 	 }
		})

})

$(".tablas").on("click", ".btnCancelarPermuta", function(){

	idPermuta = $(this).attr("idPermuta");
	reviso = $(this).attr("reviso");
	
	swal({
		  title: '¿Cancelar Permuta?',
		  text: 'Escribe razón',
		  html:
		  	'<h5>Escribe razón</h5>'+
		    '<input id="swal-inputCancelarPermuta" class="swal2-input">',

		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'No',
		  confirmButtonText: 'Si',
		 
		  onOpen: function () {
		    $('#swal-inputCancelarPermuta').focus()
		  }
		}).then(function (result) {
		  if (result.value) {

		  		comentario = $('#swal-inputCancelarPermuta').val();
		  		if(comentario.length > 0 ){
		  		var datos = new FormData();
				datos.append("cancelarPermuta", true);
				datos.append("idPermuta", idPermuta);
				datos.append("reviso", reviso);
				datos.append("comentario", comentario);

		  	
		  		$.ajax({
					url:"ajax/permutas.ajax.php",
					method: "post",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					success: function(respuesta){
						if(respuesta == "ok"){
							swal({
								title: "Permuta Cancelada!",
								type: "success",
								confirmButtonText:"¡Cerrar!",
							}).then(function(result){
								if(result.value){
									window.location = "permutasAutorizadas";
								}
							});
						}else{
							swal({
								title: "Error al tratar de cancelar la permuta!" + respuesta,
								type: "error",
								confirmButtonText:"¡Cerrar!",
							}).then(function(result){
								if(result.value){
									window.location = "permutasAutorizadas";
								}
							});
						}
					}
				})
		  		}else{
		  			swal({
								title: "Tienes que añadir un comentario!",
								type: "error",
								confirmButtonText:"¡Cerrar!",
							}).then(function(result){
								if(result.value){
									window.location = "permutasAdministrativo";
								}
							});
		  		}
		
		   
		 	 }
		})

})

$(".tablas").on("click", ".btnValidarPermutaSolicita", function(){

	asesorSolicita = $(this).attr("asesorSolicita");
	fechaPermuta = $(this).attr("fechaPermuta");
	nombreCompleto = $(this).attr("nombreCompleto");
	
  		
		  		var datos = new FormData();
				datos.append("validarPermuta", true);
				datos.append("asesorSolicita", asesorSolicita);
				datos.append("fechaPermuta", fechaPermuta);
				
				
		  		$.ajax({
					url:"ajax/permutas.ajax.php",
					method: "post",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					dataType: 'json',
					success: function(respuesta){
						var aceptadas = 0;
						var enviadas = 0;
						var autorizadas = 0;
						var canceladas = 0;
						var denegadas = 0;

						
						for(var i = 0; i < respuesta.length; i++){
							switch(respuesta[i]["estado"]){
								case 'enviada' : enviadas += parseInt(respuesta[i]["TOTAL"]); break;
								case 'aceptada' : aceptadas += parseInt(respuesta[i]["TOTAL"]); break;
								case 'autorizada' : autorizadas += parseInt(respuesta[i]["TOTAL"]); break;
								case 'cancelada' : canceladas += parseInt(respuesta[i]["TOTAL"]); break;
								case 'denegada' : denegadas += parseInt(respuesta[i]["TOTAL"]); break;
							}
						}
						

						swal({
						  title: 'Permutas de ' + nombreCompleto + ' para ' + fechaPermuta,
						
						  html:
						  	'<b>Enviadas</b>: ' + enviadas +
						  	'<br><b>Aceptadas</b>: ' + aceptadas +
						  	'<br><b>Autorizadas</b>: ' + autorizadas +
						  	'<br><b>Denegadas</b>: ' + denegadas +
						  	'<br><b>Canceladas</b>: ' + canceladas,

						  type: 'warning',
						 
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK',
						 
						  
						})


					}
				})

})

$(".tablas").on("click", ".btnValidarPermutaAcepta", function(){

	asesorSolicita = $(this).attr("asesorSolicita");
	fechaPermuta = $(this).attr("fechaPermuta");
	nombreCompleto = $(this).attr("nombreCompleto");
	
  		
		  		var datos = new FormData();
				datos.append("validarPermuta", true);
				datos.append("asesorSolicita", asesorSolicita);
				datos.append("fechaPermuta", fechaPermuta);
				
				
		  		$.ajax({
					url:"ajax/permutas.ajax.php",
					method: "post",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					dataType: 'json',
					success: function(respuesta){
						var aceptadas = 0;
						var enviadas = 0;
						var autorizadas = 0;
						var canceladas = 0;
						var denegadas = 0;

						
						for(var i = 0; i < respuesta.length; i++){
							switch(respuesta[i]["estado"]){
								case 'enviada' : enviadas += parseInt(respuesta[i]["TOTAL"]); break;
								case 'aceptada' : aceptadas += parseInt(respuesta[i]["TOTAL"]); break;
								case 'autorizada' : autorizadas += parseInt(respuesta[i]["TOTAL"]); break;
								case 'cancelada' : canceladas += parseInt(respuesta[i]["TOTAL"]); break;
								case 'denegada' : denegadas += parseInt(respuesta[i]["TOTAL"]); break;
							}
						}
						

						swal({
						    title: 'Permutas de ' + nombreCompleto + ' para ' + fechaPermuta,
						
						  html:
						  	'<b>Enviadas</b>: ' + enviadas +
						  	'<br><b>Aceptadas</b>: ' + aceptadas +
						  	'<br><b>Autorizadas</b>: ' + autorizadas +
						  	'<br><b>Denegadas</b>: ' + denegadas +
						  	'<br><b>Canceladas</b>: ' + canceladas,

						  type: 'warning',
						 
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK',
						 
						  
						})


					}
				})

})

$(".tablas").on("click", ".btnInfoPermutaAdministrativo", function(){
	
	tipoPermuta = $(this).attr("tipoPermuta");
	asesorSolicita = $(this).attr("asesorSolicita");
	asesorAcepta = $(this).attr("asesorAcepta");
	supervisorSolicita = $(this).attr("supervisorSolicita");
	supervisorAcepta = $(this).attr("supervisorAcepta");
	turnoSolicita = $(this).attr("turnoSolicita");
	turnoAcepta = $(this).attr("turnoAcepta");
	fechaPermuta = $(this).attr("fechaPermuta");
	fechaCierre = $(this).attr("fechaCierre");
	turnoCubreSolcita = $(this).attr("turnoCubreSolcita");
	turnoCubreAcepta = $(this).attr("turnoCubreAcepta");
	fechaLanzamiento = $(this).attr("fechaLanzamiento");
	fechaAceptacion = $(this).attr("fechaAceptacion");

	if(tipoPermuta == 1)
	{
		swal({
			
			title: 'Permuta dia x dia',
			text: 'Detalle',
			html: '<span style="font-size:15px"><b>Asesor solicita: </b>' + asesorSolicita +
				  '<br><b>Turno solicita: </b>' + turnoSolicita +
				  '<br><b>Supervisor solicita: </b>' + supervisorSolicita +
				  '<br><b>Asesor acepta: </b>' + asesorAcepta +
				  '<br><b>Turno acepta: </b>' + turnoAcepta +
				  '<br><b>Supervior acepta: </b>' + supervisorAcepta +
				  '<br><b>Fecha permuta abre: </b>' + fechaPermuta +
				  '<br><b>Fecha permuta cierra: </b>' + fechaCierre +
				  '<br><b>Fecha lanzamiento: </b>' + fechaLanzamiento +
				  '<br><b>Fecha aceptacion: </b>' + fechaAceptacion

				  ,

			showCancelButton: true,
			showConfirmButton: false,
			cancelButtonColor: '#3085d6',
			cancelButtonText: 'Ok',
					  
					 
					  
		})
	}else if(tipoPermuta == 3){
		swal({
			
			title: 'Permuta Libre',
			text: 'Detalle',
			html: '<span style="font-size:15px"><b>Asesor solicita: </b>' + asesorSolicita +
				  '<br><b>Turno solicita: </b>' + turnoSolicita +
				  '<br><b>Supervisor solicita: </b>' + supervisorSolicita +
				  '<br><b>Asesor acepta: </b>' + asesorAcepta +
				  '<br><b>Turno acepta: </b>' + turnoAcepta +
				  '<br><b>Supervior acepta: </b>' + supervisorAcepta +
				  '<br><b>Fecha permuta: </b>' + fechaPermuta +
				  '<br><b>Fecha lanzamiento: </b>' + fechaLanzamiento +
				  '<br><b>Fecha aceptacion: </b>' + fechaAceptacion + 
				  '<br><b>Turno viene solicita: </b>' + turnoCubreSolcita + 
				  '<br><b>Turno viene acepta: </b>' + turnoCubreAcepta


				  ,

			showCancelButton: true,
			showConfirmButton: false,
			cancelButtonColor: '#3085d6',
			cancelButtonText: 'Ok',
					  
					 
					  
		})
	} else if(tipoPermuta == 2){
		swal({
			
			text: 'Detalle',
			html: '<span style="font-size:15px"><b>Asesor solicita: </b>' + asesorSolicita +
				  '<br><b>Turno solicita: </b>' + turnoSolicita +
				  '<br><b>Supervisor solicita: </b>' + supervisorSolicita +
				  '<br><b>Asesor acepta: </b>' + asesorAcepta +
				  '<br><b>Turno acepta: </b>' + turnoAcepta +
				  '<br><b>Supervior acepta: </b>' + supervisorAcepta +
				  '<br><b>Fecha permuta: </b>' + fechaPermuta +
				  '<br><b>Fecha lanzamiento: </b>' + fechaLanzamiento +
				  '<br><b>Fecha aceptacion: </b>' + fechaAceptacion

				  ,

			showCancelButton: true,
			showConfirmButton: false,
			cancelButtonColor: '#3085d6',
			cancelButtonText: 'Ok',
					  
					 
					  
		})
	}

		
	
})

