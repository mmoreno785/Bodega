<?php

require_once "conexion.php";

class ModeloCargas{
	/*========================================
	REGISTRO DE CARGA
	==========================================*/
	static public function mdlIngresarCarga($tabla, $datos){
		//var_dump($tabla);
		//var_dump($datos);
		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla(id_vehiculo, productos, total, fecha) VALUES (:id_vehiculo, :productos, :total, :fecha)");
		$stmt->bindParam(":id_vehiculo", $datos["id_vehiculo"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}
		$stmt->close;
		$stmt=null;

	}

/*=============================================
	MOSTRAR cargas
	=============================================*/

	static public function mdlMostrarCargas($tabla, $item, $valor){
		

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			//echo "Paso la prueba";

			if ($item =="id") {
				return $stmt -> fetch();
			}else{

				return $stmt -> fetchAll();


			}

			

			
		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*======================================
	MODIFICAR CARGA
	=======================================*/

	static public function mdlModificarEstadoCarga($idCarga, $valor){
		$tabla="cargas";
		$stmt=Conexion::conectar()->prepare("UPDATE $tabla set estado = :estado WHERE id=:id");
		$stmt -> bindParam(":estado",$valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $idCarga, PDO::PARAM_INT);
		$stmt -> execute();

	}


}

