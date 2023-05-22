<?php

require_once "conexion.php";

class ModeloVehiculos{

	/*=============================================
	MOSTRAR VEHICULOS
	=============================================*/

	static public function mdlMostrarVehiculos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE VEHICULO
	=============================================*/

	static public function mdlIngresarVehiculo($tabla, $datos){

		echo("tabla: " . $tabla);
		echo ("placa: " . $datos["placa"]);
		echo ("marca: " . $datos["marca"]);
		echo ("modelo: " . $datos["modelo"]);
		echo ("ano: " . $datos["ano"]);
		echo ("responsable: " . $datos["responsable"]);


		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(placa, marca, modelo, ano, responsable) VALUES (:placa, :marca, :modelo, :ano, :responsable)");

		$stmt->bindParam(":placa", $datos["placa"], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":ano", $datos["ano"], PDO::PARAM_STR);
		$stmt->bindParam(":responsable", $datos["responsable"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
	EDITAR VEHICULO
	=============================================*/

	static public function mdlEditarVehiculo($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET marca = :marca, modelo = :modelo, ano = :ano, responsable = :responsable WHERE placa = :placa");

		$stmt -> bindParam(":placa", $datos["placa"], PDO::PARAM_STR);
		$stmt -> bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt -> bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt -> bindParam(":ano", $datos["ano"], PDO::PARAM_STR);
		$stmt -> bindParam(":responsable", $datos["responsable"], PDO::PARAM_STR);

		echo $datos["responsable"];
		

		if($stmt -> execute()){

			

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	BORRAR VEHICULO
	=============================================*/

	static public function mdlBorrarVehiculo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

}