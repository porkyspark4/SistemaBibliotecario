<?php

require '../imports/dbConnection.php';
require('c:/xampp/fpdf/fpdf.php');
$id_enc_prestamo = $_POST['id_enc_prestamo'];

class PDF_nueva extends FPDF {

//Cabecera de página
    function Header() {
        $this->SetFont('Arial', 'B', 24);
        $this->Cell(100, 60, 'Comprobante Prestamo', 0, 0, 'C');

        $this->SetFont('Arial', 'B', 18);
        $this->Ln();
        $this->Ln(40);
//        $this->Ln();
    }

    function Footer() {
        $this->SetY(-10);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '  comprobante_prestamo  ' . date("d/m/Y") . 0, 0, 'C');
    }

}

$query = "SELECT * FROM enc_prestamo NATURAL JOIN usuario NATURAL JOIN empleado WHERE id_enc_prestamo = $id_enc_prestamo";
$rows = mysqli_query($connection, $query);
$row = mysqli_fetch_array($rows);

$empleado = $row['nom_empleado'] . " " . $row['ape_empleado'];
$usuario = $row['nom_usuario'] . " " . $row['ape_usuario'];
$fecha_prestamo = $row['fecha_prestamo'];
$fecha_lim_devolucion = $row['fecha_lim_devolucion'];

$pdf = new PDF_nueva();
$pdf->AddPage();
$pdf->setTitle("ComprobantePrestamo" . ' ' . date("d/m/Y"));


$pdf->SetFont('Arial', 'B', 12);
$pdf->setX(40);
$pdf->Cell(40, 7, "Fecha de prestamo", 0, 0, 'C');
$pdf->Cell(60, 7, "Fecha limite de devolucion", 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 12);
$pdf->setX(40);
$pdf->Cell(40, 7, utf8_decode($fecha_prestamo), 0, 0, 'C');
$pdf->Cell(60, 7, utf8_decode($fecha_lim_devolucion), 0, 1, 'C');

$pdf->Ln();

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, "No. de prestamo", 0, 0, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(70, 7, utf8_decode($id_enc_prestamo), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, "Empleado", 0, 0, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(70, 7, utf8_decode($empleado), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, "Usuario", 0, 0, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(70, 7, utf8_decode($usuario), 0, 1, 'L');

$pdf->Ln();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 7, "Clave", 1, 0, 'C');
$pdf->Cell(70, 7, "Titulo", 1, 0, 'C');
$pdf->Cell(50, 7, "Bilioteca", 1, 1, 'C');

$query = "SELECT det_prestamo.id_libro_biblioteca, libro.titulo, biblioteca.nom_biblioteca "
        . "FROM det_prestamo NATURAL JOIN libro_biblioteca NATURAL JOIN libro "
        . "NATURAL JOIN biblioteca "
        . "WHERE det_prestamo.id_enc_prestamo=$id_enc_prestamo";
$rows = mysqli_query($connection, $query);
$pdf->SetFont('Arial', '', 12);

while ($row = mysqli_fetch_array($rows)) {
    $id_libro_biblioteca = $row['id_libro_biblioteca'];
    $titulo = $row['titulo'];
    $nom_biblioteca = $row['nom_biblioteca'];

    $pdf->Cell(30, 7, utf8_decode($id_libro_biblioteca), 1, 0, 'R');
    $pdf->Cell(70, 7, utf8_decode($titulo), 1, 0, 'C');
    $pdf->Cell(50, 7, utf8_decode($nom_biblioteca), 1, 1, 'C');
}
$pdf->Ln();
$pdf->Output();