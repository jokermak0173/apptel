<?php

	require_once "../controladores/recomendados.controlador.php";
	require_once "../modelos/recomendados.modelo.php";

	class ajaxRecomendados{

		public $idRecomendado;
		public $numemp;
		public $nombreRecomendado;
		public $telRecomendado;
		public $comentarioContacto;

		public function ajaxEnviarRecomendado(){
				$item1 = "numemp_recomienda";
				$valor1 = $this->numemp;
				$item2 = "nombre_recomendado";
				$valor2 = $this->nombreRecomendado;
				$item3 = "tel_recomendado";
				$valor3 = $this->telRecomendado;
				$item4 = "comentario_contacto";
				$valor4 = $this->comentarioContacto;
				
				$respuesta = ControladorRecomendados::ctrEnviarRecomendado($item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);
				echo $respuesta;	
		}

		public function ajaxBuscarRecomendado(){
			$item = "id";
			$valor = $this -> idRecomendado;
			$respuesta = ControladorRecomendados::ctrBuscarRecomendado($item, $valor);

			echo json_encode($respuesta);
		}

	}


	if(isset($_POST["enviarRecomendado"])){

		
				

		if(isset($_POST["numEmp"]))
		{
			$recomendado = new ajaxRecomendados();
			$recomendado -> numemp = $_POST["numEmp"];
			$recomendado -> nombreRecomendado = $_POST["nombreRecomendado"];
			$recomendado -> telRecomendado = $_POST["telRecomendado"];
			$recomendado -> comentarioContacto = $_POST["comentarioContacto"];
							
			$recomendado -> ajaxEnviarRecomendado();
		}		
	}

	if(isset($_POST["buscarRecomendado"])){

		if(isset($_POST["idRecomendado"]))
		{
			$recomendado = new ajaxRecomendados();
			$recomendado -> idRecomendado = $_POST["idRecomendado"];
							
			$recomendado -> ajaxBuscarRecomendado();
		}		
	}

?>