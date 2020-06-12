<?php
	
	require_once "conexion.php";

	class ModeloHorarios{

		static public function mdlIngresarRegistroChecador($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4, $usuario){
			
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla ($item1, $item2, $item3, $item4, usuario_subio) VALUES (:valor1, :valor2, :valor3, :valor4, :usuario)");
			
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
			$stmt -> bindParam(":valor3", $valor3, PDO::PARAM_STR);
			$stmt -> bindParam(":valor4", $valor4, PDO::PARAM_STR);
			$stmt -> bindParam(":usuario", $usuario, PDO::PARAM_STR);
			if($stmt->execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}
		}

		static public function mdlBorrarRegistroChecador($tabla, $item1, $valor1, $item2, $valor2){

			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item1 = :valor1 AND $item2 = :valor2");
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
			
			if($stmt->execute()){
				return "ok";
			}else{
				return "error";
			}
		}

		static public function mdlIngresarRegistroAsistencias($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4, $item5, $valor5){
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla ($item1, $item2, $item3, $item4, $item5) VALUES (:valor1, :valor2, :valor3, :valor4, :valor5)");
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
			$stmt -> bindParam(":valor3", $valor3, PDO::PARAM_STR);
			$stmt -> bindParam(":valor4", $valor4, PDO::PARAM_STR);
			$stmt -> bindParam(":valor5", $valor5, PDO::PARAM_STR);
			if($stmt->execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}
		}

		static public function mdlContabilizarFaltas($tabla, $numemp, $fechaInicio, $fechaFin){
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) AS TOTAL FROM $tabla WHERE numemp = :numemp AND fecha >= :fechaInicio AND fecha <= :fechaFin AND calificacion IN ('FI', 'FJ', 'P', 'I', 'R', 'RA')");
			
			$stmt -> bindParam(":numemp", $numemp, PDO::PARAM_STR);	
			$stmt -> bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);	
			$stmt -> bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR);	
			
			$stmt->execute();
			return $stmt -> fetch();	
		}

		static public function mdlContabilizarAsistencias($tabla, $numemp, $fechaInicio, $fechaFin){
			$stmt = Conexion::conectar()->prepare("SELECT fecha FROM $tabla WHERE numemp = :numemp AND fecha >= :fechaInicio AND fecha <= :fechaFin AND calificacion = 'A' ");
	

			$stmt -> bindParam(":numemp", $numemp, PDO::PARAM_STR);	
			$stmt -> bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);	
			$stmt -> bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR);	
				
			$stmt->execute();
			return $stmt -> fetchAll();	
		}



		static public function mdlBuscarRetardos($tabla, $numemp, $fechaInicio, $fechaFin){
			$stmt = Conexion::conectar()->prepare("SELECT fecha  FROM $tabla WHERE numemp = :numemp AND fecha >= :fechaInicio AND fecha <= :fechaFin AND calificacion = 'R'");
			
			$stmt -> bindParam(":numemp", $numemp, PDO::PARAM_STR);	
			$stmt -> bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);	
			$stmt -> bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR);	
			
			$stmt->execute();
			return $stmt -> fetchAll();	
		}

		static public function mdlBuscarComentario($tabla, $item1, $valor1, $item2, $valor2){
			$stmt = Conexion::conectar()->prepare("SELECT comentario  FROM $tabla WHERE $item1 = :valor1 AND $item2 = :valor2");
			
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);	
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);	
			
			
			$stmt->execute();
			return $stmt -> fetch();	
		}

		static public function mdlBuscarUltimaFecha($tabla, $item1, $valor1){
			$stmt = Conexion::conectar()->prepare("SELECT fecha FROM $tabla WHERE $item1 = :valor1 ORDER BY fecha DESC");
			
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);	
			
			$stmt->execute();
			return $stmt -> fetch();	
		}
	}

?>
