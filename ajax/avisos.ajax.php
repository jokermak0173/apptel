<?php

	require_once "../controladores/avisos.controlador.php";
	require_once "../modelos/avisos.modelo.php";

	class AjaxAvisos{

		
		
		public $idAviso;
		

		public function ajaxEditarAviso(){

			$item = "id";
			$valor = $this->idAviso;
			$respuesta = ControladorAvisos::ctrMostrarAviso($item, $valor);
			echo json_encode($respuesta);
		}

		public function ajaxEliminarAviso(){

			$item = "id";
			$valor = $this->idAviso;
			$respuesta = ControladorAvisos::ctrEliminarAviso($item, $valor);
			echo $respuesta;
		}
		
	}

	

	
	if(isset($_POST["eliminarAviso"])){
		$eliminarAviso = new AjaxAvisos();
		$eliminarAviso -> idAviso = $_POST["idAviso"];
		$eliminarAviso -> ajaxEliminarAviso();
	}

	if(isset($_POST["mostrarAviso"])){
		$actualizar = new AjaxAvisos();
		$actualizar -> idAviso = $_POST["idAviso"];
		$actualizar -> ajaxEditarAviso();
	}

?>