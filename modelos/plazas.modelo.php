<?php
	
	require_once "conexion.php";

	class ModeloPlazas{
		/*========================================
		=            MOSTRAR USUARIOS            =
		========================================*/
		static public function mdlMostrarPlazas($tabla){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		static public function mdlMostrarPlazasActivas($tabla){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado = 1");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		static public function mdlMostrarPlaza($tabla, $item, $valor){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":$item", $valor);
			$stmt -> execute();
			return $stmt -> fetch();
		}

		static public function mdlActivarPlaza($tabla, $item1, $valor1, $item2, $valor2){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :valor1 WHERE $item2 = :valor2 ");
			$stmt -> bindParam(":valor1", $valor1);
			$stmt -> bindParam(":valor2", $valor2);
			if($stmt->execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}

		}

		static public function mdlAgregarPlaza($tabla, $nombre, $estado){
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, estado) VALUES (:nombre, :estado)");
			
			$stmt -> bindParam(":nombre", $nombre);
			$stmt -> bindParam(":estado", $estado);
			

			if($stmt->execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}
		}
		
	}

?>