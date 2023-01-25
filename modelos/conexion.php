<?php 

class Conexion{

	static public function conectar(){

		#PDO("nombre del servidor; nombre de la base de datos", "usuario", "contrase単a")

		$link = new PDO("mysql:host=localhost;dbname=coberpac_sobre1", 
			            "root", 
			            "");

		$link->exec("set names utf8");

		return $link;

	}

}
