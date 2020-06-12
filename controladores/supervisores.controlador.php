<?php
	
	class ControladorSupervisores{

		/*==========================================
		=           MOSTRAR SUPERVISORES         =
		==========================================*/
		
		static public function ctrMostrarSupervisores($item1, $valor1, $item2, $valor2, $item3, $valor3){
			
					
			$tabla = "supervisor";
			$respuesta = ModeloSupervisores::mdlMostrarSupervisores($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3);
			return $respuesta;
			
		}

		static public function ctrMostrarSupervisor($item1, $valor1){
			
					
			$tabla = "supervisor";
			$respuesta = ModeloSupervisores::mdlMostrarSupervisor($tabla, $item1, $valor1);
			return $respuesta;
			
		}

		static public function ctrActivarSupervisor($item1, $valor1, $item2, $valor2){
			$tabla = "supervisor";
			$respuesta = ModeloSupervisores::mdlActivarSupervisor($tabla, $item1, $valor1, $item2, $valor2);
			return $respuesta;
		}
		
		static public function ctrAgregarSupervisor(){
			if(isset($_POST["nuevoSuper"]))
			{
				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoSuper"]))
				{
					if(isset($_POST["nuevaCampana"])){
						$tabla = "supervisor";
						$datos = array("paterno" => utf8_encode(ucwords($_POST["paternoSuper"])),
										"materno" => utf8_encode(ucwords($_POST["maternoSuper"])),
										"nombre" => utf8_encode(ucwords($_POST["nuevoSuper"])),
										"campana" => $_POST["nuevaCampana"],
										"plaza" => $_SESSION["idPlaza"],
										"estado" => "1" );
						$respuesta = ModeloSupervisores::mdlAgregarSupervisor($tabla, $datos);
						if($respuesta == "ok"){
							echo '<script>
							swal({
								type: "success",
								title: "¡El supervisor se dio de alta correctamente!",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "supervisores";
								}
							});
							
						 </script>';
						}else{
							echo '<script>
							swal({
								type: "error",
								title: "Error al agregar supervisor Cod. Err: '.$respuesta[2].'",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "supervisores";
								}
							});
							
						 </script>';
						}
					}else{
						echo '<script>
							swal({
								type: "error",
								title: "¡No puedes agregar un Supervisor sin asignarle una campaña!",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "supervisores";
								}
							});
							
						 </script>';
					}
				}else{
					echo '<script>
							swal({
								type: "error",
								title: "¡El NOMBRE no puede ir vacio o llevar caracteres especiales!",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "supervisores";
								}
							});
							
						 </script>';
				}
			}
		}
		
	}

?>