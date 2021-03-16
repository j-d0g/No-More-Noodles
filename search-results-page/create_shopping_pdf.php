<?php
session_start();

require('fpdf181/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image("logo.png", 90, $pdf->GetY() + 5, 33.78);
$pdf->SetFont('Arial','B',20);
$pdf->SetXY (10,30);
$pdf->Cell(40,15, $_SESSION['name']);
$pdf->Ln();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,15,'Shopping list');
$pdf->SetFont('Arial','', 10);
$pdf->Ln();
foreach ($_SESSION['unowned_ingredients'] as $ingredient) {
    $pdf->MultiCell(0, 3, trim($ingredient));
    $pdf->Ln();
}
$pdf->Output();




?>
