<?php

	require_once "../controladores/supervisores.controlador.php";
	require_once "../modelos/supervisores.modelo.php";

	class AjaxSupervisores{

		/*=======================================
		=            	EDITAR USUARIO            =
		=======================================*/
		public $idCampaña;
		public $idPlaza;

		public function ajaxMostrarSupervisores(){

			$item1 = "campana";
			$valor1 = $this->idCampaña;
			$item2 = "plaza";
			$valor2 = $this->idPlaza;
			$item3 =  "estado";
			$valor3 = 1;
			$respuesta = ControladorSupervisores::ctrMostrarSupervisores($item1, $valor1, $item2, $valor2, $item3, $valor3);
			echo json_encode($respuesta);
			
		}
		

		public $idSupervisor;

		public function ajaxMostrarSupervisor(){

			$item1 = "id";
			$valor1 = $this->idSupervisor;
			$respuesta = ControladorSupervisores::ctrMostrarSupervisor($item1, $valor1);
			echo json_encode($respuesta);
			
		}

		public $statusSuper;
		public function ajaxActivarSupervisor(){

			$item1 = "estado";
			$valor1 = $this->statusSuper;
			$item2 = "id";
			$valor2 = $this->idSupervisor;
			$respuesta = ControladorSupervisores::ctrActivarSupervisor($item1, $valor1, $item2, $valor2);
			echo $respuesta;
		}
		
	}

	/*=======================================
	=            BUSCAR SUPERVISORES            =
	=======================================*/
	if(isset($_POST["buscarSupervisores"])){
		$buscar = new AjaxSupervisores();
		$buscar -> idCampaña = $_POST["campaña"];
		$buscar -> idPlaza = $_POST["Plaza"];
		$buscar -> ajaxMostrarSupervisores();
	}

	/*=======================================
	=            BUSCAR SUPERVISOR           =
	=======================================*/
	if(isset($_POST["buscarSupervisor"])){
		$buscar = new AjaxSupervisores();
		$buscar -> idSupervisor = $_POST["idSupervisor"];
		$buscar -> ajaxMostrarSupervisor();
	}

	
	if(isset($_POST["activarSuper"])){
		$actualizar = new AjaxSupervisores();
		$actualizar -> idSupervisor = $_POST["idsuper"];
		$actualizar -> statusSuper = $_POST["statusSuper"];
		$actualizar -> ajaxActivarSupervisor();
	}

?>