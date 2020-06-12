<?php
	
	class ControladorHorarioChecador{

		
		
		static public function ctrBuscarHorarioEntrada($item1, $valor1, $item2, $valor2){
			
					
			$tabla = "checador";
			$respuesta = ModeloHorarioChecador::mdlBuscarHorarioEntrada($tabla, $item1, $valor1, $item2, $valor2);
			return $respuesta;
			
		}

		static public function ctrBuscarHorarioSalida($item1, $valor1, $item2, $valor2){
			
					
			$tabla = "checador";
			$respuesta = ModeloHorarioChecador::mdlBuscarHorarioSalida($tabla, $item1, $valor1, $item2, $valor2);
			return $respuesta;
			
		}

		static public function ctrBuscarAsistencias($item1, $valor1){
			
					
			$tabla = "control_asistencias";
			$respuesta = ModeloHorarioChecador::mdlBuscarAsistencias($tabla, $item1, $valor1);
			return $respuesta;
			
		}

		
	}

?>