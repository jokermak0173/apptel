<?php

	require_once "../controladores/horario_checador.controlador.php";
	require_once "../modelos/horario_checador.modelo.php";

	class AjaxHorarioChecador{

		public $idPlaza;
		public $idChecador;
		public $numemp;

		public function ajaxBuscarHorarioEntrada(){

			$item1 = "plaza";
			$valor1 = $this->idPlaza;
			$item2 = "id_checador";
			$valor2 = $this->idChecador;
			$respuestaEntrada = ControladorHorarioChecador::ctrBuscarHorarioEntrada($item1, $valor1, $item2, $valor2);
			$respuestaSalida = ControladorHorarioChecador::ctrBuscarHorarioSalida($item1, $valor1, $item2, $valor2);
			for($i = 0; $i < count($respuestaEntrada); $i++){
				$respuestaEntrada[$i]["color"] = "#58ACFA";
				$respuestaEntrada[$i]["title"] = "Entrada";
			}
			for($i = 0; $i < count($respuestaSalida); $i++){
				$respuestaSalida[$i]["color"] = "#2E64FE";
				$respuestaSalida[$i]["title"] = "Salida";
			}
			$resultado = array_merge($respuestaEntrada, $respuestaSalida);
			echo json_encode($resultado); 
			
		}

		public function ajaxBuscarAsistencias(){
			$item1 = "numemp";
			$valor1 = $this->numemp;
			$respuesta = ControladorHorarioChecador::ctrBuscarAsistencias($item1, $valor1);
			echo json_encode($respuesta);
		}
	

		
		
	}

	if(isset($_GET["buscarHorarioEntrada"])){

		if(isset($_GET["idPlaza"]) && isset($_GET["idChecador"]))
		{
			$activar = new AjaxHorarioChecador();
		$activar -> idPlaza = $_GET["idPlaza"];
		$activar -> idChecador = $_GET["idChecador"];
		$activar -> ajaxBuscarHorarioEntrada();
		}

		
	}

	if(isset($_POST["buscarAsistencias"])){

		if(isset($_POST["numemp"]))
		{
		$buscarAsistencias = new AjaxHorarioChecador();
		$buscarAsistencias -> numemp = $_POST["numemp"];
		$buscarAsistencias -> ajaxBuscarAsistencias();
		}

		
	}
?>