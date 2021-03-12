<?php
session_start();

require('fpdf181/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',20);
$pdf->Cell(40,15,'Method');
$pdf->SetFont('Arial','', 10);
$pdf->Ln();
foreach ($_SESSION['method'] as $met) {
  $pdf->MultiCell(0, 5, trim($met));
  $pdf->Ln();
}
$pdf->Output();




?>
