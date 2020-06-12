<?php
	
	require_once "conexion.php";

	class ModeloSupervisores{
		/*========================================
		=            MOSTRAR SUPERVISORES     =
		========================================*/
		static public function mdlMostrarSupervisores($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3){
			if($item2 == null && $item3 == null){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :valor1");
				$stmt -> bindParam(":valor1", $valor1);
			}
			else if($item3 == null){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :valor1 AND $item2 = :valor2");
				$stmt -> bindParam(":valor1", $valor1);
				$stmt -> bindParam(":valor2", $valor2);

			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :valor1 AND $item2 = :valor2 AND $item3 = :valor3");
				$stmt -> bindParam(":valor1", $valor1);
				$stmt -> bindParam(":valor2", $valor2);
				$stmt -> bindParam(":valor3", $valor3);
			}
			
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		/*========================================
		=            MOSTRAR SUPERVISOR            =
		========================================*/
		static public function mdlMostrarSupervisor($tabla, $item1, $valor1){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :valor1 ");
			$stmt -> bindParam(":valor1", $valor1);
			$stmt -> execute();
			return $stmt -> fetch();
		}

		static public function mdlActivarSupervisor($tabla, $item1, $valor1, $item2, $valor2){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :valor1 WHERE $item2 = :valor2 ");
			$stmt -> bindParam(":valor1", $valor1);
			$stmt -> bindParam(":valor2", $valor2);
			if($stmt->execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}

		}

		static public function mdlAgregarSupervisor($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (apellido_paterno, apellido_materno, nombre, campana, plaza, estado) VALUES (:apellido_paterno, :apellido_materno, :nombre, :campana, :plaza, :estado)");
			
			$stmt -> bindParam(":apellido_paterno",$datos["paterno"]);
			$stmt -> bindParam(":apellido_materno", $datos["materno"]);
			$stmt -> bindParam(":nombre", $datos["nombre"]);
			$stmt -> bindParam(":campana", $datos["campana"]);
			$stmt -> bindParam(":plaza", $datos["plaza"]);
			$stmt -> bindParam(":estado", $datos["estado"]);

			if($stmt->execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}
		}
		
		
	}

?>