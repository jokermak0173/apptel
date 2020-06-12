<?php
require "../controladores/usuarios.controlador.php";
require "../modelos/usuarios.modelo.php";

require "../controladores/plazas.controlador.php";
require "../modelos/plazas.modelo.php";

require "../controladores/turnos.controlador.php";
require "../modelos/turnos.modelo.php";

require "../controladores/campanas.controlador.php";
require "../modelos/campanas.modelo.php";
class TablaAsesores{

	public function mostrarTablaAsesoresAlta($plaza){

		 // $item = null;
   //       $valor = null;
		if($_GET["status"] == "alta"){
			 $valores = array("plaza" => $plaza, "status" => "1", "nivel_acceso" => 5, "status_usuario" => 1);
		}else{
			 $valores = array("plaza" => $plaza, "status" => "1", "nivel_acceso" => 5, "status_usuario" => 0);
		}
         
         $asesores = ControladorUsuarios::ctrMostrarAsesores($valores);
         

         $datosJson = '{
					  "data": [';
					  for($i = 0; $i < count($asesores); $i++){

					  	 $plazaAsesor = ControladorPlazas::ctrMostrarPlaza("id", $asesores[$i]["plaza"]);
                       	 $campañaAsesor = ControladorCampañas::ctrMostrarCampaña("id", $asesores[$i]["campana"]);
                      	 $turnoAsesor = ControladorTurnos::ctrMostrarTurno("id", $asesores[$i]["turno"]);

					  	 $foto = "<img src='".$asesores[$i]["foto"]."' width='40px'>";
						 $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarAsesor' data-toggle='modal' data-target='#modalEditarAsesor' idAsesor='".$asesores[$i]["numemp"]."' ><i class='fa fa-pencil-alt'></i></button><button class='btn btn-info btnLiberarUsuario' idUsuario='".$asesores[$i]["numemp"]."' ><i class='fa fa-level-up-alt'></i></button></div>";
						 if($asesores[$i]["status_usuario"] != 0){
                                  $estado = "<td><button class='btn btn-primary btn-xs btnActivar' idAsesor='".$asesores[$i]["numemp"]."' statusAsesor='0'>Activado</button></td>";
                                }else{
                                  $estado = "<td><button class='btn btn-danger btn-xs btnActivar' idAsesor='".$asesores[$i]["numemp"]."' statusAsesor='1'>Deshabilitado</button></td>";
                                }

									  	$datosJson.= '[
					      "'.$asesores[$i]["numemp"].'",
					     
					      "'.utf8_decode($asesores[$i]["nombre_completo"]).'",
					      "'.$asesores[$i]["id_checador"].'",
					      "'.$plazaAsesor["nombre"].'",
					      "'.$campañaAsesor["campana"].'",
					      "'.$turnoAsesor["horario_entrada"].' - '.$turnoAsesor["horario_salida"].'",
					      "'.$foto.'",';
					     
					      if($_GET["status"] == "alta"){
					      	$datosJson.=' "'.$estado.'","'.$botones.'"';
					      }else{
					      		$datosJson.=' "'.$estado.'"';
					      }
					     $datosJson.='
					    ],';
					  }
		$datosJson = substr($datosJson, 0, -1);
		$datosJson.= '] 
	}';
	echo $datosJson;
		

		
		
	}

	}	

/*===============================================
=            ACTIVAR TABLA PRODUCTOS            =
===============================================*/
if(isset($_GET["status"])){
	if($_GET["status"]){
		$activarAsesores = new TablaAsesores();
		$activarAsesores -> mostrarTablaAsesoresAlta($_GET["idPlaza"]);
	}
	
	
}


?>