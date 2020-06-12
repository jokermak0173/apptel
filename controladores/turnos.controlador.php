<?php
	
	class ControladorTurnos{

		static public function ctrMostrarTurno($item, $valor)
		{
			$tabla = "turno";
			$respuesta = ModeloTurno::mdlMostrarTurno($tabla, $item, $valor);
			return $respuesta;
		}

		static public function ctrMostrarTurnos()
		{
			$tabla = "turno";
			$respuesta = ModeloTurno::mdlMostrarTurnos($tabla);
			return $respuesta;
		}

		static public function ctrMostrarTurnoPlaza($item, $valor)
		{
			$tabla = "turno";
			$respuesta = ModeloTurno::mdlMostrarTurnoPlaza($tabla, $item, $valor);
			return $respuesta;
		}

		static public function ctrMostrarTurnosPorPlaza($item1, $valor1, $item2, $valor2)
		{
			$tabla = "turno";
			$respuesta = ModeloTurno::mdlMostrarTurnosPorPlaza($tabla, $item1, $valor1, $item2, $valor2);
			return $respuesta;
		}

		static public function ctrActivarTurno($item1, $valor1, $item2, $valor2){
			$tabla = "turno";
			$respuesta = ModeloTurno::mdlActivarTurno($tabla, $item1, $valor1, $item2, $valor2);
			return $respuesta;
		}

		static public function ctrAgregarTurno(){
			if(isset($_POST["nuevaHoraEntrada"])){
				if(isset($_POST["nuevaHoraEntrada"]) && isset($_POST["nuevaHoraSalida"])){

					$hora1 = date("H", strtotime($_POST["nuevaHoraEntrada"]));
					$minuto1 = date("i", strtotime($_POST["nuevaHoraEntrada"]));
					$hora2 = date("H", strtotime($_POST["nuevaHoraSalida"]));
					$minuto2 = date("i", strtotime($_POST["nuevaHoraSalida"]));
					settype($hora1, int);
					settype($minuto1, int);
					settype($hora2, int);
					settype($minuto2, int);

					if( $hora1 >= 0 && $hora1 <= 24 &&  $hora2 >= 0 && $hora2 <= 24 && $minuto1 >= 0 && $minuto1 <= 60 && $minuto2 >= 0 && $minuto2 <= 60) {

						$horarioEntrada = date("H:i", strtotime($_POST["nuevaHoraEntrada"]));
						$horarioSalida = date("H:i", strtotime($_POST["nuevaHoraSalida"]));

						$tabla = "turno";
						$datos = array("entrada" => $horarioEntrada,
									   "salida" => $horarioSalida,
									   "plaza" => $_SESSION["idPlaza"],
									   "estado" => "1" );
						$respuesta = ModeloTurno::mdlAgregarTurno($tabla, $datos);
						if($respuesta == "ok"){
							echo '<script>
							swal({
								type: "success",
								title: "¡El turno se dio de alta correctamente!",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "turnos";
								}
							});
							
						 </script>';
						}else{
							echo '<script>
							swal({
								type: "error",
								title: "Error al agregar turno",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "turnos";
								}
							});
							
						 </script>';
						}
						
					}else{
						echo '<script>
							swal({
								type: "error",
								title: "Hora no valida",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "turnos";
								}
							});
							
						 </script>';
					}


					

				}else{
					echo '<script>
							swal({
								type: "error",
								title: "Debe capturarse ENTRADA y SALIDA",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "turnos";
								}
							});
							
						 </script>';
				}
			}
		}
	}

?>