<?php

require_once "conexion.php";

class ModeloDescargas{
	/*========================================
	REGISTRO DE DESCARGA
	==========================================*/
	static public function mdlIngresarDescarga($tabla, $datos){
		//var_dump($tabla);
		//var_dump($datos["total"]);
		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla(id_carga, id_vehiculo, productos, total, fecha, estado) VALUES (:id_carga, :id_vehiculo, :productos, :total, :fecha, :estado)");
		$stmt->bindParam(":id_carga", $datos["id_carga"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vehiculo", $datos["id_vehiculo"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}
		$stmt->close;
		$stmt=null;

	}
}