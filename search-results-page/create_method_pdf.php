<?php
session_start();

require('fpdf181/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image("logo.png", 185, 10, 16 );
$pdf->SetFont('Arial','B',30);
$pdf->SetXY (10,12);
$pdf->Cell(40,15, $_SESSION['name']);
$pdf->Line(10, 30, 200, 30);
$pdf->Ln();

$pdf->SetXY (10,40);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,15,'Method');
$pdf->SetFont('Arial','', 10);
$pdf->Ln();

$counter = 1;
foreach ($_SESSION['method'] as $met) {
  $pdf->Cell(5, 5, $counter, 0, 0, 'R');
  $counter++;
  $pdf->MultiCell(0, 5, trim($met));
  $pdf->Ln(10);
}
$pdf->Output();
$pdf->Close();




?>
