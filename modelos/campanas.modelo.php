<?php
	require_once "conexion.php";
	class ModeloCampañas{

		static public function mdlMostrarCampaña($tabla, $item, $valor){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id");
			$stmt -> bindParam(":$item", $valor);
			$stmt -> execute();
			return $stmt -> fetch();
			$stmt->close();
			$stmt = null;
		}

		static public function mdlMostrarCampañasPlaza($tabla, $item1, $valor1, $item2, $valor2){
			if($item2 == null){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :valor1 ORDER BY id");
				$stmt -> bindParam(":valor1", $valor1);
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :valor1 AND $item2 = :valor2 ORDER BY id");
				$stmt -> bindParam(":valor1", $valor1);
				$stmt -> bindParam(":valor2", $valor2);
			}
			
			$stmt -> execute();
			return $stmt -> fetchAll();
			$stmt->close();
			$stmt = null;
		}

		static public function mdlActivarCampaña($tabla, $item1, $valor1, $item2, $valor2){
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

		static public function mdlAgregarCampaña($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3){
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla ($item1, $item2, $item3) VALUES (:valor1, :valor2, :valor3)");
			$stmt -> bindParam(":valor1", $valor1);
			$stmt -> bindParam(":valor2", $valor2);
			$stmt -> bindParam(":valor3", $valor3);
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