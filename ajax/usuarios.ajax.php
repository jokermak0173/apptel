<?php

	require_once "../controladores/usuarios.controlador.php";
	require_once "../modelos/usuarios.modelo.php";

	class AjaxUsuarios{

		/*=======================================
		=            	EDITAR USUARIO            =
		=======================================*/
		public $idAsesor;

		public function ajaxEditarUsuario(){

			$item = "numemp";
			$valor = $this->idAsesor;
			$respuesta = ControladorUsuarios::ctrMostrarAsesorPorId($item, $valor);
			if($respuesta)
			{
				echo json_encode($respuesta);
			}
			
		}
		
		/*=======================================
		=            	ACTIVAR ASESOR            =
		=======================================*/
		public $activarAsesor;
		public $activarId;

		public function ajaxActivarUsuario(){
			
			$tabla = "usuario";
			$item1 = "status_usuario";
			$valor1 = $this->activarAsesor;
			$item2 = "numemp";
			$valor2 = $this->activarId; 
			$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
		}

		/*=======================================
		= VALIDAR NO REPETIR USUARIO            =
		=======================================*/
		public $validarNumEmp;
		public function ajaxValidarNumEmp(){

			$item = "numemp";
			$valor = $this->validarNumEmp;
			$respuesta = ControladorUsuarios::ctrMostrarAsesorPorId($item, $valor);
			
			echo json_encode($respuesta);

		}

		/*=======================================
		= VALIDAR NO REPETIR ID CHECADOR            =
		=======================================*/
		public $validarChecador;
		public $validarPlaza;
		public function ajaxValidarIdChecador(){

			$item1 = "id_checador";
			$valor1 = $this->validarChecador;
			$item2 = "plaza";
			$valor2 = $this->validarPlaza;
			$respuesta = ControladorUsuarios::ctrMostrarAsesorChecador($item1, $valor1, $item2, $valor2);
			echo json_encode($respuesta);

		}

		/*=======================================
		= LIBERAR SESION USUARIO          =
		=======================================*/
		public $numEmp;
		public function ajaxLiberarSesionUsuario(){

			$item1 = "status_sesion";
			$valor1 = "";
			$item2 = "ip_pc";
			$valor2 = "";
			$item3 = "nombre_pc";
			$valor3 = "";
			$item4 = "numemp";
			$valor4 = $this->numEmp;

			$respuesta = ControladorUsuarios::ctrLiberarSesionUsuario($item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);

			echo $respuesta;

		}
		
	}

	/*=======================================
	=            	EDITAR USUARIO            =
	=======================================*/
	if(isset($_POST["idAsesor"])){
		$editar = new AjaxUsuarios();
		$editar -> idAsesor = $_POST["idAsesor"];
		$editar -> ajaxEditarUsuario();
	}
	
	/*=======================================
	=            	ACTIVAR ASESOR            =
	=======================================*/
	if(isset($_POST["activarAsesor"])){
		$activarAsesor = new AjaxUsuarios();
		$activarAsesor -> activarAsesor = $_POST["activarAsesor"];
		$activarAsesor -> activarId = $_POST["activarId"];
		$activarAsesor -> ajaxActivarUsuario();
	}

	/*=======================================
	=            	VALIDAR ASESOR            =
	=======================================*/
	if(isset($_POST["validarAsesor"])){

		$valAsesor = new ajaxUsuarios();
		$valAsesor -> validarNumEmp = $_POST["validarAsesor"];
		$valAsesor -> ajaxValidarNumEmp();
	}

	/*=======================================
	=            	VALIDAR CHECADOR            =
	=======================================*/
	if(isset($_POST["validarChecador"]) && isset($_POST["validarPlaza"])){
		$valAsesor = new ajaxUsuarios();
		$valAsesor -> validarChecador = $_POST["validarChecador"];
		$valAsesor -> validarPlaza = $_POST["validarPlaza"];
		$valAsesor -> ajaxValidarIdChecador();
	}

	/*=======================================
	=            	LIBERAR SESION            =
	=======================================*/
	if(isset($_POST["liberarSesion"]) && isset($_POST["numemp"])){
		$valAsesor = new ajaxUsuarios();
		$valAsesor -> numEmp = $_POST["numemp"];
		$valAsesor -> ajaxLiberarSesionUsuario();
		
	}

	
?>