<?php
class ControladorCargas{

	/*=============================================
		MOSTRAR CARGAS
	=============================================*/

	static public function ctrMostrarCargas($item, $valor){

		
		$tabla = "cargas";

		$respuesta = ModeloCargas::mdlMostrarCargas($tabla, $item, $valor);
		

		return $respuesta;
	
	}

	/*========================================
	CREAR CARGA
	=========================================*/
	static public function ctrCrearCarga(){
		if(isset($_POST["nuevaCarga"])){
			/*===============================================
			ACTUALIZAR LAS CARGAS DEL VEHICULO, REDUCIR EL STOCK 
			================================================*/
			$listaProductos=json_decode($_POST["listaProductos"],true);
			//var_dump($listaProductos);
			foreach ($listaProductos as $key => $value) {
				$tablaProductos="productos";
				$item="id";
				$valor=$value["id"];
				$orden="id";
				$traerProducto=ModeloProductos::mdlMostrarProductos($tablaProductos,$item,$valor,$orden);
				
				$item1a="ventas";
				$valor1a=$value["cantidad"] + $traerProducto["ventas"];
				$nuevasCargas=ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b="stock";
				$valor1b=$value["stock"];

				//var_dump($valor1b);
				$nuevoStock=ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);


			}
			/*=================================================
			GUARDAR LA CARGA
			===================================================*/

			$tabla="cargas";
			$datos=array("id_vehiculo"=>$_POST["seleccionarVehiculo"],
						 "productos"=>$_POST["listaProductos"],
						 "total"=>$_POST["totalCarga"],
						"fecha"=>$_POST["fechaCarga"]);
			$respuesta=ModeloCargas::mdlIngresarCarga($tabla, $datos);
			if($respuesta="ok"){
				echo '<script>

					swal({

						type: "success",
						title: "¡El vehículo ha sido cargado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "cargar-vehiculo";

						}

					});
				

					</script>';


			}
		}
	}

	/*========================================
		MODIFICAR CARGA
	=========================================*/	

	static public function ctrModificarEstadoCarga($idCarga, $valor){
		$tabla="cargas";
		$respuesta=ModeloCargas::mdlEditarEstadoCarga($idCarga, $valor);
	}


}