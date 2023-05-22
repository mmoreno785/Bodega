	/*=/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-ventas.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// })// 



$('.tablaCargas').DataTable( {
    "ajax": "ajax/datatable-cargas.ajax.php",
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
/*================================================
CARGAR PRODUCTOS A CARGAR AL CAMI[ON
================================================*/
$(".tablaCargas tbody").on("click","button.agregarProducto",function(){
	var idProducto = $(this).attr("idProducto");
	console.log("idProducto",idProducto);
	$(this).removeClass("btn-primary agregarProducto");
	$(this).addClass("btn-default");
	var datos = new FormData();
	datos.append("idProducto",idProducto);
	$.ajax({
		url:"ajax/productos.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){
			var descripcion = respuesta["descripcion"];
          	var stock = respuesta["stock"];
          	var precio = respuesta["precio_venta"];
          	var unidades = respuesta["unidades"];

          	/*EVITAR QUE AGREGUE SI EL STOCK ES CERO*/
          	if(stock==0){
          		swal({
          			title: "No hay stock disponible",
          			type: "error",
          			confirmButtonText: "Cerrar"
          		});

          		$("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");
          		return;
          	}

          	$(".nuevoProducto").append(

          	'<div class="row" style="padding:0px 0px 0px 0px">'+

			  '<!-- Descripción del producto -->'+
	          
	          '<div class="col-xs-6" style="padding:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+

	            '</div>'+

	          '</div>'+

	          '<!-- Paquetes del producto -->'+

	          '<div class="col-xs-1 ingresoPaquetes" style="padding:0px 0px 0px 0px;" >'+
	            
	             '<input type="number" class="form-control nuevaPaquetesProducto" name="nuevaPaquetesProducto" min="0" value="0" required>'+

	          '</div>' +

	          '<!-- Unidades del producto -->'+

	          '<div class="col-xs-1 ingresoUnidades" style="padding:0px 0px 0px 0px">'+
	            
	             '<input type="number" class="form-control nuevaUnidadesProducto" name="nuevaUnidadesProducto" min="0" value="0" required>'+

	          '</div>' +



	          '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-2 ingresoCantidad" style="padding:0px 0px 0px 0px">'+
	            
	             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="0" value="0" stock="'+stock+'" nuevoStock="'+Number(stock-unidades)+'"  readonly required>'+

	          '</div>' +

	          '<!-- Unidades del producto -->'+
	          '<div class="col-xs-1 ingresoUnidadesPaquete" style="padding:0px 0px 0px 0px">'+

	          
	             '<input type="hidden" class="form-control nuevoUnidadesPaquete" name="nuevoUnidadesPaquete" id="nuevoUnidadesPaquete" unidadesPaquete="'+unidades+'" value="'+unidades+'">'+

	          '</div>' +

	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-2 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+
	                 
	              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" style="text-align:right" value="0" readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	        '</div>') 
		}


	});

});

/*=======================================================
CADA VEZ QUE CARGUE LA TABLA O NAVEGUE EN ELLA
========================================================*/
$(".tablaCargas").on("draw.dt",function(){
	if(localStorage.getItem("quitarProducto")!= null){
		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));
		for(var i=0;i<listaIdProductos.length;i++){
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');

		}
	}
})

/*=======================================================
QUITANDO PRODUCTOS  DE LA CARGA Y RECUPERAR EL BOTON 
========================================================*/

localStorage.removeItem("quitarProducto");


$(".formularioCarga").on("click","button.quitarProducto",function(){
	$(this).parent().parent().parent().parent().remove();
	var idProducto=$(this).attr("idProducto");
	/*=====================================================
	ALMACENAR EN EL DATASTORAGE EL ID DEL PRODUCTO QUE SE VA A QUITAR
	==========================================================*/
	if(localStorage.getItem("quitarProducto")==null){
		idQuitarProducto=[];
	}else{
		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

	}
	idQuitarProducto.push({"idProducto":idProducto});
	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

	$("button.recuperarBoton[idProducto='" + idProducto + "']").removeClass('btn-default');
	$("button.recuperarBoton[idProducto='" + idProducto + "']").addClass('btn-primary agregarProducto');
})


/*=======================================================
MODIFICANDO CANTIDAD DE PRODUCTO
========================================================*/

