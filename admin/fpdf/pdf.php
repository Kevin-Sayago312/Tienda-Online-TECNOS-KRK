<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(70,10,'Reporte de productos',0,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this->Cell(40,10,'ID',1,0,'C',0);
    $this->Cell(40,10,'NOMBRE',1,0,'C',0);
    $this->Cell(70,10,'DESCRPCION',1,0,'C',0);
    $this->Cell(40,10,'PRECIO',1,0,'C',0);
    $this->Cell(40,10,'REBAJA',1,0,'C',0);
    $this->Cell(40,10,'CANTIDAD',1,0,'C',0);
    $this->Cell(40,10,'CATEGORIA',1,1,'C',0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Pagina').$this->PageNo().'/{nb}',0,0,'C');
}
}

require_once("../config/conexion.php");
$consulta = "SELECT * FROM productos";
$resultado =mysqli_query($conexion, $consulta);

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

while($row=$resultado->fetch_assoc()){
    $pdf->Cell(40,10,$row['id'],1,0,'C',0);
    $pdf->Cell(40,10,$row['nombre'],1,0,'C',0);
    $pdf->Cell(40,10,$row['descripcion'],1,0,'C',0);
    $pdf->Cell(40,10,$row['precio_normal'],1,0,'C',0);
    $pdf->Cell(40,10,$row['precio_rebajado'],1,0,'C',0);
    $pdf->Cell(40,10,$row['cantidad'],1,0,'C',0);
    $pdf->Cell(40,10,$row['id_categoria'],1,1,'C',0);
}

$pdf->Output();
?>