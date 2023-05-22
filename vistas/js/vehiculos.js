/*=============================================
EDITAR VEHICULO
=============================================*/
$(".tablas").on("click", ".btnEditarVehiculo", function(){

	var idVehiculo = $(this).attr("idVehiculo");

	

	var datos = new FormData();
	datos.append("idVehiculo", idVehiculo);

	$.ajax({
		url: "ajax/vehiculos.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		

     		$("#editarPlaca").val(respuesta["placa"]);
     		$("#editarMarca").val(respuesta["marca"]);
     		$("#editarModelo").val(respuesta["modelo"]);
     		$("#editarAno").val(respuesta["ano"]);
     		$("#editarResponsable").val(respuesta["responsable"]);

     	

     	}

	})


})

/*=============================================
ELIMINAR VEHICULO
=============================================*/
$(".tablas").on("click", ".btnEliminarVehiculo", function(){

	 var idVehiculo = $(this).attr("idVehiculo");

	 swal({
	 	title: '¿Está seguro de borrar el vehículo?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar vehículo!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=vehiculos&idVehiculo="+idVehiculo;

	 	}

	 })

})