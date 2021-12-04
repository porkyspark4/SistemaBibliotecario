<?php
$reporte = $_GET['reporte'];
switch ($reporte) {
    case 'menu':
        ?>
        <ul>
            <li><a href="index.php?reporte=global">Reporte Global</a></li>
            <li><a href="index.php?reporte=biblioteca">Reporte por Biblioteca</a></li>
            <li><a href="index.php?reporte=null&prestamo=menu">Reportes Prestamos</a></li>
        </ul>
        <?php
        break;
    case 'global':
        require 'reportes/global.php';
        break;
    case 'biblioteca':
        require 'reportes/biblioteca.php';
        break;
    default:
        break;
}
if (isset($_GET['prestamo'])) {
    require 'reportes/prestamosMenu.php';
}
?>
