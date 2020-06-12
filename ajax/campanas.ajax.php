<?php

	require_once "../controladores/campanas.controlador.php";
	require_once "../modelos/campanas.modelo.php";

	class AjaxCampañas{

		/*=======================================
		=            	EDITAR USUARIO            =
		=======================================*/
		public $idCampaña;
		public function ajaxBuscarCampaña(){

			$item = "id";
			$valor = $this->idCampaña;
			$respuesta = ControladorCampañas::ctrMostrarCampaña($item, $valor);
			echo json_encode($respuesta);
			
		}

		/*=======================================
		=            	ACTIVAR CAMPAÑA           =
		=======================================*/
		public $statusCampaña;
		public function ajaxActivarCampaña(){

			$item1 = "activo";
			$valor1 = $this->statusCampaña;
			$item2 = "id";
			$valor2 = $this->idCampaña;
			$respuesta = ControladorCampañas::ctrActivarCampaña($item1, $valor1, $item2, $valor2);
			echo $respuesta;
		}		
		
	}

	/*=======================================
	=            	EDITAR CAMPAÑA            =
	=======================================*/
	if(isset($_POST["idCampaña"])){
		$buscar = new AjaxCampañas();
		$buscar -> idCampaña = $_POST["idCampaña"];
		$buscar -> ajaxBuscarCampaña();
	}
	

	/*=======================================
	=            	ACTIVAR CAMPAÑA            =
	=======================================*/
	if(isset($_POST["activarCampaña"])){
		$activar = new AjaxCampañas();
		$activar -> idCampaña = $_POST["idCampañaActivar"];
		$activar -> statusCampaña = $_POST["statusCampaña"];
		$activar -> ajaxActivarCampaña();
	}


?>