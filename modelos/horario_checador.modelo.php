<?php
	
	require_once "conexion.php";

	class ModeloHorarioChecador{

	

		static public function mdlBuscarHorarioEntrada($tabla, $item1, $valor1, $item2, $valor2){

			$stmt = Conexion::conectar()->prepare("SELECT concat(fecha, 'T', min(hora)) start, color, title FROM $tabla WHERE  $item1 = :valor1 and $item2 = :valor2 GROUP BY date(fecha)");
			$ar = fopen("mdlBuscarHorarioEntrada.txt", "w");
			fwrite($ar, "SELECT concat(fecha, 'T', min(hora)) start, color, title FROM $tabla WHERE  $item1 = $valor1 and $item2 = $valor2 GROUP BY date(fecha)");
			fclose($ar);
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt -> fetchAll();	
		}

		static public function mdlBuscarHorarioSalida($tabla, $item1, $valor1, $item2, $valor2){

			$stmt = Conexion::conectar()->prepare("SELECT concat(fecha, 'T', max(hora)) start, color FROM $tabla WHERE  $item1 = :valor1 and $item2 = :valor2 GROUP BY date(fecha)");
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt -> fetchAll();	
		}

		static public function mdlBuscarAsistencias($tabla, $item1, $valor1){

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla WHERE $item1 = :valor1");
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetchAll();	
		}

		static public function mdlBuscarRetardoFecha($tabla, $fecha, $id_checador, $plaza){

			$stmt = Conexion::conectar()->prepare("SELECT min(hora) AS HORA from $tabla WHERE fecha = :fecha AND id_checador = :id_checador AND plaza = :plaza");
			$stmt -> bindParam(":fecha", $fecha, PDO::PARAM_STR);
			$stmt -> bindParam(":id_checador", $id_checador, PDO::PARAM_STR);
			$stmt -> bindParam(":plaza", $plaza, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetch();	
		}
	}

?>