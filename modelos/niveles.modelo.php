<?php
	require_once "conexion.php";
	class ModeloNiveles{
		static public function mdlMostrarNivel($tabla, $item, $valor){
			if($item == null){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
				$stmt -> execute();
				return $stmt -> fetchAll();	
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :valor");
				$stmt -> bindParam(":valor", $valor);
				$stmt -> execute();
				return $stmt -> fetch();			
			}
			$stmt->close();
			$stmt = null;
		}
	}

?>