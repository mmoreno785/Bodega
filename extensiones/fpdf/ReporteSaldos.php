<?php
require('fpdf.php');
require_once "../../controladores/productos.controlador.php";
require_once "../../modelos/productos.modelo.php";


$pdf = new FPDF();
$pdf->AddPage("landscape");
$pdf->SetFont('Arial','B',16);
$pdf->Image('logo.jpg',20,10,25,0,"JPEG");
$pdf->setXY(95,10);
$pdf->Cell(40,10,utf8_decode('Distribuciones Santamaría - Saldos'));
//$idProducto=$_GET['idProducto'];
//$pdf->Cell(40,10,utf8_decode($idProducto));

$item = null;
$valor = null;
$orden = "id";

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);	

$pdf->Image('logo.jpg',20,10,25,0,"JPEG");
$pdf->Ln();
$pdf->setX(50);
$pdf->Cell(30,10,utf8_decode($codigo));
$pdf->Cell(40,10,utf8_decode($descripcion));
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->setX(136);
$pdf->Cell(75,7,utf8_decode('SALDOS'),1,0,'C');
$pdf->Ln();

$pdf->Cell(10,7,utf8_decode('#'),1,0,'C');
$pdf->Cell(18,7,utf8_decode('CODIGO'),1,0,'C');
$pdf->Cell(98,7,utf8_decode('DESCRIPCION'),1,0,'C');
//$pdf->Cell(28,7,utf8_decode('CATEGORIA'),1,0,'C');
//$pdf->Cell(28,7,utf8_decode('UNI/PAQ'),1,0,'C');
//$pdf->Cell(28,7,utf8_decode('ENVASE'),1,0,'C');
$pdf->Cell(25,7,utf8_decode('PAQ.'),1,0,'C');
$pdf->Cell(25,7,utf8_decode('UNI.'),1,0,'C');
$pdf->Cell(25,7,utf8_decode('TOTAL'),1,0,'C');
$pdf->Cell(25,7,utf8_decode('CAJ.UNI.'),1,0,'C');
$pdf->Cell(25,7,utf8_decode('$ COMPRA.'),1,0,'C');
$pdf->Cell(25,7,utf8_decode('$ VENTA.'),1,0,'C');



$pdf->SetFont('Arial','',9);

$sumaPaquetes=0;
$sumaUnidades=0;
$sumaTotal=0;
$sumaCajasUnitarias=0;
$sumaPrecioCompra=0;
$sumaPrecioVenta=0;


for($i = 0; $i < count($productos); $i++){
	$pdf->Ln();
	$codigo = $productos[$i]["codigo"];
	$descripcion = $productos[$i]["descripcion"];
	$id_categoria = $productos[$i]["id_categoria"];
	$unidades = $productos[$i]["unidades"];
	$id_envase = $productos[$i]["id_envase"];
	$stock = $productos[$i]["stock"];
	$mlEnBotella= $productos[$i]["ml_en_botella"];
	$paquetes=floor($stock/$unidades);
	$sumaPaquetes=$sumaPaquetes+$paquetes;
	$total_unidades=$stock % $unidades;
	$sumaUnidades=$sumaUnidades+$total_unidades;
	$sumaTotal=$sumaTotal+$stock;
	$total_precio_compra=($productos[$i]["precio_compra"]/$unidades)*$stock;
	$total_precio_compra=round($total_precio_compra,2);
	$sumaPrecioCompra=$sumaPrecioCompra+$total_precio_compra;
	$total_precio_venta=($productos[$i]["precio_venta"]/$unidades)*$stock;
	$total_precio_venta=round($total_precio_venta,2);
	$sumaPrecioVenta=$sumaPrecioVenta+$total_precio_venta;
	$stockPaquetes = (int)($stock/$unidades);
  	$stockUnidades = $stock%$unidades;
	
	$cajasUnitarias=round($mlEnBotella*$stock/30/1000,2);
	$sumaCajasUnitarias=$sumaCajasUnitarias+$cajasUnitarias;



	$pdf->Cell(10,7,utf8_decode($i+1),1,0,'C');
	$pdf->Cell(18,7,utf8_decode($codigo),1,0,'C');
	$pdf->Cell(98,7,utf8_decode($descripcion),1,0,'C');
	//$pdf->Cell(28,7,utf8_decode($id_categoria),1,0,'C');
	//$pdf->Cell(28,7,utf8_decode($unidades),1,0,'C');
	//$pdf->Cell(28,7,utf8_decode($id_envase),1,0,'C');
	$pdf->Cell(25,7,utf8_decode($stockPaquetes),1,0,'C');
	$pdf->Cell(25,7,utf8_decode($stockUnidades),1,0,'C');
	$pdf->Cell(25,7,utf8_decode($stock),1,0,'C');
	$pdf->Cell(25,7,utf8_decode($cajasUnitarias),1,0,'C');
	$pdf->Cell(25,7,utf8_decode($total_precio_compra),1,0,'C');
	$pdf->Cell(25,7,utf8_decode($total_precio_venta),1,0,'C');
}	

$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(126,7,utf8_decode('TOTALES'),1,0,'C');
$pdf->Cell(25,7,utf8_decode($sumaPaquetes),1,0,'C');
$pdf->Cell(25,7,utf8_decode($sumaUnidades),1,0,'C');
$pdf->Cell(25,7,utf8_decode($sumaTotal),1,0,'C');
$pdf->Cell(25,7,utf8_decode($sumaCajasUnitarias),1,0,'C');
$pdf->Cell(25,7,utf8_decode($sumaPrecioCompra),1,0,'C');
$pdf->Cell(25,7,utf8_decode($sumaPrecioVenta),1,0,'C');


$pdf->Output();
?>