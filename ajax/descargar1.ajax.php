<?php

require_once "../controladores/cargas.controlador.php";
require_once "../modelos/cargas.modelo.php";

class AjaxDescargar1{

	/*=============================================
	DESCARGAR VEHICULO
	=============================================*/	

	public $idCarga;

	public function ajaxDescargarVehiculo1(){

		$item = "id";
		$valor = $this->idCarga;

		$respuesta1 = ControladorCargas::ctrMostrarCargas($item, $valor);
		
		echo json_encode($respuesta1);

	}
}

/*=============================================
DESCARGAR VEHICULO
=============================================*/	
if(isset($_POST["idCarga"])){
	$vehiculo = new AjaxDescargar1();
	$vehiculo -> idCarga = $_POST["idCarga"];
	$vehiculo -> ajaxDescargarVehiculo1();
}