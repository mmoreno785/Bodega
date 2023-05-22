<?php
require_once "conexion.php";
class ModeloKardex
{
	/*=============================================
	MOSTRAR KARDEX
	=============================================*/
	static public function mdlMostrarKardex($tabla, $item, $valor, $orden)
	{
		if ($item != null) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = $valor ORDER BY $orden");
			//$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll();
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		$stmt->close();
		$stmt = null;
	}
}
