/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/

$.ajax({

	url: "ajax/datatable-productos.ajax.php",
	success:function(respuesta){
		
		console.log("respuesta", respuesta);

	}

})

var perfilOculto = $("#perfilOculto").val();

$('.tablaProductos').DataTable( {
    "ajax": "ajax/datatable-productos.ajax.php?perfilOculto="+perfilOculto,
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );

/*=============================================
CAPTURANDO LA CATEGORIA PARA ASIGNAR CÓDIGO
=============================================*/
// $("#nuevaCategoria").change(function(){

// 	var idCategoria = $(this).val();

// 	var datos = new FormData();
//   	datos.append("idCategoria", idCategoria);

//   	$.ajax({

//       url:"ajax/productos.ajax.php",
//       method: "POST",
//       data: datos,
//       cache: false,
//       contentType: false,
//       processData: false,
//       dataType:"json",
//       success:function(respuesta){

//       	if(!respuesta){

//       		var nuevoCodigo = idCategoria+"01";
//       		$("#nuevoCodigo").val(nuevoCodigo);

//       	}else{

//       		var nuevoCodigo = Number(respuesta["codigo"]) + 1;
//           	$("#nuevoCodigo").val(nuevoCodigo);

//       	}
                
//       }

//   	})

// })


/*=============================================
CALCULO DE STOCK
=============================================*/
$("#nuevoStockPaquetes, #nuevoStockUnidades, #nuevoUnidades, #nuevoStockPalletes").change(function(){
	var paquetesEnPallete = $("#nuevoPaquetesEnPallete").val();
	var unidadesPorPaquete = $("#nuevoUnidades").val();
	var nuevoStockPalletes = $("#nuevoStockPalletes").val();
	var nuevoStockUnidades = $("#nuevoStockUnidades").val();
	var nuevoStockPaquetes = $("#nuevoStockPaquetes").val();
	var totalPaquetes = (Number(paquetesEnPallete)*Number(nuevoStockPalletes))+Number(nuevoStockPaquetes);
	var Stock=(totalPaquetes*Number(unidadesPorPaquete))+Number(nuevoStockUnidades);
	$("#nuevoStock").val(Stock);
	
	
})







/*=============================================
SUBIENDO LA FOTO DEL PRODUCTO
=============================================*/

$(".nuevaImagen").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaImagen").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaImagen").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================
AJUSTAR PRODUCTO
=============================================*/
$(".tablaProductos tbody").on("click", "button.btnAjustarProducto", function(){

	var idAjusteProducto = $(this).attr("idAjusteProducto");
	$("#ajustarId").val(idAjusteProducto);

	var codigoAjusteProducto =$(this).attr("codigoAjusteProducto");
	$("#ajustarCodigo").val(codigoAjusteProducto);

	var unidadesPorPaquete=$(this).attr("unidadesPorPaquete");
	var stock=$(this).attr("stock");
	$("#ajusteSaldoCantidad").val(stock);
	$("#ajusteStock").val(stock);
	$("#ajusteUnidadesPorPaquete").val(unidadesPorPaquete);

	var precioCompra=$(this).attr("precioCompra");
	$("#ajusteValorUnitario").val(precioCompra);
	$("#ajusteSaldoValorUnitario").val(precioCompra);




	//alert(stock);

})
/*=============================================
CALCULO DE CANTIDAD, VALOR Y SALDO TOTAL AL AJUSTAR PRODUCTO
=============================================*/
$("#ajusteCantidadPaquetes, #ajusteCantidadUnidades, #ajusteValorUnitario").change(function(){
	var unidadesPorPaquete = $("#ajusteUnidadesPorPaquete").val();
	//alert(unidadesPorPaquete);
	var cantidadPaquetes = $("#ajusteCantidadPaquetes").val();
	//alert (cantidadPaquetes);
	var cantidadUnidades = $("#ajusteCantidadUnidades").val();
	//alert (cantidadUnidades);
	var cantidadTotal=(Number(unidadesPorPaquete)*Number(cantidadPaquetes))+Number(cantidadUnidades);
	$("#ajusteCantidadTotal").val(cantidadTotal);
	var valorUnitario =$("#ajusteValorUnitario").val();
	//alert (valorUnitario);
	var valorTotal=(Number(valorUnitario)/Number(unidadesPorPaquete))*Number(cantidadTotal);
	//lert(valorTotal);
	$("#ajusteValorTotal").val(valorTotal);
	//saldo cantidad total
	var stock = $("#ajusteStock").val();
	
	var operacion = $("#ajusteOperacion").val();
	if(operacion!=0){
		//es salida
		var saldoCantidad=Number(stock)-Number(cantidadTotal);
	}else{
		//es entrada
		var saldoCantidad=Number(stock)+Number(cantidadTotal);
	}
	
	$("#ajusteSaldoCantidad").val(saldoCantidad);
	//Saldo Valor total
	var saldoValorTotal = (Number(saldoCantidad)/Number(unidadesPorPaquete))*Number(valorUnitario);
	$("#saldoValorTotal").val(saldoValorTotal)



	
})
/*=============================================
PONER VALOR UNITARIO DE ACUERDO A LA OPERACION
=============================================*/
$("#ajusteOperacion").change(function(){
	var operacion = $("#ajusteOperacion").val();
	var precioCompra=$("button.btnAjustarProducto").attr("precioCompra");
	var precioVenta=$("button.btnAjustarProducto").attr("precioVenta");
	if(operacion!=0){
		//es salida
		$("#ajusteValorUnitario").val(precioVenta);
		$("#ajusteSaldoValorUnitario").val(precioVenta);
	}else{
		//es entrada
		$("#ajusteValorUnitario").val(precioCompra);
		$("#ajusteSaldoValorUnitario").val(precioCompra);
	}
	
})



