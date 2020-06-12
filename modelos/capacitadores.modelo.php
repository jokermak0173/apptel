<?php
	require_once "conexion.php";

	class ModeloCapacitadores{

		static public function mdlMostrarCapacitadores($tabla, $item1, $valor1, $item2, $valor2){
			if($item2 == null){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE  $item1 = :valor1");		
				$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE  $item1 = :valor1 AND $item2 = :valor2");		
				$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
				$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_INT);
			}
			
			$stmt -> execute();
			return $stmt -> fetchAll();
			$stmt->close();
			$stmt = null;
		}

		static public function mdlMostrarCapacitadorPorId($tabla, $item1, $valor1){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE  $item1 = :valor1");		
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
			$stmt -> execute();
			return $stmt -> fetch();
			$stmt->close();
			$stmt = null;		}

		static public function mdlAgregarCapacitador($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (apellido_paterno, apellido_materno, nombre, plaza, estado) VALUES (:apellido_paterno, :apellido_materno, :nombre, :plaza, :estado)");	

			$stmt -> bindParam(":apellido_paterno", $datos["paterno"], PDO::PARAM_STR);
			$stmt -> bindParam(":apellido_materno", $datos["materno"], PDO::PARAM_STR);
			$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":plaza", $datos["plaza"], PDO::PARAM_STR);
			$stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_STR);

			if($stmt -> execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}
			
			$stmt->close();
			$stmt = null;
		}

		static public function mdlActivarCapacitador($tabla, $item1, $valor1, $item2, $valor2){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :valor1 WHERE $item2 = :valor2");

			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_INT);

			if($stmt -> execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}
			
			$stmt->close();
			$stmt = null;
		}
	}

?>