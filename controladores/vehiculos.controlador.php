<?php

class ControladorVehiculos{

	/*=============================================
	REGISTRO DE VEHICULO
	=============================================*/

	static public function ctrCrearVehiculo(){

		if(isset($_POST["nuevaPlaca"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaPlaca"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaMarca"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoModelo"])){

				$tabla = "vehiculos";

				$datos = array("placa" => $_POST["nuevaPlaca"],
					           "marca" => $_POST["nuevaMarca"],
					           "modelo" => $_POST["nuevoModelo"],
					           "ano" => $_POST["nuevoAno"],
					           "responsable" => $_POST["nuevoResponsable"]);

				$respuesta = ModeloVehiculos::mdlIngresarVehiculo($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El vehículo ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "vehiculos";

						}

					});
				

					</script>';


				}	


			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El vehiculo no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "vehiculos";

						}

					});
				

				</script>';

			}


		}


	}

	/*=============================================
	MOSTRAR VEHICULO
	=============================================*/

	static public function ctrMostrarVehiculos($item, $valor){

		$tabla = "vehiculos";

		$respuesta = ModeloVehiculos::MdlMostrarVehiculos($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR VEHICULO
	=============================================*/

	static public function ctrEditarVehiculo(){

		if(isset($_POST["editarPlaca"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarMarca"])){

				$tabla = "vehiculos";

				$datos = array("placa" => $_POST["editarPlaca"],
							   "marca" => $_POST["editarMarca"],
							   "modelo" => $_POST["editarModelo"],
							   "ano" => $_POST["editarAno"],
							   "responsable" => $_POST["editarResponsable"]);

				$respuesta = ModeloVehiculos::mdlEditarVehiculo($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El vehiculo ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "vehiculos";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El modelo no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "vehiculos";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR VEHICULO
	=============================================*/

	static public function ctrBorrarVehiculo(){

		if(isset($_GET["idVehiculo"])){

			$tabla ="vehiculos";
			$datos = $_GET["idVehiculo"];

			$respuesta = ModeloVehiculos::mdlBorrarVehiculo($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El vehículo ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "vehiculos";

								}
							})

				</script>';

			}		

		}

	}


}
	