$(".formularioCarga").on("change","input.nuevaPaquetesProducto",function(){
	var cantidadTotal = $(this).parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");
	var unidadesPaquete = $(this).parent().parent().children(".ingresoUnidadesPaquete").children(".nuevoUnidadesPaquete");
	var unidades = $(this).parent().parent().children(".ingresoUnidades").children(".nuevaUnidadesProducto");
	var total=Number($(this).val()*unidadesPaquete.val())+Number(unidades.val());
	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	if(Number(total) > Number(cantidadTotal.attr("stock"))){

		//alert ("Ingreso");

		/*=============================================
		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
		=============================================*/

		$(this).val(0);
		cantidadTotal.val(0);
		unidades.val(0);
		precio.val(0);

		//cantidadTotal.attr("nuevoStock", cantidadTotal.attr("stock"));
		//var precioTotal = Number($(this).val()*precioPaquete)+Number(unidades.val()*precioUnidad);

		//var precioFinal = cantidadTotal.val() * cantidadTotal.attr("precioReal");

		//precio.val(precioTotal);

		//sumarTotalPrecios();

		swal({
	      title: "La cantidad supera el Stock",
	      text: "¡Sólo hay "+cantidadTotal.attr("stock")+" unidades!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	    return;

	}


	
	var precioPaquete = precio.attr("precioReal");
	var precioUnidad =precio.attr("precioReal")/unidadesPaquete.val();
	var precioTotal = Number($(this).val()*precioPaquete)+Number(unidades.val()*precioUnidad);
	precio.val(precioTotal); 
	cantidadTotal.val(total);
	sumarTotalPrecios();
	listarProductos();
})

$(".formularioCarga").on("change","input.nuevaUnidadesProducto",function(){
	var cantidadTotal = $(this).parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");
	var unidadesPaquete = $(this).parent().parent().children(".ingresoUnidadesPaquete").children(".nuevoUnidadesPaquete");
	var paquetes = $(this).parent().parent().children(".ingresoPaquetes").children(".nuevaPaquetesProducto");
	var total = Number(paquetes.val()*unidadesPaquete.val())+Number($(this).val());
	cantidadTotal.val(total);
	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	if(Number(total) > Number(cantidadTotal.attr("stock"))){

		//alert ("Ingreso");

		/*=============================================
		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
		=============================================*/

		$(this).val(0);
		cantidadTotal.val(0);
		paquetes.val(0);
		precio.val(0);

		//cantidadTotal.attr("nuevoStock", cantidadTotal.attr("stock"));
		//var precioTotal = Number($(this).val()*precioPaquete)+Number(unidades.val()*precioUnidad);

		//var precioFinal = cantidadTotal.val() * cantidadTotal.attr("precioReal");

		//precio.val(precioTotal);

		//sumarTotalPrecios();

		swal({
	      title: "La cantidad supera el Stock",
	      text: "¡Sólo hay "+cantidadTotal.attr("stock")+" unidades!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	    return;

	}
	var precioPaquete=precio.attr("precioReal");
	var precioUnidad =precio.attr("precioReal")/unidadesPaquete.val();
	var precioTotal=Number(paquetes.val()*precioPaquete)+Number($(this).val()*precioUnidad);
	precio.val(precioTotal);
	sumarTotalPrecios();
	listarProductos();

	
})


/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPrecios(){
	//alert("sumar");

	var precioItem = $(".nuevoPrecioProducto");
	var sumaPrecioTodos=0; 

	for(var i = 0; i < precioItem.length; i++){

		sumaPrecioTodos=sumaPrecioTodos + Number($(precioItem[i]).val());

		

		 //alert($(precioItem[i]).val());
		 //arraySumaPrecio.push(Number($(precioItem[i]).val()));
		
		 
	}

	$("#totalCarga").val(sumaPrecioTodos);
	//alert (sumaPrecioTodos);
}


/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos(){

	//alert("ingreso");
	var listaProductos = [];
	var descripcion = $(".nuevaDescripcionProducto");
	var cantidad = $(".nuevaCantidadProducto");
	var precio = $(".nuevoPrecioProducto");
	var unidadesPaquete = $(".nuevoUnidadesPaquete");

	for(var i = 0; i < descripcion.length; i++){
		listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"), 
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "unidadesPaquete" : $(unidadesPaquete[i]).attr("unidadesPaquete"),
							  "stock" : Number($(cantidad[i]).attr("stock"))-Number($(cantidad[i]).val()),
							  "precio" : $(precio[i]).attr("precioReal"),
							  "total" : $(precio[i]).val()})
	}

	$("#listaProductos").val(JSON.stringify(listaProductos)); 

	/*alert (JSON.stringify(listaProductos));*/

}


/*=============================================
DATEPICKER
=============================================*/
$("#fechaCarga").datepicker({
	format: 'yyyy-mm-dd',
	language: 'es',
   	autoclose: true,
    todayBtn: true
		});












