<?php

	require_once "../controladores/capacitadores.controlador.php";
	require_once "../modelos/capacitadores.modelo.php";

	class AjaxCapacitadores{

		

		public $statusCapa;
		public $idCapa;
		public function ajaxActivarCapacitador(){

			$item1 = "estado";
			$valor1 = $this->statusCapa;
			$item2 = "id";
			$valor2 = $this->idCapa;
			$respuesta = ControladorCapacitadores::ctrActivarCapacitador($item1, $valor1, $item2, $valor2);
			echo $respuesta;
		}

		public $idPlaza;
		public function ajaxBuscarCapacitadores(){
			$item1 = "estado";
			$valor1 = $this->statusCapa;
			$item2 = "plaza";
			$valor2 = $this->idPlaza;
			
			$respuesta = ControladorCapacitadores::ctrMostrarCapacitadores($item1, $valor1, $item2, $valor2);
			echo json_encode($respuesta);
		}

		public function ajaxBuscarCapacitador(){
			$item1 = "id";
			$valor1 = $this->idCapa;
			
			$respuesta = ControladorCapacitadores::ctrMostrarCapacitadorPorId($item1, $valor1);
			echo json_encode($respuesta);
		}
		
	}


	/*=======================================
	=            ACTIVAR CAPACITADOR           =
	=======================================*/
	if(isset($_POST["activarCapa"])){
		$actualizar = new AjaxCapacitadores();
		$actualizar -> statusCapa = $_POST["statusCapa"];
		$actualizar -> idCapa = $_POST["idCapa"];
		$actualizar -> ajaxActivarCapacitador();
	}

	/*=======================================
	=            BUSCAR CAPACITADORES          =
	=======================================*/
	if(isset($_POST["buscarCapacitadores"])){
		$actualizar = new AjaxCapacitadores();
		$actualizar -> statusCapa = $_POST["statusCapa"];
		$actualizar -> idPlaza = $_POST["idPlaza"];
		$actualizar -> ajaxBuscarCapacitadores();
	}


	/*=======================================
	=            BUSCAR CAPACITADOR          =
	=======================================*/
	if(isset($_POST["buscarCapacitador"])){
		$actualizar = new AjaxCapacitadores();
		$actualizar -> idCapa = $_POST["idCapa"];
		$actualizar -> ajaxBuscarCapacitador();
	}

?>