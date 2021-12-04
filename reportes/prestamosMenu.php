<?php
$prestamo = $_GET['prestamo'];
switch ($prestamo) {
    case 'menu':
        ?>
        <ul>
            <li><a href="index.php?reporte=null&prestamo=total">Total de ejemplares prestados por biblioteca</a></li>
            <li><a href="index.php?reporte=null&prestamo=biblioteca">Historial de prestamos por Biblioteca</a></li>
            <li><a href="index.php?reporte=null&prestamo=usuario">Historial de prestamos por Usuario</a></li>
            <li><a href="index.php?reporte=null&prestamo=top">Titulos mas prestados</a></li>
            <li><a href="index.php?reporte=null&prestamo=topBiblioteca">titulos mas prestados por biblioteca</a></li>
        </ul>
        <?php
        break;
    case 'total':
        require 'reportes/prestamos/total.php';
        break;
    case 'biblioteca':
        require 'reportes/prestamos/biblioteca.php';
        break;
    case 'usuario':
        require 'reportes/prestamos/usuario.php';
        break;
    case 'top':
        require 'reportes/prestamos/top.php';
        break;
    case 'topBiblioteca':
        require 'reportes/prestamos/topBiblioteca.php';
        break;
    default:
        break;
}
?>
