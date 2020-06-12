<?php
	
	require_once "conexion.php";

	class ModeloUsuarios{
		/*========================================
		=            MOSTRAR USUARIOS            =
		========================================*/
		static public function mdlMostrarUsuarios($tabla, $item, $valor){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
			$stmt->close();
			$stmt = null;
		}

		static public function mdlMostrarUsuariosActivos($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :valor1 AND $item2 = :valor2 AND $item3 = :valor3");
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
			$stmt -> bindParam(":valor3", $valor3, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
			$stmt->close();
			$stmt = null;
		}

		static public function mdlTraerTokens($tabla, $item1, $valor1, $item2, $valor2){
			$stmt = Conexion::conectar()->prepare("SELECT token FROM $tabla WHERE $item1 = :valor1 AND $item2 = :valor2");
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
			
			$stmt -> execute();
			return $stmt -> fetchAll();
			$stmt->close();
			$stmt = null;
		}

		static public function mdlTraerTokensCampana($tabla, $item1, $valor1, $item2, $valor2){
			$stmt = Conexion::conectar()->prepare("SELECT token FROM $tabla WHERE $item1 = :valor1 AND $item2 = :valor2");
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
			
			$stmt -> execute();
			return $stmt -> fetchAll();
			$stmt->close();
			$stmt = null;
		}

		/*========================================
		=            MOSTRAR ASESORES            =
		========================================*/
		static public function mdlMostrarAsesores($tabla, $valores){
			$item = "plaza";
			$item2 = "status_usuario";
			$item3 = "nivel_acceso";
			$item4 = "status_usuario";
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE  $item = :valor  AND $item3 = :valor3 AND $item4 = :valor4");		
			$stmt -> bindParam(":valor", $valores["plaza"], PDO::PARAM_STR);
			//$stmt -> bindParam(":valor2", $valores["status"], PDO::PARAM_STR);
			$stmt -> bindParam(":valor3", $valores["nivel_acceso"], PDO::PARAM_INT);
			$stmt -> bindParam(":valor4", $valores["status_usuario"], PDO::PARAM_INT);
			$stmt -> execute();
			return $stmt -> fetchAll();
			$stmt->close();
			$stmt = null;
		}

		/*========================================
		=            MOSTRAR USUARIOS SISTEMAS          =
		========================================*/
		static public function mdlMostrarUsuariosSistemas($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $valor4, $valor5, $valor6){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE  $item1 = :valor1 AND $item2 = :valor2 AND $item3 IN(:valor3, :valor4, :valor5, :valor6)");		
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
			$stmt -> bindParam(":valor3", $valor3, PDO::PARAM_STR);
			$stmt -> bindParam(":valor4", $valor4, PDO::PARAM_STR);
			$stmt -> bindParam(":valor5", $valor5, PDO::PARAM_STR);
			$stmt -> bindParam(":valor6", $valor6, PDO::PARAM_STR);

			$stmt -> execute();
			return $stmt -> fetchAll();
			$stmt->close();
			$stmt = null;
		}

		/*========================================
		=            MOSTRAR USUARIOS ROOT          =
		========================================*/
		static public function mdlMostrarUsuariosRoot($tabla, $item1, $valor1){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :valor1 AND nivel_acceso IN (1, 2, 3, 4, 6, 7, 999)");		
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			
			

			

			$stmt -> execute();
			return $stmt -> fetchAll();
			$stmt->close();
			$stmt = null;
		}

		/*========================================
		=            MOSTRAR ASESORES            =
		========================================*/
		static public function mdlMostrarAsesorPorId($tabla, $item, $valor){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE  $item = :valor");		
			$stmt -> bindParam(":valor", $valor, PDO::PARAM_INT);
			$stmt -> execute();
			return $stmt -> fetch();
			$stmt->close();
			$stmt = null;
		}

		static public function mdlMostrarAsesorChecador($tabla, $item1, $valor1, $item2, $valor2){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE  $item1 = :valor1 AND $item2 = :valor2");		
			
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_INT);
			$stmt -> execute();
			return $stmt -> fetch();
			$stmt->close();
			$stmt = null;
		}

		static public function mdlLiberarSesionUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :valor1, $item2 = :valor2, $item3 = :valor3 WHERE $item4 = :valor4");
			
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
			$stmt -> bindParam(":valor3", $valor3, PDO::PARAM_STR);
			$stmt -> bindParam(":valor4", $valor4, PDO::PARAM_STR);

			
			if($stmt->execute()){
				return "ok";
			}else{
				return "error";
			}
			$stmt->close();
			$stmt = null;
		}

		static public  function mdlIngresarUsuario($tabla, $datos){
			

			
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(numemp, password, nombre_completo, id_checador, plaza, campana, turno, nivel_acceso, foto, status_usuario, supervisor, ultimo_login, status_sesion, ip_pc, nombre_pc) VALUES(:numemp, :password, :nombres, :id_checador, :plaza, :campana, :turno, :nivel_acceso, :foto, :status_usuario, :supervisor, '0000-00-00', 0, '', '')");

			
			$stmt -> bindParam(":numemp", $datos["numemp"], PDO::PARAM_INT);
			
			$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
			
			$stmt -> bindParam(":nombres", $datos["nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_checador", $datos["idchecador"], PDO::PARAM_STR);
			$stmt -> bindParam(":plaza", $datos["plaza"], PDO::PARAM_STR);
			$stmt -> bindParam(":campana", $datos["campana"], PDO::PARAM_STR);
			$stmt -> bindParam(":turno", $datos["turno"], PDO::PARAM_STR);
			$stmt -> bindParam(":nivel_acceso", $datos["nivel"], PDO::PARAM_STR);
			$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
			$stmt -> bindParam(":status_usuario", $datos["status"], PDO::PARAM_STR);
			$stmt -> bindParam(":supervisor", $datos["supervisor"], PDO::PARAM_STR);

			
			
		
			
			if($stmt->execute()){
				return "ok";
			}else{
		
				return $stmt->errorInfo();
			}
		}

		static public  function mdlIngresarUsuarioPorArchivo($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4, $item5, $valor5, $item6, $valor6, $item7, $valor7, $item8, $valor8, $item9, $valor9, $item10, $valor10){
			
			
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla ($item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8, $item9, $item10, ultimo_login, status_sesion, ip_pc, nombre_pc, foto) VALUES(:valor1, :valor2, :valor3, :valor4, :valor5, :valor6, :valor7, :valor8, :valor9, :valor10, '0000-00-00', 0, '', '', 'vistas/img/asesores/anonymous.png')");

			
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
			$stmt -> bindParam(":valor3", $valor3, PDO::PARAM_STR);
			$stmt -> bindParam(":valor4", $valor4, PDO::PARAM_STR);
			$stmt -> bindParam(":valor5", $valor5, PDO::PARAM_STR);
			$stmt -> bindParam(":valor6", $valor6, PDO::PARAM_STR);
			$stmt -> bindParam(":valor7", $valor7, PDO::PARAM_STR);
			$stmt -> bindParam(":valor8", $valor8, PDO::PARAM_STR);
			$stmt -> bindParam(":valor9", $valor9, PDO::PARAM_STR);
			$stmt -> bindParam(":valor10", $valor10, PDO::PARAM_STR);
			
			
			
			
		
			
			if($stmt->execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}
		}
		
		
		
		/*=====  End of MOSTRAR ASESORES  ======*/
		
		/*========================================
		=            EDITAR ASESOR            =
		========================================*/
		static public function mdlEditarAsesor($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET password = :password, nombre_completo = :nombres, campana = :campana, turno = :turno, foto = :foto, nivel_acceso = :nivel_acceso, supervisor = :supervisor WHERE numemp = :numemp");

			$datos["paterno"] = str_replace("??", "ñ", $datos["paterno"]);
			$datos["materno"] = str_replace("??", "ñ", $datos["materno"]);
			$datos["nombre"] = str_replace("??", "ñ", $datos["nombre"]);

			$stmt -> bindParam(":numemp", $datos["numemp"], PDO::PARAM_INT);
			$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
			$stmt -> bindParam(":nombres", $datos["nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":campana", $datos["campaña"], PDO::PARAM_STR);
			$stmt -> bindParam(":turno", $datos["turno"], PDO::PARAM_STR);
			$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
			$stmt -> bindParam(":nivel_acceso", $datos["nivel"], PDO::PARAM_STR);
			$stmt -> bindParam(":supervisor", $datos["supervisor"], PDO::PARAM_STR);
			if($stmt->execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}
		}

		/*========================================
		=         ACTUALIZAR ASESOR            =
		========================================*/
		static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :valor1, id_checador = null WHERE $item2 = :valor2");

			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);

			$asesor = ModeloUsuarios::mdlMostrarUsuarios("usuario", "numemp", $valor2);
			$stmt2 = Conexion::conectar()->prepare("DELETE FROM checador WHERE id_checador = :valor");
			$stmt2 -> bindParam(":valor", $asesor["id_checador"], PDO::PARAM_INT);

			$stmt3 = Conexion::conectar()->prepare("DELETE FROM control_asistencias WHERE numemp = :numemp ");
			$stmt3 -> bindParam(":numemp", $valor2, PDO::PARAM_STR);
			

			if($stmt->execute() && $stmt2->execute() && $stmt3->execute()){
				return "ok";
			}else{
				return "error";
			}

			$stmt -> close();
			$stmt = null;
			$stmt2 -> close();
			$stmt2 = null;
			$stmt3 -> close();
			$stmt3 = null;
		}

		static public function mdlActualizarLoginUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4, $item5, $valor5)
		
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :valor1, $item3 = :valor3, $item4 = :valor4, $item5 = :valor5 WHERE $item2 = :valor2");
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
			$stmt -> bindParam(":valor3", $valor3, PDO::PARAM_STR);
			$stmt -> bindParam(":valor4", $valor4, PDO::PARAM_STR);
			$stmt -> bindParam(":valor5", $valor5, PDO::PARAM_STR);
			

			if($stmt->execute()){
				return "ok";
			}else{
				return "error";
			}

			$stmt -> close();
			$stmt = null;
		}

		static public function mdlActualizarLogoutUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4 )
		
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item2 = :valor2, $item3 = :valor3, $item4 = :valor4  WHERE $item1 = :valor1");
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
			$stmt -> bindParam(":valor3", $valor3, PDO::PARAM_STR);
			$stmt -> bindParam(":valor4", $valor4, PDO::PARAM_STR);
			
			

			if($stmt->execute()){
				return "ok";
			}else{
				return "error";
			}

			$stmt -> close();
			$stmt = null;
		}

		static public function mdlCambiarPassAsesor($tabla, $item1, $valor1, $item2, $valor2){

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :valor1 WHERE $item2 = :valor2");
			
			
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
			

			if($stmt->execute()){
				return "ok";
			}else{
				return "error".$stmt->errorInfo();
			}

			$stmt -> close();
			$stmt = null;

		}

		static public function mdlCambio($tabla, $item1, $valor1, $item2, $valor2){
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla ($item1, $item2) VALUES (:valor1, :valor2)");
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
			

			if($stmt->execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();
			}

			$stmt -> close();
			$stmt = null;
		}
	}

?>