<?php 

require('../fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    $this->SetFont('Times','B',20);
    $this->Image('../imagenes/i1.png',20,5,20); //imagen(archivo, png/jpg || x,y,tamaño)
    $this->Image('../imagenes/i2.jpg',170,5,20); //imagen(archivo, png/jpg || x,y,tamaño)
    $this->setXY(20,10);
    $this->SetFont('Helvetica','B',14);
    $this->Cell(0,5,utf8_decode('UNIVERSIDAD ESTATAL DEL SUR DE MANABÍ'),0,1,'C',0);
    $this->setXY(20,15);
    $this->SetFont('Helvetica','',8);
    $this->Cell(0,4,utf8_decode('Creada el 7 de febrero del 2001, según registro oficial Nro.261'),0,1,'C',0);
    $this->setXY(20,19);
    $this->SetFont('Helvetica','B',8);
    $this->Cell(0,4,utf8_decode('FACULTAD DE CIENCIAS NATURALES Y DE LA AGRICULTURA'),0,1,'C',0);
    $this->setXY(20,23);
    $this->SetFont('Helvetica','B',8);
    $this->Cell(0,4,utf8_decode('CARRERA AGROPECUARIA'),0,1,'C',0);
    //$this->setXY(60,15);
    //$this->Cell(100,8,'Nombre del Reporte',0,1,'C',0);
    //$this->Image('img/shinheky.png',150,10,35); //imagen(archivo, png/jpg || x,y,tamaño)
    $this->Ln(40);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','B',8);
    // Número de página
    $this->Cell(170,10,utf8_decode('Sistema Informatizado para la Gestión de la Titulación'),0,0,'C',0);
    $this->Cell(25,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada
 $pdf = new PDF();//hacemos una instancia de la clase
 $pdf->AliasNbPages();
 $pdf->AddPage();//añade l apagina / en blanco
// $pdf->SetMargins(10,10,10);
// $pdf->SetAutoPageBreak(true,20);//salto de pagina automatico
// $pdf->SetX(15);
// $pdf->SetFont('Helvetica','B',15);
// $pdf->Cell(10,8,'N','B',0,'C',0);
// $pdf->Cell(60,8,'Producto','B',0,'C',0);
// $pdf->Cell(30,8,'Costo','B',0,'C',0);
// $pdf->Cell(35,8,'Cantidad','B',0,'C',0);
// $pdf->Cell(50,8,'Total','B',1,'C',0);

// $pdf->SetFillColor(233, 229, 235);//color de fondo rgb
// $pdf->SetDrawColor(61, 61, 61);//color de linea  rgb

// $pdf->SetFont('Arial','',12);
// for($i=1;$i<=50;$i++){
    
//     $pdf->Ln(0.6);
//     $pdf->setX(15);
// $pdf->Cell(10,8,$i,'B',0,'C',1);
// $pdf->Cell(60,8,'Leche','B',0,'C',1);
// $pdf->Cell(30,8,'$'.'20','B',0,'C',1);
// $pdf->Cell(35,8,'2','B',0,'C',1);
// $pdf->Cell(50,8,'40','B',1,'C',1);

// }
// cell(ancho, largo, contenido,borde?, salto de linea?)

$pdf->Output();
?>