<?php
require_once "../controladores/horario.controlador.php";
require_once "../modelos/horario.modelo.php";

class AjaxControlAsistencias {
	public $numemp;
	public $fecha;
	public function ajaxBuscarComentario(){
		
		$item1 = "fecha";
		$valor1 = $this->fecha;
		$item2 = "numemp";
		$valor2 = $this->numemp;
		$respuesta = ControladorHorarios::ctrBuscarComentario($item1, $valor1, $item2, $valor2);
		echo json_encode($respuesta);
	}

}
/*=======================================
	=            BUSCAR COMENTARIO          =
	=======================================*/
	if(isset($_POST["buscarComentario"])){
		$buscarComentario = new AjaxControlAsistencias();
		$buscarComentario -> numemp = $_POST["numemp"];
		$buscarComentario -> fecha = $_POST["fechaComentario"];
		$buscarComentario -> ajaxBuscarComentario();
	}
?>