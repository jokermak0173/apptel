<?php

	require_once "../controladores/turnos.controlador.php";
	require_once "../modelos/turnos.modelo.php";

	class AjaxTurnos{

		/*=======================================
		=            	EDITAR USUARIO            =
		=======================================*/
		public $idTurno;

		public function ajaxBuscarTurno($buscarTodos){

			if($buscarTodos){

				$item = null;
				$valor = null;
				$respuesta = ControladorTurnos::ctrMostrarTurno($item, $valor);
				echo json_encode($respuesta);

			}else{

				$item = "id";
				$valor = $this->idTurno;
				$respuesta = ControladorTurnos::ctrMostrarTurno($item, $valor);
				echo json_encode($respuesta);
			}
			
			
		}

		public $idPlaza;
		public function ajaxBuscarTurnosPorPlaza(){
			$item1 = "plaza";
			$valor1 = $this->idPlaza;
			$item2 = "estado";
			$valor2 = "1";
			$respuesta = ControladorTurnos::ctrMostrarTurnos();
			echo json_encode($respuesta);
		}

		public $statusTurno;
		public function ajaxActivarTurno(){
			$item1 = "estado";
			$valor1 = $this->statusTurno;
			$item2 = "id";
			$valor2 = $this->idTurno;
			$respuesta = ControladorTurnos::ctrActivarTurno($item1, $valor1, $item2, $valor2);
			echo $respuesta;
		}


		
		
		/*=====  End of 	EDITAR USUARIO  ======*/
		
	}

	/*=======================================
	=            	EDITAR USUARIO            =
	=======================================*/
	if(isset($_POST["idTurno"])){
		$buscarTurno = new AjaxTurnos();
		$buscarTurno -> idTurno = $_POST["idTurno"];
		$buscarTurno -> ajaxBuscarTurno(false);
	}

	if(isset($_POST["buscarTurnos"])){
		$buscarTurnos = new AjaxTurnos();
		$buscarTurnos -> ajaxBuscarTurno(true);
	}

	if(isset($_POST["buscarTurnosPlaza"])){
		$buscarTurnos = new AjaxTurnos();
		$buscarTurnos -> idPlaza = $_POST["idPlaza"];
		$buscarTurnos -> ajaxBuscarTurnosPorPlaza();
	}

	if(isset($_POST["activarTurno"])){
		$activarTurno = new AjaxTurnos();
		$activarTurno -> statusTurno = $_POST["statusTurno"];
		$activarTurno -> idTurno = $_POST["idTurnoActivar"];
		$activarTurno -> ajaxActivarTurno();
	}
	

?>