<?php

require_once "../controladores/vehiculos.controlador.php";
require_once "../modelos/vehiculos.modelo.php";

class AjaxVehiculos{

	/*=============================================
	EDITAR VEHICULO
	=============================================*/	

	public $idVehiculo;

	public function ajaxEditarVehiculo(){

		$item = "id";
		$valor = $this->idVehiculo;

		$respuesta = ControladorVehiculos::ctrMostrarVehiculos($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR VEHICULO
=============================================*/	
if(isset($_POST["idVehiculo"])){

	$vehiculo = new AjaxVehiculos();
	$vehiculo -> idVehiculo = $_POST["idVehiculo"];
	$vehiculo -> ajaxEditarVehiculo();
}