/*=============================================
EDITAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	
	var datos = new FormData();
    datos.append("idProducto", idProducto);

     $.ajax({

      url:"ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
          
          var datosCategoria = new FormData();
          datosCategoria.append("idCategoria",respuesta["id_categoria"]);

           $.ajax({

              url:"ajax/categorias.ajax.php",
              method: "POST",
              data: datosCategoria,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
                  
                  $("#editarCategoria").val(respuesta["id"]);
                  $("#editarCategoria").html(respuesta["categoria"]);

              }

          })

           $("#editarCodigo").val(respuesta["codigo"]);

           $("#editarDescripcion").val(respuesta["descripcion"]);

           $("#editarStock").val(respuesta["stock"]);

           $("#editarPrecioCompra").val(respuesta["precio_compra"]);

           $("#editarPrecioVenta").val(respuesta["precio_venta"]);

           if(respuesta["imagen"] != ""){

           	$("#imagenActual").val(respuesta["imagen"]);

           	$(".previsualizar").attr("src",  respuesta["imagen"]);

           }

      }

  })

})

/*=============================================
ELIMINAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEliminarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	var codigo = $(this).attr("codigo");
	var imagen = $(this).attr("imagen");
	
	swal({

		title: '¿Está seguro de borrar el producto?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar producto!'
        }).then(function(result) {
        if (result.value) {

        	window.location = "index.php?ruta=productos&idProducto="+idProducto+"&imagen="+imagen+"&codigo="+codigo;

        }


	})

})

/*=============================================
DATEPICKER
=============================================*/
$("#fechaAjuste").datepicker({
	format: 'yyyy-mm-dd',
	language: 'es',
   	autoclose: true,
    todayBtn: true
		});

/*=============================================
IMPRIMIR KARDEX
=============================================*/

$(".tablaProductos").on("click", ".btnImprimirKardex", function(){

	var idProducto = $(this).attr("idProducto");

	window.open("extensiones/fpdf/kardex.php?idProducto="+idProducto, "_blank");

	

})

/*=============================================
IMPRIMIR SALDOS
=============================================*/

$(".btnReporteSaldos").on("click", function(){

	

	window.open("extensiones/fpdf/ReporteSaldos.php", "_blank");

	

})



	
