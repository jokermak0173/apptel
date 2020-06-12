<?php

	require_once "../controladores/permutas.controlador.php";
	require_once "../modelos/permutas.modelo.php";

	require_once "../controladores/usuarios.controlador.php";
	require_once "../modelos/usuarios.modelo.php";

	require_once "../controladores/supervisores.controlador.php";
	require_once "../modelos/supervisores.modelo.php";

	class AjaxPermutas{

		public $tipoPermuta;
		public $numemp;
		public $fecha;
		public $campaña;
		public $turno;
		public $supervisor;
		public $estado;
		public $plaza;
		public $fechaCierre;
		public $turnoCubre;
		public $turnoLeCubren;

		public $idPermuta;
		public $reviso;
		public $comentario;



		public function ajaxEnviarPermuta(){
			$item1 = "tipo_permuta";
			$valor1 = $this->tipoPermuta;
			$item2 = "asesor_solicita";
			$valor2 = $this->numemp;
			$item3 = "fecha_solicita";
			$valor3 = $this->fecha;
			$item4 = "campana_solicita";
			$valor4 = $this->campaña;
			$item5 = "turno_solicita";
			$valor5 = $this->turno;
			$item6 = "supervisor_solicita";
			$valor6 = $this->supervisor;
			$item7 = "estado";
			$valor7 = $this->estado;
			$item8 = "plaza";
			$valor8 = $this->plaza;
			$item9 = "fecha_cierre";
			$item10 = "turno_cubre_solicita";
			$valor10 = $this->turnoCubre;
			$item11 = "turno_cubre_acepta";
			$valor11 = $this->turnoLeCubren;

			if($this->tipoPermuta == 1){
				$fecha = date('Y-m-d', strtotime($this->fechaCierre));
				$valor9 = $fecha;
			}else{
				$valor9 = "";
			}

			$respuesta = ControladorPermutas::ctrEnviarPermuta($item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4, $item5, $valor5, $item6, $valor6, $item7, $valor7, $item8, $valor8, $item9, $valor9, $item10, $valor10, $item11, $valor11);
			echo $respuesta;




		}


		public function ajaxBuscarPermutasCalendario(){
			$valor1 = $this->numemp;

			$respuesta = ControladorPermutas::ctrBuscarPermutasCalendario($valor1);

			for($i = 0; $i < count($respuesta); $i++){
				$reviso = ControladorUsuarios::ctrMostrarAsesorPorId("numemp", $respuesta[$i]["reviso"]);
				$nombreReviso = utf8_decode($reviso["nombre_completo"]);
				$respuesta[$i]["reviso"] = $nombreReviso;
				switch($respuesta[$i]["title"]){
					case 1: $respuesta[$i]["title"] = "Permuta dia x dia";
							if( $respuesta[$i]["color"] == "enviada"){
								$respuesta[$i]["color"] = "gray";
							}else if($respuesta[$i]["color"] == "aceptada"){
								$respuesta[$i]["color"] = "orange";
							}else if($respuesta[$i]["color"] == "autorizada"){
								$respuesta[$i]["color"] = "green";
							}else if($respuesta[$i]["color"] == "denegada"){
								$respuesta[$i]["color"] = "red";
							}else if($respuesta[$i]["color"] == "cancelada"){
								$respuesta[$i]["color"] = "purple";
							}
						break;
					case 2: $respuesta[$i]["title"] = "Permuta libre";
							if( $respuesta[$i]["color"] == "enviada"){
								$respuesta[$i]["color"] = "gray";
							}else if($respuesta[$i]["color"] == "aceptada"){
								$respuesta[$i]["color"] = "orange";
							}else if($respuesta[$i]["color"] == "autorizada"){
								$respuesta[$i]["color"] = "green";
							}else if($respuesta[$i]["color"] == "denegada"){
								$respuesta[$i]["color"] = "red";
							}else if($respuesta[$i]["color"] == "cancelada"){
								$respuesta[$i]["color"] = "purple";
							}
					break;
					case 3: $respuesta[$i]["title"] = "Cambio Turno";
							if( $respuesta[$i]["color"] == "enviada"){
								$respuesta[$i]["color"] = "gray";
							}else if($respuesta[$i]["color"] == "aceptada"){
								$respuesta[$i]["color"] = "orange";
							}else if($respuesta[$i]["color"] == "autorizada"){
								$respuesta[$i]["color"] = "green";
							}else if($respuesta[$i]["color"] == "denegada"){
								$respuesta[$i]["color"] = "red";
							}else if($respuesta[$i]["color"] == "cancelada"){
								$respuesta[$i]["color"] = "purple";
							}
					break;
				}


			}
			echo json_encode($respuesta);

		}

		public function ajaxBuscarEvento(){
			$item1 = "asesor_solicita";
			$valor1 = $this->numemp;
			$item2 = "fecha_solicita";
			$valor2 = $this->fecha;
			$respuesta = ControladorPermutas::ctrBuscarEvento($item1, $valor1, $item2, $valor2);

			echo json_encode($respuesta);

		}

		public function ajaxBuscarEventoRepetido(){
			$item1 = "asesor_solicita";
			$valor1 = $this->numemp;
			$item2 = "fecha_solicita";
			$valor2 = $this->fecha;
			$respuesta = ControladorPermutas::ctrBuscarEventoRepetido($item1, $valor1, $item2, $valor2);

			echo json_encode($respuesta);

		}

		public function consolidarPermuta(){
			$item1 = "asesor_acepta";
			$valor1 = $this->numemp;
			$item2 = "id";
			$valor2 = $this->idPermuta;

			$respuesta = ControladorPermutas::ctrConsolidarPermuta($item1, $valor1, $item2, $valor2);
			echo json_encode($respuesta);
		}

		public function ajaxBuscarPermuta(){
			$item1 = "id";
			$valor1 = $this->idPermuta;
			$respuesta = ControladorPermutas::ctrMostrarPermutaPorId($item1, $valor1);
			echo json_encode($respuesta);
		}

		public function ajaxBuscarPermutasDia(){
			$item1 = "fecha_solicita";
			$valor1 = $this->fecha;
			$valor2 = $this->numemp;
			$respuesta = ControladorPermutas::ctrMostrarPermutasDia($item1, $valor1, $valor2);
			echo json_encode($respuesta);
		}

		public function ajaxBorrarPermuta(){
			$item1 = "id";
			$valor1 = $this->idPermuta;
			$respuesta1 = ControladorPermutas::ctrMostrarPermutaPorId($item1, $valor1);
			if($respuesta1["estado"] == "enviada")
			{
				$respuesta2 = ControladorPermutas::ctrBorrarPermuta($item1, $valor1);
				echo $respuesta2;
			}else{
				echo "aceptada";
			}


		}

		public function ajaxCancelarPermuta(){
			$item1 = "id";
			$valor1 = $this->idPermuta;
			$valor2 = $this->reviso;
			$valor3 = $this->comentario;
			$respuesta = ControladorPermutas::ctrCancelarPermuta($item1, $valor1, $valor2, $valor3);
			echo $respuesta;
		}

		public function ajaxAutorizarPermuta(){
			$item1 = "id";
			$valor1 = $this->idPermuta;
			$valor2 = $this->reviso;
			$respuesta = ControladorPermutas::ctrAutorizarPermuta($item1, $valor1, $valor2);
			echo $respuesta;
		}

		public function ajaxValidarPermuta(){
			$item1 = "fecha_solicita ";
			$item2 = "asesor_solicita";
			$valor1 = $this->fecha;
			$valor2 = $this->numemp;

			$respuesta = ControladorPermutas::ctrValidarPermuta($item1, $valor1, $item2, $valor2);
			echo json_encode($respuesta);
		}

		public function ajaxDenegarPermuta(){
			$item1 = "id";
			$valor1 = $this->idPermuta;
			$valor2 = $this->reviso;
			$valor3 = $this->comentario;
			$respuesta = ControladorPermutas::ctrDenegarPermuta($item1, $valor1, $valor2, $valor3);
			echo $respuesta;
		}

	}




	if(isset($_POST["enviarPermuta"])){

		if(isset($_POST["numemp"]))
		{
		$enviarPermuta = new AjaxPermutas();
		$enviarPermuta -> tipoPermuta = $_POST["tipoPermuta"];
		$enviarPermuta -> numemp = $_POST["numemp"];
		$enviarPermuta -> fecha = $_POST["fechaPermuta"];
		$enviarPermuta -> campaña = $_POST["campania"];
		$enviarPermuta -> turno = $_POST["idTurno"];
		$enviarPermuta -> supervisor = $_POST["supervisor"];
		$enviarPermuta -> estado = $_POST["estado"];
		$enviarPermuta -> plaza = $_POST["idPlaza"];
		$enviarPermuta -> fechaCierre = $_POST["fechaCierre"];
		$enviarPermuta -> turnoCubre = $_POST["turnoCubreSolicita"];
		$enviarPermuta -> turnoLeCubren = $_POST["turnoCubreAcepta"];

		$enviarPermuta -> ajaxEnviarPermuta();
		}


	}

	if(isset($_GET["buscarCalendario"])){

		if(isset($_GET["numemp"]))
		{
			$enviarPermuta = new AjaxPermutas();
			$enviarPermuta -> numemp = $_GET["numemp"];
			$enviarPermuta -> ajaxBuscarPermutasCalendario();
		}


	}

	if(isset($_GET["buscarEvento"])){

		if(isset($_GET["numemp"]))
		{
			$enviarPermuta = new AjaxPermutas();
			$enviarPermuta -> numemp = $_GET["numemp"];
			$enviarPermuta -> fecha = $_GET["fechaEvento"];
			$enviarPermuta -> ajaxBuscarEvento();
		}


	}

	if(isset($_GET["buscarEventoRepetido"])){

		if(isset($_GET["numemp"]))
		{
			$enviarPermuta = new AjaxPermutas();
			$enviarPermuta -> numemp = $_GET["numemp"];
			$enviarPermuta -> fecha = $_GET["fechaEvento"];
			$enviarPermuta -> ajaxBuscarEventoRepetido();
		}


	}

	if(isset($_POST["consolidarPermuta"])){

		if(isset($_POST["numEmp"]))
		{

			$consolidarPermuta = new AjaxPermutas();
			$consolidarPermuta -> numemp = $_POST["numEmp"];
			$consolidarPermuta -> idPermuta = $_POST["idPermuta"];
			$consolidarPermuta -> consolidarPermuta();
		}


	}

	if(isset($_POST["buscarPermuta"])){

		if(isset($_POST["idPermuta"]))
		{
			$buscarPermuta = new AjaxPermutas();
			$buscarPermuta -> idPermuta = $_POST["idPermuta"];
			$buscarPermuta -> ajaxBuscarPermuta();
		}
	}

	if(isset($_POST["buscarPermutasDia"])){

		if(isset($_POST["numemp"]))
		{
			$buscarPermutas = new AjaxPermutas();
			$buscarPermutas -> numemp = $_POST["numemp"];
			$buscarPermutas -> fecha = $_POST["fecha"];
			$buscarPermutas -> ajaxbuscarPermutasDia();
		}
	}

	if(isset($_POST["borrarPermuta"])){

		if(isset($_POST["idPermuta"]))
		{
			$borrarPermuta = new AjaxPermutas();
			$borrarPermuta -> idPermuta = $_POST["idPermuta"];
			$borrarPermuta -> ajaxBorrarPermuta();
		}
	}

	if(isset($_POST["cancelarPermuta"])){

		if(isset($_POST["idPermuta"]))
		{
			$cancelarPermuta = new AjaxPermutas();
			$cancelarPermuta -> idPermuta = $_POST["idPermuta"];
			$cancelarPermuta -> comentario = $_POST["comentario"];
			$cancelarPermuta -> reviso = $_POST["reviso"];
			$cancelarPermuta -> ajaxCancelarPermuta();
		}
	}

	if(isset($_POST["autorizarPermuta"])){

		if(isset($_POST["idPermuta"]))
		{
			$cancelarPermuta = new AjaxPermutas();
			$cancelarPermuta -> idPermuta = $_POST["idPermuta"];
			$cancelarPermuta -> reviso = $_POST["reviso"];
			$cancelarPermuta -> ajaxAutorizarPermuta();
		}
	}

	if(isset($_POST["denegarPermuta"])){

		if(isset($_POST["idPermuta"]))
		{
			$cancelarPermuta = new AjaxPermutas();
			$cancelarPermuta -> idPermuta = $_POST["idPermuta"];
			$cancelarPermuta -> comentario = $_POST["comentario"];
			$cancelarPermuta -> reviso = $_POST["reviso"];
			$cancelarPermuta -> ajaxDenegarPermuta();
		}
	}

	if(isset($_POST["validarPermuta"])){

		if(isset($_POST["fechaPermuta"]))
		{
			$validarPermuta = new AjaxPermutas();
			$validarPermuta -> fecha = $_POST["fechaPermuta"];
			$validarPermuta -> numemp = $_POST["asesorSolicita"];

			$validarPermuta -> ajaxValidarPermuta();
		}
	}


?>
