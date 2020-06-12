<?php

	require_once "conexion.php";

	class ModeloPermutas{

		static public function mdlEnviarPermuta($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4, $item5, $valor5, $item6, $valor6, $item7, $valor7, $item8, $valor8, $item9, $valor9, $item10, $valor10, $item11, $valor11){



			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla ($item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8, $item9, $item10, $item11, supervisor_acepta, fecha_acepta, dispositivo) VALUES (:valor1, :valor2, :valor3, :valor4, :valor5, :valor6, :valor7, :valor8, :valor9, :valor10, :valor11, '', null, 'web')");

			$stmt -> bindParam(":valor1", $valor1,PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2,PDO::PARAM_STR);
			$stmt -> bindParam(":valor3", $valor3,PDO::PARAM_STR);
			$stmt -> bindParam(":valor4", $valor4,PDO::PARAM_STR);
			$stmt -> bindParam(":valor5", $valor5,PDO::PARAM_STR);
			$stmt -> bindParam(":valor6", $valor6,PDO::PARAM_STR);
			$stmt -> bindParam(":valor7", $valor7,PDO::PARAM_STR);
			$stmt -> bindParam(":valor8", $valor8,PDO::PARAM_STR);
			$stmt -> bindParam(":valor9", $valor9,PDO::PARAM_STR);
			$stmt -> bindParam(":valor10", $valor10,PDO::PARAM_STR);
			$stmt -> bindParam(":valor11", $valor11,PDO::PARAM_STR);

			if($stmt->execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}
		}

		static public function mdlBuscarPermutasCalendario($tabla, $valor1){

			$stmt = Conexion::conectar()->prepare("SELECT id,  asesor_solicita, supervisor_solicita,  fecha_solicita AS start, estado AS  color, tipo_permuta AS title, asesor_acepta, supervisor_acepta, fecha_acepta, reviso, comentario, fecha_revision, fecha_cierre, turno_cubre_solicita, turno_cubre_acepta FROM $tabla WHERE fecha_solicita >= CURDATE() AND asesor_solicita = :valor1");

			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetchAll();
		}

		static public function mdlBuscarEvento($tabla, $item1, $valor1, $item2, $valor2){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :valor1 AND $item2 = :valor2");

			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetchAll();
		}

		static public function mdlBuscarEventoRepetido($tabla, $item1, $valor1, $item2, $valor2){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :valor1 AND $item2 = :valor2 AND estado IN('enviada', 'autorizada', 'aceptada')");

			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetchAll();
		}

		static public function mdlValidarPermuta($tabla, $item1, $valor1, $item2, $valor2){

			$stmt = Conexion::conectar()->prepare("SELECT estado, COUNT(*) AS TOTAL FROM $tabla WHERE($item1 = :valor1 or fecha_cierre = :valor1)AND ($item2 = :valor2 OR asesor_acepta = :valor2) GROUP BY estado");
			// $ar = fopen("mdlValidarPermuta.txt", "w");
			// fwrite($ar, "SELECT estado, COUNT(*) AS TOTAL FROM $tabla WHERE(($item1 = $valor1)AND ($item2 = $valor2 OR asesor_acepta = $valor2)) OR (($item3 = $valor3)AND ($item2 = $valor2 OR asesor_acepta = $valor2)) GROUP BY estado");
			// fclose($ar);
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
			$stmt -> bindParam(":valor3", $valor3, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetchAll();
		}

		static public function mdlBorrarPermuta($tabla, $item1, $valor1){
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item1 = :valor1");

			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);

			if($stmt->execute()){
				return "eliminada";
			}else{
				return $stmt->errorInfo();
			}
		}

		static public function mdlCancelarPermuta($tabla, $item1, $valor1, $valor2, $valor3, $fecha){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :valor4, reviso = :valor2, comentario = :valor3, fecha_revision = :fecha WHERE $item1 = :valor1");
			$valor4 = "cancelada";
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
			$stmt -> bindParam(":valor3", $valor3, PDO::PARAM_STR);
			$stmt -> bindParam(":valor4", $valor4, PDO::PARAM_STR);
			$stmt -> bindParam(":fecha", $fecha, PDO::PARAM_STR);

			if($stmt->execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}
		}

		static public function mdlAutorizarPermuta($tabla, $item1, $valor1, $valor2, $fecha){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :valor3, reviso = :valor2, fecha_revision = :fecha WHERE $item1 = :valor1");
			$valor3 = "autorizada";
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_INT);
			$stmt -> bindParam(":valor3", $valor3, PDO::PARAM_STR);
			$stmt -> bindParam(":fecha", $fecha, PDO::PARAM_STR);


			if($stmt->execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}
		}

		static public function mdlDenegarPermuta($tabla, $item1, $valor1, $valor2, $valor3, $fecha){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :valor4, reviso = :valor2, comentario = :valor3, fecha_revision = :fecha WHERE $item1 = :valor1");
			$valor4 = "denegada";
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_INT);
			$stmt -> bindParam(":valor3", $valor3, PDO::PARAM_STR);
			$stmt -> bindParam(":valor4", $valor4, PDO::PARAM_STR);
			$stmt -> bindParam(":fecha", $fecha, PDO::PARAM_STR);


			if($stmt->execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}
		}

		static public function mdlMostrarPermutas($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 >= :valor1 AND $item2 = :valor2 AND $item3 = :valor3 AND $item4 != :valor4 ORDER BY fecha_solicita ASC");

			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
			$stmt -> bindParam(":valor3", $valor3, PDO::PARAM_STR);
			$stmt -> bindParam(":valor4", $valor4, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetchAll();
		}

		static public function mdlMostrarPermutasDia($tabla, $item1, $valor1, $valor2){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :valor1 AND (asesor_solicita = :valor2 OR asesor_acepta = :valor2) AND estado IN ('enviada', 'aceptada', 'autorizada')");

			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);

			$stmt->execute();
			return $stmt -> fetchAll();
		}

		static public function mdlMostrarPermutasFecha($tabla, $item1, $valor1, $valor2){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :valor1 AND (asesor_solicita = :valor2 OR asesor_acepta = :valor2) AND estado IN ('enviada', 'aceptada', 'autorizada')");

			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);

			$stmt->execute();
			return $stmt -> fetchAll();
		}

		static public function mdlMostrarPermutasPorFechas($tabla, $fecha1, $fecha2, $campana){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_solicita >= :fecha1 AND fecha_solicita <= :fecha2 AND plaza = :campana ORDER BY fecha_solicita ASC");

			$stmt -> bindParam(":fecha1", $fecha1, PDO::PARAM_STR);
			$stmt -> bindParam(":fecha2", $fecha2, PDO::PARAM_STR);
			$stmt -> bindParam(":campana", $campana, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt -> fetchAll();
		}

		static public function mdlMostrarPermutasQueAcepte($tabla, $item1, $valor1, $item2, $item3, $valor3){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 >= :valor1 AND $item2 IN ('aceptada', 'cancelada', 'autorizada', 'denegada') AND $item3 = :valor3 ORDER BY fecha_solicita ASC");

			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor3", $valor3, PDO::PARAM_STR);

			$stmt->execute();
			return $stmt -> fetchAll();
		}

		static public function mdlConsolidarPermuta($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4, $item5, $valor5){


			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :valor1, $item3 = :valor3, $item4 = :valor4, $item5 = :valor5 WHERE $item2 = :valor2");

			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
			$stmt -> bindParam(":valor3", utf8_decode($valor3), PDO::PARAM_STR);
			$stmt -> bindParam(":valor4", $valor4, PDO::PARAM_STR);
			$stmt -> bindParam(":valor5", $valor5, PDO::PARAM_STR);
			if($stmt->execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}
		}

		static public function mdlActualizarPermuta($tabla, $item1, $valor1, $item2, $valor2){

			// $ar = fopen("mdlActualizarPermuta.txt", "w");
			// fwrite($ar, "UPDATE $tabla SET $item2 = :valor2WHERE $item1 = :valor1")
			// fclose($ar);

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item2 = :valor2 WHERE $item1 = :valor1");

			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);

			if($stmt->execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}
		}

		static public function mdlMostrarPermutaPorId($tabla, $item1, $valor1){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :valor1");

			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);

			$stmt->execute();
			return $stmt -> fetch();
		}

	}

?>
