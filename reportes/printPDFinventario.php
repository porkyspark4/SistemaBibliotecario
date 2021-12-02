<?php

require '../imports/dbConnection.php';
require('c:/xampp/fpdf/fpdf.php');

class PDF_nueva extends FPDF {

    //Cabecera de página
    function Header() {

        $this->Image('logo.jpg', 0, 0, 210, 30);
        $this->SetFont('Arial', 'B', 18);
        $this->Ln();

        $this->Cell(180, 60, 'Reporte de Altas a Inventario', 0, 0, 'C');
        $this->Ln(40);
//        $this->Ln();
    }

    function Footer() {
        $this->SetY(-10);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '  rpt_global  ' . date("d/m/Y") . 0, 0, 'C');
    }

}

$pdf = new PDF_nueva();
$pdf->AddPage();
$pdf->setTitle("Reporte de Altas a Inventario" . ' ' . date("d/m/Y"));

$pdf->SetFont('Arial', 'B', 10);
$pdf->setX(15);
$pdf->Cell(10, 5, "ID", 1, 0, 'C');
$pdf->Cell(30, 5, "Biblioteca", 1, 0, 'C');
$pdf->Cell(70, 5, utf8_decode("Título"), 1, 0, 'C');
$pdf->Cell(30, 5, "Estatus", 1, 0, 'C');
$pdf->Cell(40, 5, utf8_decode("Código de barras"), 1, 0, 'C');

$pdf->SetFont('Arial', '', 10);
$pdf->Ln();

$arr_id_libro_biblioteca = $_POST['id_libro_biblioteca'];
$arr_cod_bar = $_POST['cod_bar'];
$img = "../assets/images/barcode.png";

for ($i = 0; $i < sizeof($arr_id_libro_biblioteca); $i++) {
    $query = "SELECT libro_biblioteca.id_libro_biblioteca, biblioteca.nom_biblioteca, libro.titulo, estatus.des_estatus "
            . "FROM libro_biblioteca NATURAL JOIN biblioteca NATURAL JOIN libro NATURAL JOIN estatus "
            . "WHERE id_libro_biblioteca = '$arr_id_libro_biblioteca[$i]'";

    $rows = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($rows);
    $pdf->setX(15);

    $pdf->Cell(10, 20, utf8_decode($row['id_libro_biblioteca']), 1, 0, 'R');
    $pdf->Cell(30, 20, utf8_decode($row['nom_biblioteca']), 1, 0, 'L');
    $pdf->Cell(70, 20, utf8_decode($row['titulo']), 1, 0, 'L');
    $pdf->Cell(30, 20, utf8_decode($row['des_estatus']), 1, 0, 'L');
    $pdf->Cell(40, 15, $pdf->Image($img, $pdf->GetX() + 5, $pdf->GetY() + 2, 30, 12), "TRL", 2, 'C');
    $pdf->Cell(40, 5, utf8_decode($arr_cod_bar[$i]), "RBL", 1, 'C');
}

$pdf->Ln();
$pdf->Output();
