<?php

require_once "../controladores/vehiculos.controlador.php";
require_once "../modelos/vehiculos.modelo.php";

class AjaxDescargar{

	/*=============================================
	DESCARGAR VEHICULO
	=============================================*/	

	public $idVehiculo;

	public function ajaxDescargarVehiculo(){

		$item = "id";
		$valor = $this->idVehiculo;

		$respuesta = ControladorVehiculos::ctrMostrarVehiculos($item, $valor);
		echo json_encode($respuesta);

	}
}

/*=============================================
DESCARGAR VEHICULO
=============================================*/	
if(isset($_POST["idVehiculo"])){
	$vehiculo = new AjaxDescargar();
	$vehiculo -> idVehiculo = $_POST["idVehiculo"];
	$vehiculo -> ajaxDescargarVehiculo();
}