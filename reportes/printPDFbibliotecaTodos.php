<?php

require '../imports/dbConnection.php';
require('c:/xampp/fpdf/fpdf.php');

class PDF_nueva extends FPDF {

    //Cabecera de página
    function Header() {

        $this->Image('logo.jpg', 0, 0, 210, 30);

        $this->SetFont('Arial', 'B', 18);
        $this->Ln();

        $this->Cell(180, 60, 'Reporte general por biblioteca', 0, 0, 'C');
        $this->Ln(40);
//        $this->Ln();
    }

    function Footer() {
        $this->SetY(-10);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '  rpt_general_por_biblioteca  ' . date("d/m/Y") . 0, 0, 'C');
    }

}

$pdf = new PDF_nueva();
$pdf->AddPage();
$pdf->setTitle("ReporteGeneralPorBiblioteca" . ' ' . date("d/m/Y"));
$pdf->SetFont('Arial', 'B', 12);

$query = "SELECT nom_biblioteca FROM biblioteca";
$bibliotecas = mysqli_query($connection, $query);
$total_bibliotecas = mysqli_num_rows($bibliotecas);

for ($id_biblioteca = 1; $id_biblioteca < $total_bibliotecas; $id_biblioteca++) {
    $biblioteca = mysqli_fetch_array($bibliotecas)['nom_biblioteca'];
    $query = "SELECT titulo, COUNT(id_libro) AS ejemplares,COUNT( IF (id_estatus = '1' , 1 , NULL)) AS disponibles "
            . "FROM libro NATURAL JOIN libro_biblioteca "
            . "WHERE id_biblioteca = $id_biblioteca "
            . "GROUP BY titulo";
//    $pdf->Text($pdf->GetX(), $pdf->GetY(), $total_bibliotecas);
    $rows = mysqli_query($connection, $query);

    $pdf->Text($pdf->GetX(), $pdf->GetY(), utf8_decode($biblioteca));
    $pdf->setX(50);
    $pdf->Cell(70, 7, "Titulo", 1, 0, 'C');
    $pdf->Cell(30, 7, "Ejemplares", 1, 0, 'C');
    $pdf->Cell(30, 7, "Disponibles", 1, 1, 'C');

    while ($row = mysqli_fetch_array($rows)) {
        $pdf->setX(50);

        $pdf->Cell(70, 7, utf8_decode($row['titulo']), 1);
        $pdf->Cell(30, 7, utf8_decode($row['ejemplares']), 1, 0, 'R');
        $pdf->Cell(30, 7, utf8_decode($row['disponibles']), 1, 1, 'R');
    }
    $pdf->SetFont('Arial', '', 12);
    $query = "SELECT 'Total', COUNT(id_libro) AS ejemplares,COUNT( IF (id_estatus = '1' , 1 , NULL)) AS disponibles "
            . "FROM libro_biblioteca "
            . "WHERE id_biblioteca = $id_biblioteca ";
    $rows = mysqli_query($connection, $query);
    $pdf->SetFont('Arial', 'B', 12);
    while ($row = mysqli_fetch_array($rows)) {
        $pdf->setX(50);

        $pdf->Cell(70, 7, 'Total', 1, 0, 'R');
        $pdf->Cell(30, 7, utf8_decode($row["ejemplares"]), 1, 0, 'R');
        $pdf->Cell(30, 7, utf8_decode($row["disponibles"]), 1, 0, 'R');
    }
    $pdf->Ln();
    $pdf->Ln();
}
$pdf->Output();













