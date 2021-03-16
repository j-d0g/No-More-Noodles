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

$pdf->SetXY (10,30);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,15,'Shopping list');
$pdf->SetFont('Arial','', 10);
$pdf->Ln();

foreach ($_SESSION['unowned_ingredients'] as $ingredient) {
    $pdf->Cell(5, 3, chr(127), 0, 0, 'R');
    $pdf->MultiCell(0, 3, trim($ingredient));
    $pdf->Ln();
}

if (count($_SESSION['owned_ingredients']) > 0) {
  $pdf->AddPage();
  $pdf->Image("logo.png", 185, 10, 16 );
  $pdf->SetFont('Arial','B',30);
  $pdf->SetXY (10,12);
  $pdf->Cell(40,15, $_SESSION['name']);
  $pdf->Line(10, 30, 200, 30);
  $pdf->Ln();

  $pdf->SetXY (10,30);
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(40,15,'Shopping list - owned');
  $pdf->SetFont('Arial','', 10);
  $pdf->Ln();

  foreach ($_SESSION['owned_ingredients'] as $ingredient) {
      $pdf->Cell(5, 3, chr(127), 0, 0, 'R');
      $pdf->MultiCell(0, 3, trim($ingredient));
      $pdf->Ln();
  }
}

$pdf->Output();
$pdf->Close();



?>
