<?php
	class ControladorDescargas{

	/*========================================
	CREAR DESCARGA
	=========================================*/

	static public function ctrCrearDescarga(){
		if(isset($_POST["listaProductosDescarga"])){
			/*========================================
			ACTUALIZAR CARGA DEL VEHICULO, INCREMENTAR STOCK, GRABAR LA VENTA
			=========================================*/
			$listaProductos=json_decode($_POST["listaProductosDescarga"],true);
			//var_dump($listaProductos);
			foreach ($listaProductos as $key => $value) {
				//actualizar stock
				$tabla = "productos";
				$item="id";
				$valor=$value["id"];
				$orden="id";
				$traerProducto=ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden);
				//Actualizar valor de ventas de cada producto
				$item1="ventas";
				$valor1=$traerProducto["ventas"]-$value["cantidad"];
				$descargas=ModeloProductos::mdlActualizarProducto($tabla, $item1, $valor1, $valor);
				//Actualizar stock de cada producto
				$item2="stock";
				$valor2=$traerProducto["stock"]+$value["cantidad"];
				//echo($valor2);
				$nuevoStock=ModeloProductos::mdlActualizarProducto($tabla, $item2, $valor2, $valor);
			}

		//Guardar la descarga
		$tabla="descargas";
		$datos=array("id_carga" => $_POST["id_carga"],
					"id_vehiculo" => $_POST["id_vehiculo"],
					"productos" => $_POST["listaProductosDescarga"],
					"total" => $_POST["totalDescarga"],
					"fecha" => $_POST["fechaDescarga"],
					"estado" => "0");
		$respuesta = ModeloDescargas::mdlIngresarDescarga($tabla, $datos);
		if($respuesta="ok"){

			//Actualizar estado de la carga a "Descargado"
			$idCarga=$_POST["id_carga"];
			$valor3="descargado";
			$respuesta2 = ModeloCargas::mdlModificarEstadoCarga($idCarga,$valor3);

			if($respuesta2="ok"){
				echo '<script>

					swal({

						type: "success",
						title: "¡El vehiculo ha sido descargado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "descargar-vehiculo";

						}

					});
				

					</script>';

			}
		}

		/*========================================
		CREAR VENTA
		=========================================*/
		//CODIGO
		$item = null;
    	$valor = null;
    	$ventas = ControladorVentas::ctrMostrarVentas($item, $valor);
    	if(!$ventas){
    		$codigo=10001;
    	}
		else{
    		foreach ($ventas as $key => $value) {
                        
        	}
			$codigo = $value["codigo"] + 1;

    	}
     	//CODIGO DE CLIENTE
     	$idCliente=0;

     	//CODIGO DE VENDEDOR, TOMAR ID DEL VEHICULO
     	$idVehiculo=$_POST["id_vehiculo"];
		$tablaVehiculo="vehiculos";
		$itemVehiculo="id";
		$respuestaVehiculos=ModeloVehiculos::mdlMostrarVehiculos($tablaVehiculo, $itemVehiculo, $idVehiculo); 
		$placaVehiculo=$respuestaVehiculos["placa"];

     	//PRODUCTOS
     	//Restar carga - descarga, esos productos constituyen la venta.
     	//obtener carga
     	$idCarga=$_POST["id_carga"];
     	$item="id";
     	$valor=$idCarga;
     	$carga=ControladorCargas::ctrMostrarCargas($item, $valor);
     	$productosCarga=json_decode($carga["productos"],true);
     	$productosVenta=[];
     	$productosDescarga=json_decode($_POST["listaProductosDescarga"],true);
     	//var_dump($productosCarga);
	 	$i=0;
	 	foreach($productosCarga as $key=>$value){
			$idProducto=$value["id"];
			$productosVenta[$i]["id"]=$idProducto;
			$descripcionProducto=$value["descripcion"];
			$productosVenta[$i]["descripcion"]=$descripcionProducto;
			$cantidadProducto=$value["cantidad"]-$productosDescarga[$i]["cantidad"];
			$productosVenta[$i]["cantidad"]=$cantidadProducto;

			//obtener el stock  del producto y sumar la cantidad de la descarga
			$tabla = "productos";
			$item="id";
			$valor=$value["id"];
			$orden="id";
			$traerProducto=ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden);


			$stockProducto=$traerProducto["stock"]+$productosDescarga[$i]["cantidad"];
			$productosVenta[$i]["stock"]=$stockProducto;
			$precioProducto=$value["precio"];
			$productosVenta[$i]["precio"]=$precioProducto;
			$totalProducto=$value["total"];
			$productosVenta[$i]["total"]=$totalProducto;
			$unidadesProducto=$value["unidadesPaquete"];
			$productosVenta[$i]["unidadesPaquete"]=$unidadesProducto;

			$i=$i+1;
			//var_dump($i);

			//REGISTRAR KARDEX DEL PRODUCTO
			$tabla = "kardex";

			   	$datos = array("id_producto" => $idProducto,
							   "fecha" => $_POST["fechaDescarga"],
							   "concepto" => "Venta por vehiculo: ".$placaVehiculo,
							   "tipo" => 1,
							   "cantidad" => $cantidadProducto,
							   "valor_unitario" => $precioProducto,
							   "valor_total" => ($cantidadProducto/$unidadesProducto)*$precioProducto,
							   "saldo_cantidad" => $stockProducto,
							   "saldo_valor_unitario" => $precioProducto,
							   "saldo_valor_total" => ($stockProducto/$unidadesProducto) * $precioProducto);
			   	//var_dump($datos);

				$respuestaKardex = ModeloProductos::mdlAjustarProductos($tabla, $datos);


	 	}
		//var_dump($productosVenta);
		 
		//IMPUESTO
		$impuesto=($carga["total"]*0.12)-($_POST["totalDescarga"]*0.12);

		//NETO
		$neto=$carga["total"]-$_POST["totalDescarga"];

		//TOTAL
		$total=$neto/1.12;
		
		//METODO PAGO
		$metodoPago="Efectivo";


		//FECHA
		$fecha=$_POST["fechaDescarga"];

		//guardar la venta en la BD
		$tabla="ventas";

		//var_dump($codigo);

		 

		$datosVenta=array("codigo" => $codigo,
							"id_cliente" => $idCliente,
							"id_vendedor" => $idVehiculo,
							"productos" => json_encode($productosVenta,true),
							"impuesto" => $impuesto,
							"neto" => $neto,
							"total" => $total,
							"metodo_pago" => $metodoPago,
							"fecha" => $fecha);

		var_dump($datosVenta);

		$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datosVenta);
		



	}
	}


}
?>