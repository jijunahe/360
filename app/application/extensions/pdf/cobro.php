<?php
require('fpdf.php');
$año=date("Y");
if(isset($_GET["pasado"])){
	
$año=(int)$año-1;
}
$mes=array("","enero","febrero","marzo","abril","mayo","junio","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
$debe=array("fra"=>array("Financial Risk Assessments  S.A.S","Nit.  900.704.796-0 ","$ 2,500,000 dos millones quinientos mil pesos"),"talent"=>array("TALENTRACKING","Nit. 900.517.094-7","$ 500,000 quinientos mil pesos"));
 

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'CUENTA DE COBRO',0,0,"C");
$pdf->Ln(2);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,40,$debe[$_GET["unidad"]][0],0,0,"C");
$pdf->Ln(8);
$pdf->Cell(0,40,$debe[$_GET["unidad"]][1],0,0,"C");
$pdf->Ln(40);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,40,'DEBE A:',0,0,"C");
$pdf->SetFont('Arial','',12);
$pdf->Ln(8);
 $pdf->Cell(0,40,'Oscar Díaz Ovalle, identificado con cédula de ciudadanía No. 80.144.347 de Bogotá.',0,0,'C');
$pdf->Ln(30);
 
 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,40,'LA SUMA DE',0,0,"C");
$pdf->SetFont('Arial','',12);
$pdf->Ln(8);
$pdf->Cell(0,40,$debe[$_GET["unidad"]][2],0,0,'C');
$pdf->Ln(30);
 
 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,40,'POR CONCEPTO DE:',0,0,"C");
$pdf->SetFont('Arial','',12);
$pdf->Ln(8);
$pdf->Cell(0,40,'Desarrollo de Software correspondiente al mes de '.$mes[$_GET["mes"]].' de '.$año,0,0,'C');
 $pdf->Ln(8);
$pdf->Cell(0,40,'Favor consignar al número de cuenta de ahorros Helm Banck número 012215164.',0,0,'C');
 $pdf->SetFont('Arial','B',12);
 $pdf->Ln(23);
 $pdf->Cell(0,40,'             Cordialmente,',0,0,'L');
 $pdf->Ln(4);

$pdf->Image('firma.png',20,200,50,0); 
 $pdf->SetFont('Arial','',12);
 $pdf->Ln(29);
$pdf->Cell(0,40,'             Oscar Díaz Ovalle',0,0,'L');
$pdf->Ln(8);
$pdf->Cell(0,40,'             C.C. 80.144.347 de Bogotá',0,0,'L');
$pdf->Ln(8);
$pdf->Cell(0,40,'             Celular: 3013414404',0,0,'L');
$pdf->Ln(8);
$pdf->Cell(0,40,'             Dirección: Carrera 78F 58M 06 SUR',0,0,'L');
 



  
$pdf->Output();
?>