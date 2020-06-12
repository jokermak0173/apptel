<?php
	
	class ControladorCampañas{

		static public function ctrMostrarCampaña($item, $valor)
		{
			$tabla = "campana_plaza";
			$respuesta = ModeloCampañas::mdlMostrarCampaña($tabla, $item, $valor);
			return $respuesta;
		}

		static public function ctrMostrarCampañasPlaza($item1, $valor1, $item2, $valor2)
		{
			$tabla = "campana_plaza";
			$respuesta = ModeloCampañas::mdlMostrarCampañasPlaza($tabla, $item1, $valor1, $item2, $valor2);
			return $respuesta;
		}

		static public function ctrActivarCampaña($item1, $valor1, $item2, $valor2){

			$tabla = "campana_plaza";
			$respuesta = ModeloCampañas::mdlActivarCampaña($tabla, $item1, $valor1, $item2, $valor2);
			return $respuesta;
			

		}

		static public function ctrAgregarCampaña(){

			if(isset($_POST["nuevaCampañaAgregar"])){

					$tabla = "campana_plaza";
					$item1 = "campana";
					$valor1 = strtoupper($_POST["nuevaCampañaAgregar"]);
					$item2 = "plaza";
					$valor2 = $_SESSION["idPlaza"];
					$item3 = "activo";
					$valor3 = "1";
					$respuesta = ModeloCampañas::mdlAgregarCampaña($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3);
					if($respuesta == "ok"){
								echo '<script>
								swal({
									type: "success",
									title: "¡La campaña se dio de alta correctamente!",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "campanas";
									}
								});
								
							 </script>';
					}else{
						echo '<script>
								swal({
									type: "error",
									title: "Error al agregar la campaña Cod. Error: '.$respuesta.'",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "campanas";
									}
								});
								
							 </script>';
					}
				
				
			}
			
			

		}
	}

?>