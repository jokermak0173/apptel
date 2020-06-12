<?php
	class ControladorHorarios{

		public function ctrSubirBase(){

			if(isset($_FILES["nuevoArchivoChecador"]["tmp_name"])){

				$FECHA = date('Y-m-d');
				$HORA = date('H-i-s');
				$EMP = $_SESSION["numemp"];
				$PLAZA = $_SESSION["idPlaza"];
				$tabla = "checador";
				$ruta = "vistas/archivos/horario/".$FECHA."_".$HORA."_".$EMP."_".$PLAZA.".csv";
				$tipoArchivo = "";

				if($_FILES["nuevoArchivoChecador"]["type"] == "application/vnd.ms-excel"){

					$tipoArchivo = "csv";

					$tmp_archivo = $_FILES["nuevoArchivoChecador"]["tmp_name"];
					move_uploaded_file($tmp_archivo, $ruta);

				}
				$item1 = "id_checador";
				$item2 = "fecha";
				$item3 = "hora";
				$item4 = "plaza";
				$usuario = $_SESSION['numemp'];
				$cargaExitosa = true;
				$bucle = 0;
				switch($tipoArchivo)
				{
					case "csv":
							if (file_exists($ruta))
							{
								$gestor = fopen($ruta, "r");
								$encabezado = fgetcsv($gestor, 1000, ",");
								$registrosTOTALES = 0;
								$registrosCARGADOS = 0;
								// fclose($gestor);
							    while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
							    	$bucle++;
							    	$registrosTOTALES++;
							        $numero = count($datos);
							        $ar = fopen("horario.txt", "a");
							        fwrite($ar, "numero: ".$numero." bucle: ".$bucle. PHP_EOL);
							        fclose($ar);
							        $columnaID = 0;
							        $columnaFecha = 1;

									$IdChecador = $datos[$columnaID];
									$FECHA_COMPLETA = $datos[$columnaFecha];

									$fecha = date('Y-m-d', strtotime($FECHA_COMPLETA)); // => 2013-02-16
									$hora = date("H:i",  strtotime($FECHA_COMPLETA));



									$respuesta = ModeloHorarios::mdlIngresarRegistroChecador($tabla, $item1, $IdChecador, $item2, $fecha, $item3, $hora, $item4, $PLAZA, $usuario);
									if($respuesta == "ok")
									{
										$registrosCARGADOS++;
									}

							      }
							     fclose($gestor);

							   	echo '<script>
										swal({
											type: "success",
											title: "¡Se cargaron '.$registrosCARGADOS.' registros de '.$registrosTOTALES.' totales!",
											showConfirmbutton: true,
											confirmButtonText: "Cerrar",
											closeOnConfirm: false
										}).then(function(result){
											if(result.value){
												window.location = "checador";
											}
										});
									 </script>';
									}

					break;
				}

			}
		}

		public function ctrBorrarBaseChecador(){

			if(isset($_POST["dtAnularBaseChecador"])){

				$PLAZA = $_SESSION["idPlaza"];
				$fecha = $_POST["dtAnularBaseChecador"];
				$tabla = "checador";
				$item1 = "fecha";
				$item2 = "plaza";
				$valor1 = $fecha;
				$valor2  = $PLAZA;
				$respuesta = ModeloHorarios::mdlBorrarRegistroChecador($tabla, $item1, $valor1, $item2, $valor2);

				if($respuesta == "ok"){
					echo '<script>
								swal({
									type: "success",
									title: "¡Se eliminaron los registros correctamente!",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "checador";
									}
										});
							</script>';
				}else{
					echo '<script>
								swal({
									type: "error",
									title: "¡Error al borrar registros!",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "checador";
									}
								});
							</script>';
				}
			}
		}

		public function ctrSubirBaseAsistencias(){
			if(isset($_FILES["nuevoArchivoAsistencias"]["tmp_name"])){

				$FECHA = date('Y-m-d');
				$HORA = date('H-i-s');
				$EMP = $_SESSION["numemp"];
				$PLAZA = $_SESSION["idPlaza"];
				$tabla = "control_asistencias";
				$ruta = "vistas/archivos/asistencias/".$FECHA."_".$HORA."_".$EMP."_".$PLAZA.".csv";
				$tipoArchivo = "";

				if($_FILES["nuevoArchivoAsistencias"]["type"] == "application/vnd.ms-excel"){

					$tipoArchivo = "csv";

					$tmp_archivo = $_FILES["nuevoArchivoAsistencias"]["tmp_name"];
					move_uploaded_file($tmp_archivo, $ruta);

				}
				$item1 = "numemp";
				$item2 = "fecha";
				$item3 = "plaza";
				$item4 = "calificacion";
				$item5 = "comentario";
				$cargaExitosa = true;
				$bucle = 0;
				switch($tipoArchivo)
				{
					case "csv":
							if (file_exists($ruta))
							{
								$gestor = fopen($ruta, "r");
								$encabezado = fgetcsv($gestor, 1000, ",");
								$registrosTOTALES = 0;
								$registrosCARGADOS = 0;
								// fclose($gestor);
							    while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
							    	$bucle++;
							    	$registrosTOTALES++;
							        $numero = count($datos);
							        $ar = fopen("asistencias.txt", "a");
							        fwrite($ar, "numero: ".$numero." bucle: ".$bucle. PHP_EOL);
							        fclose($ar);
							        $columnaID = 0;
							        $columnaFecha = 1;
							        $columnaCalificacion = 2;
							        $columnaComentario = 3;

									$IdChecador = $datos[$columnaID];
									$FECHA_COMPLETA = $datos[$columnaFecha];
									$calificacion = $datos[$columnaCalificacion];
									$comentario = $datos[$columnaComentario];

									$fecha = date('Y-m-d', strtotime($FECHA_COMPLETA)); // => 2013-02-16
									$hora = date("H:i",  strtotime($FECHA_COMPLETA));



									$respuesta = ModeloHorarios::mdlIngresarRegistroAsistencias($tabla, $item1, $IdChecador, $item2, $fecha, $item3, $PLAZA, $item4, $calificacion, $item5, $comentario );
									if($respuesta == "ok")
									{
										$registrosCARGADOS++;
									}

							      }
							     fclose($gestor);

							   	echo '<script>
										swal({
											type: "success",
											title: "¡Se cargaron '.$registrosCARGADOS.' registros de '.$registrosTOTALES.' totales!",
											showConfirmbutton: true,
											confirmButtonText: "Cerrar",
											closeOnConfirm: false
										}).then(function(result){
											if(result.value){
												window.location = "checador";
											}
										});
									 </script>';
									}

					break;
				}

			}
		}

		public function ctrBorrarBaseAsistencias(){
			if(isset($_POST["dtAnularBaseAsistencias"])){

				$PLAZA = $_SESSION["idPlaza"];
				$fecha = $_POST["dtAnularBaseAsistencias"];
				$tabla = "control_asistencias";
				$item1 = "fecha";
				$item2 = "plaza";
				$valor1 = $fecha;
				$valor2  = $PLAZA;
				$respuesta = ModeloHorarios::mdlBorrarRegistroChecador($tabla, $item1, $valor1, $item2, $valor2);

				if($respuesta == "ok"){
					echo '<script>
								swal({
									type: "success",
									title: "¡Se eliminaron los registros correctamente!",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "checador";
									}
										});
							</script>';
				}else{
					echo '<script>
								swal({
									type: "error",
									title: "¡Error al borrar registros!",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "checador";
									}
								});
							</script>';
				}
			}
		}

		static public function ctrCalcularTiempoTolerancia($numemp, $idChecador){

			$dia = date('d');
			$mes = date('m');
			$año = date('Y');

			if($dia <= 15){
				$diaInicio = "1";
				$diaFin = "15";
				$fechaInicio = $año."-".$mes."-".$diaInicio;
				$fechaFin =  $año."-".$mes."/".$diaFin;
			}else{
				$diaInicio = "16";
				$diaFin = "31";
				$fechaInicio = $año."-".$mes."-".$diaInicio;
				$fechaFin =  $año."-".$mes."-".$diaFin;
			}

			$tabla = "control_asistencias";
			// $faltas = ModeloHorarios::mdlContabilizarFaltas($tabla, $numemp, $fechaInicio, $fechaFin);

			// if($faltas["TOTAL"] > 0){
			// 	$tolerancia = 0;
			// 	return $tolerancia;

		//	}else{
				$tolerancia = 5;
				$asistencias = ModeloHorarios::mdlContabilizarAsistencias($tabla, $numemp, $fechaInicio, $fechaFin);
						$ar = fopen("asistencias.txt", "w");


				foreach ($asistencias as $key => $value) {

					$tabla = "checador";
					$diaDeLaAsistencia = ModeloHorarioChecador::mdlBuscarRetardoFecha($tabla, $value["fecha"], $_SESSION["idChecador"], $_SESSION["idPlaza"]);
					fwrite($ar, $diaDeLaAsistencia["HORA"].PHP_EOL);
					if($diaDeLaAsistencia["HORA"] > $_SESSION["horario_entrada"])
					{
						$fechaYhoraRetardo = $value["fecha"].$diaDeLaAsistencia["HORA"];
						$fechayHoraTurno = $value["fecha"].$_SESSION["horario_entrada"];
						$horaRetardo = new DateTime($fechaYhoraRetardo);
						$horaTurno = new DateTime($fechayHoraTurno);
						$diferencia = $horaTurno->diff($horaRetardo);
						$tolerancia -= $diferencia->i;
					}


				}
				fclose($ar);
				if($tolerancia < 0){
					$tolerancia = 0;
				}
				return $tolerancia;


		//	}

		}

		static public function ctrBuscarComentario($item1, $valor1, $item2, $valor2){
			$tabla = "control_asistencias";
			$respuesta = ModeloHorarios::mdlBuscarComentario($tabla, $item1, $valor1, $item2, $valor2);
			return $respuesta;
		}

		static public function ctrBuscarUltimaFecha($item1, $valor1){
			$tabla = "checador";
			$respuesta = ModeloHorarios::mdlBuscarUltimaFecha($tabla, $item1, $valor1);
			return $respuesta;
		}

	}

?>
