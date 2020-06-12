<?php
	require_once "conexion.php";
	class ModeloTurno{
		static public function mdlMostrarTurno($tabla, $item, $valor){
			if($item == null){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
				$stmt -> execute();
				return $stmt -> fetchAll();	
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
				$stmt -> bindParam(":$item", $valor);
				$stmt -> execute();
				return $stmt -> fetch();			
			}
			$stmt->close();
			$stmt = null;
		}

		static public function mdlMostrarTurnos($tabla){
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id");
			$stmt -> execute();
			return $stmt -> fetchAll();	
			
			$stmt->close();
			$stmt = null;
		}

		static public function mdlMostrarTurnosPorPlaza($tabla, $item1, $valor1, $item2, $valor2){
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :valor1 AND $item2 = :valor2");
			$stmt -> bindParam(":valor1", $valor1);
			$stmt -> bindParam(":valor2", $valor2);

			$stmt -> execute();
			return $stmt -> fetchAll();				
			$stmt->close();
			$stmt = null;
		}

		static public function mdlMostrarTurnoPlaza($tabla, $item1, $valor1){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :valor1");
			$stmt -> bindParam(":valor1", $valor1);

			$stmt -> execute();
			return $stmt -> fetchAll();				
			$stmt->close();
			$stmt = null;
		}

		static public function mdlActivarTurno($tabla, $item1, $valor1, $item2, $valor2){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :valor1 WHERE $item2 = :valor2");
			$stmt -> bindParam(":valor1", $valor1);
			$stmt -> bindParam(":valor2", $valor2);

			if($stmt->execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}

			$stmt->close();
			$stmt = null;
		}

		static public function mdlAgregarTurno($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (horario_entrada, horario_salida, plaza, estado) VALUES (:valor1, :valor2, :valor3, :valor4)");
			$stmt -> bindParam(":valor1", $datos["entrada"]);
			$stmt -> bindParam(":valor2", $datos["salida"]);
			$stmt -> bindParam(":valor3", $datos["plaza"]);
			$stmt -> bindParam(":valor4", $datos["estado"]);
			if($stmt->execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}

			$stmt->close();
			$stmt = null;
		}
	}

?>