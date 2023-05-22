<?php
class ControladorKardex
{
	/*=============================================
	MOSTRAR KARDEX
	=============================================*/
	static public function ctrMostrarKardex($item, $valor, $orden)
	{
		$tabla = "kardex";
		$respuesta = ModeloKardex::mdlMostrarKardex($tabla, $item, $valor, $orden);
		return $respuesta;
	}
}
