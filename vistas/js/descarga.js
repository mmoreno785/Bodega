/*=============================================
DESCARGA DE VEHICULO
=============================================*/
$(".tablas").on("click", ".btnDescargar", function(){

	var idVehiculo = $(this).attr("idVehiculo");
	var datos = new FormData();
	datos.append("idVehiculo", idVehiculo);
	
	

	$.ajax({
		url: "ajax/descargar.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			$("#descargarVehiculo").val(respuesta["placa"]);
			//alert(respuesta["placa"]);
		}
	})
	var idCarga = $(this).attr("idCarga");
	var idVehiculo = $(this).attr("idVehiculo");
	$("#id_carga").val(idCarga);
	$("#id_vehiculo").val(idVehiculo);

	var datosCarga = new FormData();
	datosCarga.append("idCarga", idCarga);
	//alert (idCarga);

	$.ajax({
		url: "ajax/descargar1.ajax.php",
		method: "POST",
		data: datosCarga,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta1){
			var capa=document.getElementById("productos");
			//capa.innerHTML = "<input type='text' value ='hello' readonly>";
			//capa.innerHTML = "<input type='text' value ='Hi' readonly>";
			
			

			productos=JSON.parse(respuesta1["productos"]);
			numProductos=productos.length;
			varHtml='';
			varHtml = varHtml + '<div class="row" style="padding:0px 0px">';
			varHtml = varHtml + '<div class="col-xs-6" style="padding:0px">';
			varHtml = varHtml + 'Producto';
			varHtml = varHtml + '</div>';
			varHtml = varHtml + '<div class="col-xs-1" style="padding:0px">';
			varHtml = varHtml + 'Paq.';
			varHtml = varHtml + '</div>';
			varHtml = varHtml + '<div class="col-xs-1" style="padding:0px">';
			varHtml = varHtml + 'Uni.';
			varHtml = varHtml + '</div>';
			varHtml = varHtml + '<div class="col-xs-1" style="padding:0px">';
			varHtml = varHtml + 'Total';
			varHtml = varHtml + '</div>';
			varHtml = varHtml + '<div class="col-xs-1" style="padding:0px">';
			varHtml = varHtml + 'Precio';
			varHtml = varHtml + '</div>';
			varHtml = varHtml + '</div>';

			for (var i = 0; i <= numProductos-1; i++) {
				varHtml = varHtml + '<div class="row" style="padding:0px 0px 0px 0px">';
				paquetes =(productos[i]["cantidad"]/productos[i]["unidadesPaquete"]);
				paquetes=paquetes - (paquetes % 1);
				unidades=productos[i]["cantidad"] % productos[i]["unidadesPaquete"];
				
				varHtml = varHtml + '<div class="col-xs-6" style="padding:0px">';
				varHtml = varHtml + '<input class="form-control descargaDescripcion" name="descargaDescripcion" id="descargaDescripcion" tabindex="-1" idProducto="' + productos[i]["id"] + '" type="text"  readonly value="'+ productos[i]["descripcion"] + ' '+' Carga: '+ paquetes + '.'+ unidades + '">';
				varHtml = varHtml + '</div>';
				varHtml = varHtml + '<div class="col-xs-1 ingresoPaquetes" style="padding:0px 0px 0px 0px">';
				
				varHtml = varHtml + '<input type="number" class="form-control descargaPaquetes"  min="0"  value="0">';
				varHtml = varHtml + '<input class="form-control descargaUnidadesPaquete" type="hidden" value="'+ productos[i]["unidadesPaquete"] +'">';
				varHtml = varHtml + '<input class="form-control descargaPrecio" type="hidden" value="'+ productos[i]["precio"] +'">';
				varHtml = varHtml + '</div>';
				varHtml = varHtml + '<div class="col-xs-1 ingresoUnidades" style="padding:0px">';
				varHtml = varHtml + '<input type="number" class="form-control descargaUnidades" min="0"  value="0">';
				varHtml = varHtml + '</div>';
				varHtml = varHtml + '<div class="col-xs-1 ingresoCantidad" style="padding:0px">';
				varHtml = varHtml + '<input class="form-control descargaCantidad" type="number"  tabindex="-1" readonly name="descargaCantidad" id="descargaCantidad" value="0">';
				//alert(productos[i]["stock"]);
				varHtml = varHtml + '</div>';
				varHtml = varHtml + '<div class="col-xs-2 ingresoTotal" style="padding:0px">';
				varHtml = varHtml + '<input class="form-control descargaTotal" name="descargaTotal" id="descargaTotal" type="number" tabindex="-1" readonly value="0">';
				varHtml = varHtml + '</div>';
				varHtml = varHtml + '</div>';

			}
			//alert (varHtml);
			
			capa.innerHTML = varHtml;
			listarProductosDescarga();
			sumarTotalPreciosDescarga();
			//alert(numProductos);
		}
	})
})

