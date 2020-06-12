<?php
	require_once "conexion.php";
	class ModeloAvisos{

		static public function mdlMostrarAvisos($tabla, $item1, $valor1, $item2, $valor2){
	
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :valor1 AND $item2 >= :valor2 ORDER BY fecha_publicacion DESC");
			$stmt -> bindParam(":valor1", $valor1);
			$stmt -> bindParam(":valor2", $valor2);
			$stmt -> execute();
			return $stmt -> fetchAll();
			
			$stmt->close();
			$stmt = null;
		}

		static public function mdlMostrarAviso($tabla, $item, $valor){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :valor");
			$stmt -> bindParam(":valor", $valor);
			
			$stmt -> execute();
			return $stmt -> fetch();
			$stmt->close();
			$stmt = null;
		}

		static public function mdlEliminarAviso($tabla, $item, $valor){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha_expiracion = '1900-01-01' WHERE $item = :valor");
			
			$stmt -> bindParam(":valor", $valor);
			
			if($stmt->execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}
			$stmt->close();
			$stmt = null;
		}

		static public function mdlEditarAviso($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha_expiracion = :valor1 WHERE id = :valor2");
			
			$stmt -> bindParam(":valor1", $datos["fecha_exp"], PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $datos["idAviso"]);
			
			if($stmt->execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}
			$stmt->close();
			$stmt = null;
		}

		// static public function mdlMostrarCampañasPlaza($tabla, $item1, $valor1, $item2, $valor2){
		// 	if($item2 == null){
		// 		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :valor1");
		// 		$stmt -> bindParam(":valor1", $valor1);
		// 	}else{
		// 		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :valor1 AND $item2 = :valor2");
		// 		$stmt -> bindParam(":valor1", $valor1);
		// 		$stmt -> bindParam(":valor2", $valor2);
		// 	}
			
		// 	$stmt -> execute();
		// 	return $stmt -> fetchAll();
		// 	$stmt->close();
		// 	$stmt = null;
		// }

		// static public function mdlActivarCampaña($tabla, $item1, $valor1, $item2, $valor2){
		// 	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :valor1 WHERE $item2 = :valor2");
			
		// 	$stmt -> bindParam(":valor1", $valor1);
		// 	$stmt -> bindParam(":valor2", $valor2);
		// 	if($stmt->execute()){
		// 		return "ok";
		// 	}else{
		// 		return $stmt->errorInfo();
		// 	}
		// 	$stmt->close();
		// 	$stmt = null;
		// }

		static public function mdlAgregarAviso($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (numemp, texto, imagen, plaza, fecha_expiracion, importante) VALUES (:valor1, :valor2, :valor3, :valor4, :valor5, :valor6)");
			$stmt -> bindParam(":valor1", $datos["numemp"]);
			$stmt -> bindParam(":valor2", $datos["texto"]);
			$stmt -> bindParam(":valor3", $datos["imagen"]);
			$stmt -> bindParam(":valor4", $datos["plaza"]);
			$stmt -> bindParam(":valor5", $datos["fecha_exp"]);
			$stmt -> bindParam(":valor6", $datos["importante"]);
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