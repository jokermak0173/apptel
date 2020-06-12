<?php

	require_once "conexion.php";

	class ModeloRecomendados {

		static public function mdlEnviarRecomendado($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4){



			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla ($item1, $item2, $item3, $item4, estado) VALUES (:valor1, :valor2, :valor3, :valor4, 0)");

			$stmt -> bindParam(":valor1", $valor1,PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2,PDO::PARAM_STR);
			$stmt -> bindParam(":valor3", $valor3,PDO::PARAM_STR);
			$stmt -> bindParam(":valor4", $valor4,PDO::PARAM_STR);


			if($stmt->execute()){
				return 1;
			}else{
				return $stmt->errorInfo();
			}
		}

		static public function mdlMostrarRecomendados($tabla, $item, $valor){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado NOT IN (9,19,29, 39, 49) AND $item = :valor AND fecha_revision >= (CURDATE() - INTERVAL 15 DAY) UNION SELECT * FROM recomendados WHERE estado IN (9,19,29, 39, 49) AND $item = :valor");
			$stmt -> bindParam(":valor", $valor);

			$stmt -> execute();
			return $stmt -> fetchAll();
			$stmt->close();
			$stmt = null;
		}

		static public function mdlMostrarRecomendadosPlaza($tabla, $item, $valor, $item2, $valor2){
			$stmt = Conexion::conectar()->prepare("SELECT u.nombre_completo, u.numemp, u.supervisor, r.id,r.nombre_recomendado, r.tel_recomendado, r.estado, r.fecha_creacion, r.comentario_contacto FROM usuario u INNER JOIN recomendados r ON u.numemp = r.numemp_recomienda WHERE $item = :valor AND $item2 = :valor2");
			$stmt -> bindParam(":valor", $valor);
			$stmt -> bindParam(":valor2", $valor2);
			$stmt -> execute();
			return $stmt -> fetchAll();
			$stmt->close();
			$stmt = null;
		}

		static public function mdlBuscarRecomendado($tabla, $item, $valor){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :valor");
			$stmt -> bindParam(":valor", $valor);

			$stmt -> execute();
			return $stmt -> fetch();
			$stmt->close();
			$stmt = null;
		}

		static public function mdlCalificarRecomendado($tabla, $id, $calificacion, $comentario){
			$item1 = "estado";
			$item2 = "comentario_revision";
			$item3 = "id";
			$valor1 = $calificacion;
			$valor2 = $comentario;
			$valor3 = $id;
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :valor1, $item2 = :valor2 WHERE $item3 = :valor3");

			$stmt -> bindParam(":valor1", $valor1,PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2,PDO::PARAM_STR);
			$stmt -> bindParam(":valor3", $valor3,PDO::PARAM_STR);



			if($stmt->execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}
		}

		static public function mdlMostrarRecomendadosPorFechas($fecha1, $fecha2, $plaza){

			$stmt = Conexion::conectar()->prepare("SELECT u.nombre_completo, u.numemp, u.supervisor, u.plaza, u.campana, u.turno, r.id,r.nombre_recomendado, r.tel_recomendado, r.estado, r.comentario_contacto, r.comentario_revision, r.reviso, r.fecha_creacion, r.fecha_revision
				FROM usuario u INNER JOIN recomendados r ON u.numemp = r.numemp_recomienda
				WHERE u.plaza = :valor1 AND fecha_creacion between :valor2 and :valor3 ORDER BY fecha_creacion ASC");

			$stmt -> bindParam(":valor1", $plaza, PDO::PARAM_INT);
			$stmt -> bindParam(":valor2", $fecha1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor3", $fecha2, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetchAll();
		}
	}


?>
