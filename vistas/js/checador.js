/*====================================================
=            SUBIENDO LA FOTO DEL ASESOR            =
====================================================*/
$('.nuevoArchivoChecador').change(function(){

	var imagen = this.files[0];
	//console.log(imagen["type"]);
	 //VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG/PNG 
	 if(imagen["size"] > 2000000){
		$('.nuevaFoto').val("");
		swal({
			title: "Error al subir el archivo",
			text: "¡El archivo no debe pesar mas de 2 MB!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});
	}else{
	 if( imagen["type"] == "application/vnd.ms-excel"){

			var datosImagen = new FileReader;
			datosImagen.readAsDataURL(imagen);
			$(datosImagen).on("load", function(event){
				
				var rutaImagen = "vistas/img/plantilla/csvImage.svg";
				$('.previsualizar').attr("src", rutaImagen);
			});

		}else{
			$('.nuevoArchivoChecador').val("");
			swal({
				title: "Error al subir el archivo",
				text: "¡El archivo debe tener formato CSV delimitado por comas",
				type: "error",
				confirmButtonText: "¡Cerrar!"
			});
		}
	}

	


});

function mostrarPreloaderChecador(){
	if($('.nuevoArchivoChecador').val().length > 0 ){
		$('.spinnerLogin').show();
	}
	
		
	//console.log($('.nuevoArchivoChecador').val().length);
}
// $('#btnVerFecha').click(function(){

// 	var fecha = $('#dtAnularBaseChecador').val();
// 	$('#mostrarFecha').val(fecha);
// });