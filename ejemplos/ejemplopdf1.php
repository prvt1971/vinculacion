<?php
require('../fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->header()
$pdf->Cell(40,10,utf8_decode('¡Hola, Mundo!'));
$pdf->Output();
?>