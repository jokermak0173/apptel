<?php

class ControladorRecomendados{

	public function ctrEnviarRecomendado($item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4){
			
					
		$tabla = "recomendados";
			
		$respuesta = ModeloRecomendados::mdlEnviarRecomendado($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);
		
		return $respuesta;
			
	}

	public function ctrMostrarRecomendados($item, $valor){
			
					
		$tabla = "recomendados";
			
		$respuesta = ModeloRecomendados::mdlMostrarRecomendados($tabla, $item, $valor);

		return $respuesta;
			
	}

	public function ctrMostrarRecomendadosPlaza($item, $valor, $item2, $valor2){
			
					
		$tabla = "recomendados";
			
		$respuesta = ModeloRecomendados::mdlMostrarRecomendadosPlaza($tabla, $item, $valor, $item2, $valor2);

		return $respuesta;
			
	}

	public function ctrBuscarRecomendado($item, $valor){

		$tabla = "recomendados";

		$respuesta = ModeloRecomendados::mdlBuscarRecomendado($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrCalificarRecomendado(){
		if(isset($_POST["idRecomendado"])){
			if(isset($_POST["calificacionRecomendado"])){
				
				$tabla = "recomendados";

				if(isset($_POST["comentarioRevision"])){
					$comentario = $_POST["comentarioRevision"];
				}else{
					$comentario = "";
				}

				$calificacion = $_POST["calificacionRecomendado"];
				$id = $_POST["idRecomendado"];

				$respuesta = ModeloRecomendados::mdlCalificarRecomendado($tabla, $id, $calificacion, $comentario);

				if($respuesta == "ok"){
								echo '<script>
								swal({
									type: "success",
									title: "¡Se califico el recomendado!",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "recomendados";
									}
								});
								
							 </script>';

							}else{
								echo '<script>
								swal({
									type: "error",

									title: "Algun error hubo al calificar al recomendado'.$respuesta[2].'",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "recomendados";
									}
								});
								
							 </script>';
							}

			}else{
				echo '<script>
						swal({
							type: "error",
							title: "¡Califica el recomendado para continuar",
							showConfirmbutton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then(function(result){
							if(result.value){
								window.location = "recomendados";
							}
						});					
					 </script>';
			}
		}
	}

		static public function ctrDescargarReporte(){

			if(isset($_POST["fechaInicio"]) && isset($_POST["fechaFin"])){
				
				$fecha1 = $_POST["fechaInicio"];
				$fecha2 = $_POST["fechaFin"];
				$plaza = $_SESSION["idPlaza"];
				
				$respuesta = ModeloRecomendados::mdlMostrarRecomendadosPorFechas($fecha1, $fecha2, $plaza);

				var_dump($respuesta);

				$fechaRecuperacion = date('__Y_m_d__H_i_s');

				$nombreArchivo = "vistas/archivos/reportes/Reporte del ".$_POST["fechaInicio"]. " al ". $_POST["fechaFin"].$fechaRecuperacion."__".$_SESSION["numemp"].".csv";

				$archivoReporte = fopen($nombreArchivo, "w");

				fwrite($archivoReporte, "nombre_recomendado, tel_recomendado, comentario_contacto, comentario_revision, estado, numemp_recomienda, nombreAsesor_recomienda, campana_asesor, supervisor_asesor,  fecha_creacion, fecha_revision".PHP_EOL);

				foreach ($respuesta as $key => $value) {

					switch($value["estado"]){
						case 0: $estadoRecomendado = "enviado"; break;
						case 1: $estadoRecomendado = "No se pudo contactar"; break;
						case 2: $estadoRecomendado = "Numero equivocado"; break;
						case 3: $estadoRecomendado = "No interesado"; break;
						case 9: $estadoRecomendado = "Citado a entrevista"; break;
						case 11: $estadoRecomendado = "No se presento"; break;
						case 12: $estadoRecomendado = "Rechazado"; break;
						case 13: $estadoRecomendado = "Reingreso"; break;
						case 14: $estadoRecomendado = "Pendiente"; break;
						case 19: $estadoRecomendado = "Citado a curso"; break;
						case 21: $estadoRecomendado = "Depurado"; break;
						case 22: $estadoRecomendado = "No le gusto"; break;
						case 23: $estadoRecomendado = "Abandono"; break;
						case 29: $estadoRecomendado = "Certifico"; break;
						case 31: $estadoRecomendado = "Baja"; break;
						case 39: $estadoRecomendado = "Bono Pagado"; break;
						default: $estadoRecomendado = "Sin estado";
					}

					
					$datosCampaña = ControladorCampañas::ctrMostrarCampaña("id", $value["campana"]);
					$datosSupervisor = ControladorSupervisores::ctrMostrarSupervisor("id", $value["supervisor"]);

					$campaña = $datosCampaña["campana"];
					$supervisor = utf8_decode($datosSupervisor["nombre"])." ".utf8_decode($datosSupervisor["apellido_paterno"])." ".utf8_decode($datosSupervisor["apellido_materno"]);

	


					fwrite($archivoReporte, $value["nombre_recomendado"].",".$value["tel_recomendado"].",".$value["comentario_contacto"].",".$value["comentario_revision"].",".$estadoRecomendado.",".$value["numemp_recomienda"].",".$value["nombre_completo"].",".$campaña.",".$supervisor.",".$value["fecha_creacion"].",".$value["fecha_revision"].PHP_EOL);
				}
				
				fclose($archivoReporte);
				echo '<script>window.open("http://189.254.235.103/mi_atel/'.$nombreArchivo.'")</script>';
				
				
			}
			
		}

}

?>