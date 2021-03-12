<?php
session_start();

require('fpdf181/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',20);
$pdf->Cell(40,15,'Shopping list');
$pdf->SetFont('Arial','', 10);
$pdf->Ln();
foreach ($_SESSION['unowned_ingredients'] as $ingredient) {
    $pdf->Cell(5, 5, trim($ingredient));
    $pdf->Ln();
}
$pdf->Output();




?>
