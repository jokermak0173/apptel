

$(document).on('click','.btnConsolidarPermuta',function(){
	var idPermuta = $(this).attr('idPermuta');
	var numEmp = $(this).attr('numEmp');
	var fechaPermuta = $(this).attr('fechaPermuta');
			swal({
		  title: 'Para aceptar la permuta, confirma con tu password',
		
		  html:
		  	'<p><b>Importante: </b> Al aceptar la permuta por este medio, estoy aceptando cumplir con los terminos que estan establecidos en la permuta. Esta permuta esta sujeta a autorizacion por parte del auxiliar de la campaña y hasta que no se autorice, no serà valida. Ya no sera necesario ir a firmar, y al ingresar tu password este se considera tu firma para tal fin.  </p>'+
		  	'<h5><b>Ingresa tu password si estas de acuerdo</b></h5>'+
		    '<input id="swal-passAsesor" type="password" class="swal2-input">',

		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'No estoy de acuerdo',
		  confirmButtonText: 'Estoy de acuerdo',
		 
		  onOpen: function () {
		    $('#swal-passAsesor').focus()
		  }
		}).then(function (result) {
		

		  if (result.value) {

		  		password = $('#swal-passAsesor').val();
		  		if(password.length > 0 ){
		  			passwordEncriptado = CryptoJS.MD5(password);
		  			var datos = new FormData();
					datos.append("validarAsesor", numEmp);
		
			 		$.ajax({
						url:"ajax/usuarios.ajax.php",
						method: "post",
						data: datos,
						cache: false,
						contentType: false,
						processData: false,
						dataType: "json",
						success: function(respuesta){

							if(passwordEncriptado == respuesta["password"]){
								var datos = new FormData();
								datos.append("buscarPermutasDia", true);
								datos.append("fecha", fechaPermuta);
								datos.append("numemp", numEmp);

						 		$.ajax({
									url:"ajax/permutas.ajax.php",
									method: "post",
									data: datos,
									cache: false,
									contentType: false,
									processData: false,
									dataType: "json",
									success: function(respuesta){
											
											if(respuesta.length > 0)
											{
												swal({
													title: "Ya tienes permuta en status de enviada, aceptada o autorizada para ese dia",
													type: "error",
													confirmButtonText:"¡Cerrar!",
												}).then(function(result){
													if(result.value){
														window.location = "ver-permutas";
													}
												});
											}else{
												var datos = new FormData();
												datos.append("buscarPermuta", true);
												datos.append("idPermuta", idPermuta);

												

										 		$.ajax({
													url:"ajax/permutas.ajax.php",
													method: "post",
													data: datos,
													cache: false,
													contentType: false,
													processData: false,
													dataType: "json",
													success: function(respuesta){
														if(respuesta["estado"] == "enviada"){
															var datos = new FormData();
															datos.append("consolidarPermuta", true);
															datos.append("numEmp", numEmp);
															datos.append("idPermuta", idPermuta);
															// console.log(numemp + " " + " hoka");
													  		$.ajax({
																url:"ajax/permutas.ajax.php",
																method: "post",
																data: datos,
																cache: false,
																contentType: false,
																processData: false,
																dataType: "json",
																success: function(respuesta){
																	console.log(respuesta)
																	if(respuesta == "ok"){
																		swal({
																			title: "Hecho, deben esperar la autorizacion del auxiliar de su campaña!",
																			type: "success",
																			confirmButtonText:"¡Cerrar!",
																		}).then(function(result){
																			if(result.value){
																				window.location = "ver-permutas";
																			}
																		});
																	}else{
																		console.log(respuesta)
																		swal({
																			title: "Error al consolidar permuta! Cod = " + respuesta[2],
																			type: "error",
																			confirmButtonText:"¡Cerrar!",
																		}).then(function(result){
																			if(result.value){
																				window.location = "ver-permutas";
																			}
																		});
																	}
																}
															})
														}else{
															swal({
																title: "Te ganaron la permuta :(",
																type: "error",
																confirmButtonText:"¡Cerrar!",
															}).then(function(result){
																if(result.value){
																	window.location = "ver-permutas";
																}
															});
														}
													}
												})
											}

											
									 	}
									
								})
								
							}else{
								swal({
									title: "Password incorrecto!",
									type: "error",
									confirmButtonText:"¡Cerrar!",
								}).then(function(result){
									if(result.value){
										window.location = "ver-permutas";
									}
								});
							}
						}
					})

			 

		  		}else{
		  			swal({
						title: "Tienes que ingresar tu password para aceptar la permuta!",
						type: "error",
						confirmButtonText:"¡Cerrar!",
					}).then(function(result){
						if(result.value){
							window.location = "ver-permutas";
						}
					});
		  		}
		   
		 	 }
		})
	})

