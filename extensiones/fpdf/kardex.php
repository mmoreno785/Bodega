<?php
require('fpdf.php');
require_once "../../controladores/productos.controlador.php";
require_once "../../modelos/productos.modelo.php";
require_once "../../controladores/kardex.controlador.php";
require_once "../../modelos/kardex.modelo.php";

$pdf = new FPDF();
$pdf->AddPage("landscape");
$pdf->SetFont('Arial','B',16);
$pdf->Image('logo.jpg',20,10,25,0,"JPEG");
$pdf->setXY(95,10);
$pdf->Cell(40,10,utf8_decode('Distribuciones Santamaría - Kardex'));
$idProducto=$_GET['idProducto'];
//$pdf->Cell(40,10,utf8_decode($idProducto));

$item = "id";
$valor = $idProducto;
$orden = "id";

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);	
$descripcion=$productos['descripcion'];
$codigo=$productos['codigo'];
$imagen='..//..//'.$productos['imagen'];
$tipoImagen = substr($imagen, -3);

if($tipoImagen=="JPG" or $tipoImagen=="jpg"){
	$pdf->Image($imagen,20,10,25,0,"JPG");
}else{
	$pdf->Image($imagen,20,10,25,0,"PNG");
}

//		$pdf->Cell(30,50,utf8_decode($tipoImagen));

$pdf->Ln();
$pdf->setX(50);
$pdf->Cell(30,10,utf8_decode($codigo));
$pdf->Cell(40,10,utf8_decode($descripcion));
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->setX(118);
$pdf->Cell(54,7,utf8_decode('ENTRADAS'),1,0,'C');
$pdf->Cell(54,7,utf8_decode('SALIDAS'),1,0,'C');
$pdf->Cell(57,7,utf8_decode('SALDOS'),1,0,'C');
$pdf->Ln();

$pdf->Cell(10,7,utf8_decode('#'),1,0,'C');
$pdf->Cell(18,7,utf8_decode('FECHA'),1,0,'C');
$pdf->Cell(80,7,utf8_decode('CONCEPTO'),1,0,'C');
$pdf->Cell(18,7,utf8_decode('CANT.'),1,0,'C');
$pdf->Cell(18,7,utf8_decode('V. UNI'),1,0,'C');
$pdf->Cell(18,7,utf8_decode('V. TOT'),1,0,'C');
$pdf->Cell(18,7,utf8_decode('CANT.'),1,0,'C');
$pdf->Cell(18,7,utf8_decode('V. UNI'),1,0,'C');
$pdf->Cell(18,7,utf8_decode('V. TOT'),1,0,'C');
$pdf->Cell(18,7,utf8_decode('CANT.'),1,0,'C');
$pdf->Cell(18,7,utf8_decode('V. UNI'),1,0,'C');
$pdf->Cell(21,7,utf8_decode('TOTAL'),1,0,'C');

$pdf->SetFont('Arial','',9);

$item1 = "id_producto";
$valor1 = $idProducto;
$orden1 = "id";

$kardex = ControladorKardex::ctrMostrarKardex($item1, $valor1, $orden1);


for($i = 0; $i < count($kardex); $i++){
	$pdf->Ln();
	$fecha = $kardex[$i]["fecha"];
	$concepto = $kardex[$i]["concepto"];
	$pdf->Cell(10,7,utf8_decode($i+1),1,0,'C');
	$pdf->Cell(18,7,utf8_decode($fecha),1,0,'C');
	$pdf->Cell(80,7,utf8_decode($concepto),1,0,'C');
	$tipo=$kardex[$i]["tipo"];
	if($tipo!=0){
		//Es salida, entradas vacias
		$pdf->Cell(18,7,utf8_decode(''),1,0,'C');
		$pdf->Cell(18,7,utf8_decode(''),1,0,'C');
		$pdf->Cell(18,7,utf8_decode(''),1,0,'C');
		//llenar salidas
		$cantidad=$kardex[$i]["cantidad"];
		$valor_unitario=$kardex[$i]["valor_unitario"];
		$valor_total=$kardex[$i]["valor_total"];

		$saldo_cantidad=$kardex[$i]["saldo_cantidad"];
		$saldo_valor_unitario=$kardex[$i]["saldo_valor_unitario"];
		$saldo_valor_total=$kardex[$i]["saldo_valor_total"];



		$pdf->Cell(18,7,utf8_decode($cantidad),1,0,'C');
		$pdf->Cell(18,7,utf8_decode($valor_unitario),1,0,'C');
		$pdf->Cell(18,7,utf8_decode($valor_total),1,0,'C');
		$pdf->Cell(18,7,utf8_decode($saldo_cantidad),1,0,'C');
		$pdf->Cell(18,7,utf8_decode($saldo_valor_unitario),1,0,'C');
		$pdf->Cell(21,7,utf8_decode($saldo_valor_total),1,0,'C');

	}else{
		//es entrada, salidas vacias

		
		//llenar salidas
		$cantidad=$kardex[$i]["cantidad"];
		$valor_unitario=$kardex[$i]["valor_unitario"];
		$valor_total=$kardex[$i]["valor_total"];

		$saldo_cantidad=$kardex[$i]["saldo_cantidad"];
		$saldo_valor_unitario=$kardex[$i]["saldo_valor_unitario"];
		$saldo_valor_total=$kardex[$i]["saldo_valor_total"];


		$pdf->Cell(18,7,utf8_decode($cantidad),1,0,'C');
		$pdf->Cell(18,7,utf8_decode($valor_unitario),1,0,'C');
		$pdf->Cell(18,7,utf8_decode($valor_total),1,0,'C');
		//Llenar salidas vacias
		$pdf->Cell(18,7,utf8_decode(''),1,0,'C');
		$pdf->Cell(18,7,utf8_decode(''),1,0,'C');
		$pdf->Cell(18,7,utf8_decode(''),1,0,'C');
		$pdf->Cell(18,7,utf8_decode($saldo_cantidad),1,0,'C');
		$pdf->Cell(18,7,utf8_decode($saldo_valor_unitario),1,0,'C');
		$pdf->Cell(21,7,utf8_decode($saldo_valor_total),1,0,'C');


	}
}	


$pdf->Output();
?>