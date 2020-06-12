<?php

	require_once "../controladores/plazas.controlador.php";
	require_once "../modelos/plazas.modelo.php";

	class AjaxPlazas{

		
		
		public $idPlaza;
		public $statusPlaza;
		public function ajaxActivarPlaza(){

			$item1 = "estado";
			$valor1 = $this->statusPlaza;
			$item2 = "id";
			$valor2 = $this->idPlaza;
			$respuesta = ControladorPlazas::ctrActivarPlaza($item1, $valor1, $item2, $valor2);
			echo $respuesta;
		}

		public function ajaxEditarPlaza(){

			$item = "id";
			$valor = $this->idPlaza;
			$respuesta = ControladorPlazas::ctrMostrarPlaza($item, $valor);
			echo json_encode($respuesta);
		}
		
	}

	

	
	if(isset($_POST["activarPlaza"])){
		$actualizar = new AjaxPlazas();
		$actualizar -> idPlaza = $_POST["idPlaza"];
		$actualizar -> statusPlaza = $_POST["statusPlaza"];
		$actualizar -> ajaxActivarPlaza();
	}

	if(isset($_POST["editarPlaza"])){
		$actualizar = new AjaxPlazas();
		$actualizar -> idPlaza = $_POST["idPlaza"];
		$actualizar -> ajaxEditarPlaza();
	}

?>