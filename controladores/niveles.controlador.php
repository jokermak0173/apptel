<?php
	class ControladorNiveles{

		static public function ctrMostrarNivel($item1, $valor1){
			$tabla = "nivel_acceso";
			$respuesta = ModeloNiveles::mdlMostrarNivel($tabla, $item1, $valor1);
			return $respuesta;
		}
	}

?>