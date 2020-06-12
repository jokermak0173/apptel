<?php

	class ControladorPermutas{



		public function ctrEnviarPermuta($item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4, $item5, $valor5, $item6, $valor6, $item7, $valor7, $item8, $valor8, $item9, $valor9, $item10, $valor10, $item11, $valor11){


			$tabla = "principal_permutas";

			$respuesta = ModeloPermutas::mdlEnviarPermuta($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4, $item5, $valor5, $item6, $valor6, $item7, $valor7, $item8, $valor8, $item9, $valor9, $item10, $valor10, $item11, $valor11);
			return $respuesta;

		}

		static public function ctrBuscarPermutasCalendario($valor1){
			$tabla = "principal_permutas";
			$respuesta = ModeloPermutas::mdlBuscarPermutasCalendario($tabla, $valor1);
			return $respuesta;
		}

		static public function ctrBuscarEvento($item1, $valor1, $item2, $valor2)
		{
			$tabla = "principal_permutas";
			$respuesta = ModeloPermutas::mdlBuscarEvento($tabla, $item1, $valor1, $item2, $valor2);
			return $respuesta;
		}

		static public function ctrBuscarEventoRepetido($item1, $valor1, $item2, $valor2)
		{
			$tabla = "principal_permutas";
			$respuesta = ModeloPermutas::mdlBuscarEventoRepetido($tabla, $item1, $valor1, $item2, $valor2);
			return $respuesta;
		}

		static public function ctrMostrarPermutas($item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4)
		{
			$tabla = "principal_permutas";
			$respuesta = ModeloPermutas::mdlMostrarPermutas($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);
			return $respuesta;
		}

		static public function ctrMostrarPermutasDia($item1, $valor1, $valor2)
		{
			$tabla = "principal_permutas";
			$respuesta = ModeloPermutas::mdlMostrarPermutasDia($tabla, $item1, $valor1, $valor2);
			return $respuesta;
		}

		static public function ctrMostrarPermutasQueAcepte($item1, $valor1, $item2, $item3, $valor3)
		{
			$tabla = "principal_permutas";
			$respuesta = ModeloPermutas::mdlMostrarPermutasQueAcepte($tabla, $item1, $valor1, $item2, $item3, $valor3);
			return $respuesta;
		}

		static public function ctrConsolidarPermuta($item1, $valor1, $item2, $valor2)
		{
			$tabla_usuario = "usuario";
			$item = "numemp";

			$asesor = ModeloUsuarios:: mdlMostrarAsesorPorId($tabla_usuario, $item, $valor1);

			$tabla_supervisor = "supervisor";
			$valorSupervisor = $asesor["supervisor"];
			$item = "id";
			$supervisor = ModeloSupervisores::mdlMostrarSupervisor($tabla_supervisor, $item, $valorSupervisor);

			$tabla =  "principal_permutas";
			$item3 = "supervisor_acepta";
			$valor3 = utf8_encode($supervisor["nombre"])." ".utf8_encode($supervisor["apellido_paterno"])." ".utf8_encode($supervisor["apellido_materno"]);
			$item4 = "fecha_acepta";
			$valor4 = date('Y-m-d H:i:s');
			$item5 = "estado";
			$valor5 = "aceptada";

			// $ar = fopen("archivoPermutas1.txt", "w");
			// fwrite($ar, $hola);
			// fclose($ar);

			$respuesta = ModeloPermutas::mdlConsolidarPermuta($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4, $item5, $valor5);
			return $respuesta;
		}

		static public function ctrMostrarPermutaPorId($item1, $valor1)
		{
			$tabla = "principal_permutas";
			$respuesta = ModeloPermutas::mdlMostrarPermutaPorId($tabla, $item1, $valor1);
			return $respuesta;
		}

		static public function ctrBorrarPermuta($item1, $valor1){
			$tabla = "principal_permutas";
			$respuesta = ModeloPermutas::mdlBorrarPermuta($tabla, $item1, $valor1);
			return $respuesta;
		}

		static public function ctrValidarPermuta($item1, $valor1, $item2, $valor2){
			$tabla = "principal_permutas";
			$respuesta = ModeloPermutas::mdlValidarPermuta($tabla, $item1, $valor1, $item2, $valor2);
			return $respuesta;
		}

		static public function ctrCancelarPermuta($item1, $valor1, $valor2, $valor3){
			$tabla = "principal_permutas";
			$fecha = date('Y-m-d H:i:s');
			$respuesta = ModeloPermutas::mdlCancelarPermuta($tabla, $item1, $valor1, $valor2, $valor3, $fecha);
			return $respuesta;
		}

		static public function ctrAutorizarPermuta($item1, $valor1, $valor2){
			$tabla = "principal_permutas";
			$fecha = date('Y-m-d H:i:s');
			$respuesta = ModeloPermutas::mdlAutorizarPermuta($tabla, $item1, $valor1, $valor2, $fecha);
			return $respuesta;
		}

		static public function ctrDenegarPermuta($item1, $valor1, $valor2, $valor3){
			$tabla = "principal_permutas";
			$fecha = date('Y-m-d H:i:s');
			$respuesta = ModeloPermutas::mdlDenegarPermuta($tabla, $item1, $valor1, $valor2, $valor3, $fecha);
			return $respuesta;
		}

		static public function ctrEditarFechaCubro(){
			if(isset($_POST["idPermuta"]) && isset($_POST["fechaPermutaCubro"])){

				$tabla = "principal_permutas";
				$item = "id";
				$valor = $_POST["idPermuta"];
				$respuesta = ModeloPermutas::mdlMostrarPermutaPorId($tabla, $item, $valor);
				if($respuesta["tipo_permuta"] == 1){

					if($respuesta["estado"] == "enviada"){
						$fechaFinal = date('Y-m-d', strtotime($_POST["fechaPermutaCubro"]));
						$tabla = "principal_permutas";
						$item1 = "id";
						$valor1= $_POST["idPermuta"];
						$item2 = "fecha_cierre";
						$valor2 = $fechaFinal;
						$respuesta = ModeloPermutas::mdlActualizarPermuta($tabla, $item1, $valor1, $item2, $valor2);
						if($respuesta == "ok"){
							echo '<script>
										swal({
											type: "success",
											title: "¡Fecha de cierre cambiada correctamente!",
											showConfirmbutton: true,
											confirmButtonText: "Cerrar",
											closeOnConfirm: false
										}).then(function(result){
											if(result.value){
												window.location = "crear-permuta";
											}
										});

								 </script>';
						}else{
							echo '<script>
									swal({
										type: "error",
										title: "¡Error al actualizar fecha Err# '.$respuesta.'",
										showConfirmbutton: true,
										confirmButtonText: "Cerrar",
										closeOnConfirm: false
									}).then(function(result){
										if(result.value){
											window.location = "crear-permuta";
										}
									});
									 </script>';
					}
				}else{
					echo '<script>
								swal({
									type: "error",
									title: "Una vez que te acepten la permuta NO se puede modificar la fecha de cierre",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "crear-permuta";
									}
								});
								 </script>';
				}


				}else{
					echo '<script>
								swal({
									type: "error",
									title: "Tipo de permuta no permite modificaciones solo DIA X DIA",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "crear-permuta";
									}
								});
								 </script>';
				}




			}




		}


		static public function ctrDescargarReporte(){

			if(isset($_POST["fechaInicio"]) && isset($_POST["fechaFin"])){
				$tabla = "principal_permutas";
				$fecha1 = $_POST["fechaInicio"];
				$fecha2 = $_POST["fechaFin"];
				$plaza = $_SESSION["idPlaza"];
				$fecha = date('Y-m-d H:i:s');
				$respuesta = ModeloPermutas::mdlMostrarPermutasPorFechas($tabla, $fecha1, $fecha2, $plaza);

				$fechaRecuperacion = date('__Y_m_d__H_i_s');

				$nombreArchivo = "vistas/archivos/reportes/Reporte del ".$_POST["fechaInicio"]. " al ". $_POST["fechaFin"].$fechaRecuperacion."__".$_SESSION["numemp"].".csv";

				$archivoReporte = fopen($nombreArchivo, "w");

				fwrite($archivoReporte, "fecha_lanzamiento, fecha_solicita, tipo_permuta, fecha_cierre, turno_cubre_solicita, turno_cubre_acepta, ".utf8_decode("campaña").", solicita, supervisor_solicita, acepta, supervisor_acepta, reviso, comentario, fecha revision, status permuta".PHP_EOL);

				foreach ($respuesta as $key => $value) {

					switch($value["tipo_permuta"]){
						case 1: $tipo_permuta = "Permuta dia x dia"; break;
						case 2: $tipo_permuta = "Permuta libre"; break;
						case 3: $tipo_permuta = "Cambio de turno"; break;
					}

					$datosSolicita = ControladorUsuarios::ctrMostrarUsuario("numemp", $value["asesor_solicita"]);
					$datosReviso = ControladorUsuarios::ctrMostrarUsuario("numemp", $value["reviso"]);
					$datosAcepta = ControladorUsuarios::ctrMostrarUsuario("numemp", $value["asesor_acepta"]);
					$campaña = ControladorCampañas::ctrMostrarCampaña("id", $value["campana_solicita"]);

					$solicita = utf8_decode($datosSolicita["nombre_completo"]);

					$acepta = utf8_decode($datosAcepta["nombre_completo"]);

					$reviso = utf8_decode($datosReviso["nombre_completo"]);


					fwrite($archivoReporte, $value["fecha_lanzamiento"].",".$value["fecha_solicita"].",".$tipo_permuta.",".$value["fecha_cierre"].",".$value["turno_cubre_solicita"].",".$value["turno_cubre_acepta"].",".$campaña["campana"].",".$solicita.",".$value["supervisor_solicita"].",".$acepta.",".$value["supervisor_acepta"].",".$reviso.",".$value["comentario"].",".$value["fecha_revision"].",".$value["estado"].PHP_EOL);
				}

				fclose($archivoReporte);
				echo '<script>window.open("http://189.198.135.118/mi_atel/'.$nombreArchivo.'")</script>';


			}

		}



	}

?>