UTF8 = {
	encode: function(s){
		for(var c, i = -1, l = (s = s.split("")).length, o = String.fromCharCode; ++i < l;
			s[i] = (c = s[i].charCodeAt(0)) >= 127 ? o(0xc0 | (c >>> 6)) + o(0x80 | (c & 0x3f)) : s[i]
		);
		return s.join("");
	},
	decode: function(s){
		for(var a, b, i = -1, l = (s = s.split("")).length, o = String.fromCharCode, c = "charCodeAt"; ++i < l;
			((a = s[i][c](0)) & 0x80) &&
			(s[i] = (a & 0xfc) == 0xc0 && ((b = s[i + 1][c](0)) & 0xc0) == 0x80 ?
			o(((a & 0x03) << 6) + (b & 0x3f)) : o(128), s[++i] = "")
		);
		return s.join("");
	}
};



$(document).on('click','.btnInfoPermuta',function(){
	idPermuta = $(this).attr("idPermuta");

	var datos = new FormData();
	datos.append("buscarPermuta", true);
	datos.append("idPermuta", idPermuta);

	$.ajax({
		url:"ajax/permutas.ajax.php",
		method: "post",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){
			
			if(respuesta["estado"] == "aceptada"){
				Swal.fire('Tienes que esperar a que el Aux. de tu campaña autorice la permuta');
			}else if(respuesta["estado"] == "autorizada" || respuesta["estado"] == "denegada" || respuesta["estado"] == "cancelada"){

				swal({
				  title: 'Info Permuta',
				  text: 'Escribe razón',
				  html:
				 	'<label>Revisó</label>'+
				    '<input id="swal-inputReviso" class="swal2-input" readonly>'+
				    '<label>Fecha revisón</label>'+
				    '<input id="swal-inputFechaRevision" class="swal2-input" readonly>'+
				  	'<label>Comentario</label>'+
				    '<textarea id="swal-inputComentario" class="swal2-input" readonly rows="50"></textarea>',

				  showCancelButton: true,
				  showConfirmButton: false,
				  cancelButtonColor: '#3085d6',
				  cancelButtonText: 'Ok',
				  
				 
				  onOpen: function () {
				    $('#swal-inputComentario').val(respuesta["comentario"])
				    $('#swal-inputFechaRevision').val(respuesta["fecha_revision"])
				    

				    var datos = new FormData();
					datos.append("validarAsesor", respuesta["reviso"]);
				    $.ajax({
					url:"ajax/usuarios.ajax.php",
					method: "post",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					dataType: 'json',
					success: function(respuesta){
						$('#swal-inputReviso').val(UTF8.decode(respuesta["nombre_completo"]));	
					}
				})
				  }
				})
		  	}

		}
	})
	
})

$(document).on('click','.btnInfoExtraPermuta',function(){
	
	tipoPermuta = $(this).attr("tipoPermuta");
	fechaPermuta = $(this).attr("fechaPermuta");
	fechaCierre = $(this).attr("fechaCierre");
	turnoCubro = $(this).attr("turnoCubro");
	turnoMeCubren = $(this).attr("turnoMeCubren");

	if(tipoPermuta == 1){
		swal({
			
			text: 'Detalle',
			html: '<span style="font-size:20px"><b>Fecha cubres: </b>' + fechaPermuta +
				  '<br><b>Fecha te cubre: </b>' + fechaCierre + "</span>",

			showCancelButton: true,
			showConfirmButton: false,
			cancelButtonColor: '#3085d6',
			cancelButtonText: 'Ok',
					  
					 
					  
		})
	}
	else if(tipoPermuta == 3){
		swal({
			
			text: 'Detalle',
			html: '<span style="font-size:20px"><b>Turno tu vienes: </b>' + turnoMeCubren +
				  '<br><b>Turno el/ella viene: </b>' + turnoCubro + "</span>",

			showCancelButton: true,
			showConfirmButton: false,
			cancelButtonColor: '#3085d6',
			cancelButtonText: 'Ok',
					  
					 
					  
		})
	}


	
	
})

$(document).ready(function(){
        

/*==================================
=            DATA TABLE            =
==================================*/

$(".tablas").DataTable({
	"language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}

	});


});