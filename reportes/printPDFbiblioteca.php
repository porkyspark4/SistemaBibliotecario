<?php
require '../imports/dbConnection.php';
//require('c:/xampp/fpdf/fpdf.php');
//
//
//class PDF_nueva extends FPDF {
//    //Cabecera de página
//    function Header() {
//
//        $this->Image('logo.jpg', 0, 0, 210, 30);
//
//        $this->SetFont('Arial', 'B', 18);
//        $this->Ln();
//
//        $this->Cell(180, 60, 'Reporte por biblioteca', 0, 0, 'C');
//        $this->Ln(40);
////        $this->Ln();
//    }
//
//    function Footer() {
//        $this->SetY(-10);
//        $this->SetFont('Arial', 'I', 8);
//        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '  rpt_global  ' . date("d/m/Y") . 0, 0, 'C');
//    }
//
//}
//
//$pdf = new PDF_nueva();
//$pdf->AddPage();
//$pdf->setTitle("Reporteglobal".' '. date("d/m/Y"));
//
//$pdf->SetFont('Arial', 'B', 12);
//$pdf->setX(50);
//$pdf->Cell(40, 7, "Biblioteca", 1, 0, 'C');
//$pdf->Cell(30, 7, "Titulos", 1, 0, 'C');
//$pdf->Cell(30, 7, "Ejemplares", 1, 0, 'C');
//
//$pdf->SetFont('Arial', '', 12);
//$pdf->Ln();
//$query ="SELECT nom_biblioteca, COUNT(DISTINCT id_libro) AS titulos, COUNT(id_libro) AS ejemplares "
//        . "FROM biblioteca NATURAL JOIN libro_biblioteca "
//        . "GROUP BY nom_biblioteca";
//$rows = mysqli_query($connection, $query);
//
//
//while ($row = mysqli_fetch_array($rows)) {
//    $pdf->setX(50);
//
//    $pdf->Cell(40, 7, utf8_decode($row['nom_biblioteca']), 1);
//    $pdf->Cell(30, 7, utf8_decode($row['titulos']), 1, 0, 'R');
//    $pdf->Cell(30, 7, utf8_decode($row['ejemplares']), 1, 1, 'R');
//}
//$query = "SELECT COUNT(DISTINCT id_libro), COUNT(id_libro) "
//        . "FROM libro_biblioteca";
//$rows = mysqli_query($connection, $query);
//$pdf->SetFont('Arial', 'B', 12);
//while ($row = mysqli_fetch_array($rows)) {
//    $pdf->setX(50);
//
//    $pdf->Cell(40, 7, 'Total', 1, 0, 'R');
//    $pdf->Cell(30, 7, utf8_decode($row[0]), 1, 0, 'R');
//    $pdf->Cell(30, 7, utf8_decode($row[1]), 1, 0, 'R');
//}
//
//$pdf->Ln();
//$pdf->Output();
//
//  
