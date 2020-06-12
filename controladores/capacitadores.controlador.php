<?php
	class ControladorCapacitadores{

		static public function ctrMostrarCapacitadores($item1, $valor1, $item2, $valor2){
			$tabla = "capacitador";
			$respuesta = ModeloCapacitadores::mdlMostrarCapacitadores($tabla, $item1, $valor1, $item2, $valor2);
			return $respuesta;
		}

		static public function ctrMostrarCapacitadorPorId($item1, $valor1){
			$tabla = "capacitador";
			$respuesta = ModeloCapacitadores::mdlMostrarCapacitadorPorId($tabla, $item1, $valor1);
			return $respuesta;
		}

		static public function ctrAgregarCapacitador(){

			if(isset($_POST["nuevoCapa"]))
			{
				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCapa"]) && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["paternoCapa"])){

					$tabla = "capacitador";
					$datos = array("paterno" => utf8_encode($_POST["paternoCapa"]),
									"materno" => utf8_encode($_POST["maternoCapa"]),
									"nombre" => utf8_encode($_POST["nuevoCapa"]),
									"plaza" => $_SESSION["idPlaza"],
									"estado" => "1");
					$respuesta = ModeloCapacitadores::mdlAgregarCapacitador($tabla, $datos);

					if($respuesta == "ok"){
						echo '<script>
							swal({
								type: "success",
								title: "¡El capacitador ha sido agregado correctamente!",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "capacitadores";
									
								}
							});
							
						 </script>';
					}else{
						echo '<script>
							swal({
								type: "error",
								title: "¡Error al agregars, Cod. Err: '.$respuesta[1].' !",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "capacitadores";
									
								}
							});
							
						 </script>';
					}

				}else{
					echo '<script>
							swal({
								type: "error",
								title: "¡Nombre y Apellidos no pueden ir vac o llevar caracteres especiales!",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "usuariosSistemas";
								}
							});							
						 </script>';
				}
			}

		}

		static public function ctrActivarCapacitador($item1, $valor1, $item2, $valor2){
			$tabla = "capacitador";
			$respuesta = ModeloCapacitadores::mdlActivarCapacitador($tabla, $item1, $valor1, $item2, $valor2);
			return $respuesta;
		}
	}
?>