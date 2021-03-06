<?php

require '../imports/dbConnection.php';
require('c:/xampp/fpdf/fpdf.php');
date_default_timezone_set('America/Mexico_City');

$fecha_devolucion = date("Y-m-d");
$id_det_prestamo = $_POST['id_det_prestamo'];

class PDF_nueva extends FPDF {

//Cabecera de página
    function Header() {
        $this->SetFont('Arial', 'B', 24);
        $this->Cell(180, 20, 'Boleta de Devolucion', 0, 0, 'C');

        $this->SetFont('Arial', 'B', 18);
        $this->Ln();
        $this->Ln(5);
//        $this->Ln();
    }

    function Footer() {
        $this->SetY(-10);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, '  boleta_devolucion  ' . date("d/m/Y") . 0, 0, 'C');
    }

}
$query = "SELECT id_enc_prestamo FROM det_prestamo WHERE id_det_prestamo = $id_det_prestamo";
$rows = mysqli_query($connection, $query);
$row = mysqli_fetch_array($rows);
$id_enc_prestamo = $row['id_enc_prestamo'];

$query = "SELECT * FROM devolucion NATURAL JOIN enc_prestamo NATURAL JOIN usuario NATURAL JOIN empleado "
        . "WHERE id_det_prestamo = $id_det_prestamo AND id_enc_prestamo= $id_enc_prestamo";
$rows = mysqli_query($connection, $query);
$row = mysqli_fetch_array($rows);

$empleado = $row['nom_empleado'] . " " . $row['ape_empleado'];
$usuario = $row['nom_usuario'] . " " . $row['ape_usuario'];
$fecha_prestamo = $row['fecha_prestamo'];
$id_devolucion = $row['id_devolucion'];

$pdf = new PDF_nueva();
$pdf->AddPage();
$pdf->setTitle("BoletaDevolucion" . ' ' . date("d/m/Y"));


$pdf->SetFont('Arial', 'B', 12);
$pdf->setX(50);
$pdf->Cell(40, 7, "Fecha de prestamo", 0, 0, 'C');
$pdf->Cell(60, 7, "Fecha de devolucion", 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 12);
$pdf->setX(50);
$pdf->Cell(40, 7, utf8_decode($fecha_prestamo), 0, 0, 'C');
$pdf->Cell(60, 7, utf8_decode($fecha_devolucion), 0, 1, 'C');

$pdf->Ln();
$pdf->setX(30);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, "No. de devolucion :", 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(70, 7, utf8_decode($id_devolucion), 0, 1, 'L');

$pdf->setX(30);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, "Empleado :", 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(70, 7, utf8_decode($empleado), 0, 1, 'L');

$pdf->setX(30);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 7, "Usuario :", 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(70, 7, utf8_decode($usuario), 0, 1, 'L');

$pdf->Ln();
$pdf->setX(30);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 7, "Clave", 1, 0, 'C');
$pdf->Cell(70, 7, "Libro Devuelto", 1, 0, 'C');
$pdf->Cell(50, 7, "Autores", 1, 1, 'C');

$query = "SELECT det_prestamo.id_libro_biblioteca, libro.titulo "
        . "FROM det_prestamo NATURAL JOIN libro_biblioteca NATURAL JOIN libro "
        . "NATURAL JOIN devolucion "
        . "WHERE det_prestamo.id_det_prestamo=$id_det_prestamo";
$rows = mysqli_query($connection, $query);
$pdf->SetFont('Arial', '', 12);

while ($row = mysqli_fetch_array($rows)) {
    $id_libro_biblioteca = $row['id_libro_biblioteca'];
    $titulo = $row['titulo'];

    $libro = getLibroByIdLibroBiblioteca($id_libro_biblioteca);
    $autores = getAutoresLibro($libro['id_libro']);

    $pdf->setX(30);
    $pdf->Cell(30, 7, utf8_decode($id_libro_biblioteca), 1, 0, 'R');
    $pdf->Cell(70, 7, utf8_decode($titulo), 1, 0, 'C');
    while ($row = mysqli_fetch_array($autores)) {
        $pdf->Cell(50, 7, utf8_decode($row['nom_autor'] . ','), 1, 1, 'C');
    }
}
$pdf->Ln();
$pdf->Output();

function getLibroByIdLibroBiblioteca($id) {
    global $connection;

    $query = "SELECT * FROM libro NATURAL JOIN libro_biblioteca WHERE libro_biblioteca.id_libro_biblioteca = $id";
    $rows = mysqli_query($connection, $query);

    return mysqli_fetch_array($rows);
}

function getAutoresLibro($idLibro) {
    global $connection;
    $query = "SELECT autor.nom_autor  FROM libro_autor NATURAL JOIN autor WHERE id_libro = '$idLibro'";

    return mysqli_query($connection, $query);
}
