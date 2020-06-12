<?php
	
	class ControladorAvisos{

		static public function ctrMostrarAvisos($item1, $valor1)
		{
			$tabla = "aviso";
			$item2 = "fecha_expiracion";
			$valor2 = date('Y-m-d');
			$respuesta = ModeloAvisos::mdlMostrarAvisos($tabla, $item1, $valor1, $item2, $valor2);
			return $respuesta;
		}

		static public function ctrMostrarAviso($item, $valor)
		{
			$tabla = "aviso";
			$respuesta = ModeloAvisos::mdlMostrarAviso($tabla, $item, $valor);
			return $respuesta;
		}

		static public function ctrEliminarAviso($item, $valor)
		{
			$tabla = "aviso";
			$respuesta = ModeloAvisos::mdlEliminarAviso($tabla, $item, $valor);
			return $respuesta;
		}

		// static public function ctrMostrarCampañasPlaza($item1, $valor1, $item2, $valor2)
		// {
		// 	$tabla = "campana_plaza";
		// 	$respuesta = ModeloCampañas::mdlMostrarCampañasPlaza($tabla, $item1, $valor1, $item2, $valor2);
		// 	return $respuesta;
		// }

		// static public function ctrActivarCampaña($item1, $valor1, $item2, $valor2){

		// 	$tabla = "campana_plaza";
		// 	$respuesta = ModeloCampañas::mdlActivarCampaña($tabla, $item1, $valor1, $item2, $valor2);
		// 	return $respuesta;
			

		// }

		static public function ctrAgregarAviso(){

			if(isset($_POST["fechaExpiracionAviso"])){


					$rutaImagen = "";
					/* VALIDAR IMAGEN */
						if(isset($_FILES["nuevaImagenAviso"]["tmp_name"])){
							
							$año = date('Y');
							$mes = date('m');
							$dia = date('d');
							$hora = date('H');
							$min = date('i');
							$seg = date('s');

							$numemp = $_SESSION["numemp"];
							
							if($_FILES["nuevaImagenAviso"]["type"] == "image/jpeg"){

								
								$rutaImagen = "vistas/img/avisos/".$numemp."___".$año."_".$mes."_".$dia."_".$hora."_".$min."_".$seg.".jpg";
								$tmp_archivo = $_FILES["nuevaImagenAviso"]["tmp_name"];
								move_uploaded_file($tmp_archivo, $rutaImagen);
								
								
							}

							if($_FILES["nuevaImagenAviso"]["type"] == "image/png"){

								
								$rutaImagen = "vistas/img/avisos/".$numemp."___".$año."_".$mes."_".$dia."_".$hora."_".$min."_".$seg.".png";
								$tmp_archivo = $_FILES["nuevaImagenAviso"]["tmp_name"];
								move_uploaded_file($tmp_archivo, $rutaImagen);
								
							}
							

						}
				
					$tabla = "aviso";
					$datos = array("numemp" => $_SESSION["numemp"],
									"texto" => utf8_encode($_POST["textoAviso"]),
									"imagen" => $rutaImagen,
									"plaza" => $_SESSION["idPlaza"],
									"importante" => 1,
									"fecha_exp" => $_POST["fechaExpiracionAviso"]);
					// if($_POST["importante"] == "1")
						$titulo = "AVISO IMPORTANTE EN ATELAPP";
						$mensaje = $_POST["textoAviso"];
						// $tokenUsuarios = ControladorUsuarios::ctrTraerTokens($_SESSION["idPlaza"]);
						// foreach ($tokenUsuarios as $key => $value) {
						// 	sendGCM($mensaje, $value["token"], $titulo);
						// }
						
					
					$respuesta = ModeloAvisos::mdlAgregarAviso($tabla, $datos);
					if($respuesta == "ok"){
								echo '<script>
								swal({
									type: "success",
									title: "¡Se publico el aviso correctamente!",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "avisosRecrea";
									}
								});
								
							 </script>';
					}else{
						echo '<script>
								swal({
									type: "error",
									title: "Error al publicar aviso Cod. Error: '.$respuesta[2].'",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "avisosRecrea";
									}
								});
								
							 </script>';
					}
				}
	
		}

		static public function ctrEditarAviso(){

			if(isset($_POST["editarFechaExpiracionAviso"])){


					$tabla = "aviso";
					$datos = array("idAviso" => $_POST["idEditarAviso"],
									"fecha_exp" => $_POST["editarFechaExpiracionAviso"]);
									
					$respuesta = ModeloAvisos::mdlEditarAviso($tabla, $datos);
					if($respuesta == "ok"){
								echo '<script>
								swal({
									type: "success",
									title: "¡Se edito el aviso correctamente!",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "avisosRecrea";
									}
								});
								
							 </script>';
					}else{
						echo '<script>
								swal({
									type: "error",
									title: "Error al editar aviso Cod. Error: '.$respuesta[2].'",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "avisosRecrea";
									}
								});
								
							 </script>';
					}
				}
	
		}
	}

?>