/*=======================================================
MODIFICANDO CANTIDAD DE PRODUCTO
========================================================*/
$(".formularioDescarga").on("change","input.descargaPaquetes",function(){
	var unidadesPaquete = $(this).parent().children(".descargaUnidadesPaquete");
	var paquetes = $(this).val();
	var unidades = $(this).parent().parent().children(".ingresoUnidades").children(".descargaUnidades");
	var stockTotal = Number(paquetes*unidadesPaquete.val())+Number(unidades.val());
	var precio=$(this).parent().children(".descargaPrecio");
	var total = $(this).parent().parent().children(".ingresoCantidad").children(".descargaCantidad");
	var precioTotal=$(this).parent().parent().children(".ingresoTotal").children(".descargaTotal");
	var valorPrecioTotal=(Number(precio.val())/Number(unidadesPaquete.val()))*stockTotal;
	precioTotal.val(valorPrecioTotal);
	total.val(stockTotal);
	listarProductosDescarga();
	sumarTotalPreciosDescarga();
})


$(".formularioDescarga").on("change","input.descargaUnidades",function(){
	var unidadesPaquete = $(this).parent().parent().children(".ingresoPaquetes").children(".descargaUnidadesPaquete");
	var unidades = $(this).val();
	var paquetes = $(this).parent().parent().children(".ingresoPaquetes").children(".descargaPaquetes");
	var stockTotal = Number(paquetes.val()*unidadesPaquete.val())+Number(unidades);
	var precio=$(this).parent().parent().children().children(".descargaPrecio");
	var total = $(this).parent().parent().children(".ingresoCantidad").children(".descargaCantidad");
	var precioTotal=$(this).parent().parent().children(".ingresoTotal").children(".descargaTotal");
	var valorPrecioTotal=(Number(precio.val())/Number(unidadesPaquete.val()))*stockTotal;
	precioTotal.val(valorPrecioTotal);
	total.val(stockTotal);
	listarProductosDescarga();
	sumarTotalPreciosDescarga();
})
/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPreciosDescarga(){

	var precioItem = $(".descargaTotal");
	var sumaPrecioTodos=0; 

	for(var i = 0; i < precioItem.length; i++){

		sumaPrecioTodos=sumaPrecioTodos + Number($(precioItem[i]).val());

		

		 //alert($(precioItem[i]).val());
		 //arraySumaPrecio.push(Number($(precioItem[i]).val()));
		
		 
	}

	$("#totalDescarga").val(sumaPrecioTodos);
	//alert (sumaPrecioTodos);
}

/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductosDescarga(){
	var listaProductos = [];
	var descripcion = $(".descargaDescripcion");
	var cantidad = $(".descargaCantidad");
	var precio = $(".descargaPrecio");
	var unidadesPaquete = $(".descargaUnidadesPaquete");
	var total= $(".descargaTotal");
	for(var i = 0; i < descripcion.length; i++){
		listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"), 
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(descargaCantidad[i]).val(),
							  "unidadesPaquete" : $(unidadesPaquete[i]).val(),
							  "stock" : Number($(cantidad[i]).attr("stock"))+Number($(cantidad[i]).val()),
							  "precio" : $(precio[i]).val(),
							  "total" : $(total[i]).val()})


	}
	alert(JSON.stringify(listaProductos));

	$("#listaProductosDescarga").val(JSON.stringify(listaProductos));
}