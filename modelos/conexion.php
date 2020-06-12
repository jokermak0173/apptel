<?php

	class Conexion{
		public function conectar(){
			$link = new PDO("mysql:host=localhost;dbname=mi_atel;charset=utf8", "mi_atel_web", "Pa\$\$MiAtelWeb2019.", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$link->exec("set names utf8");

			return $link;
		}
	}

?>