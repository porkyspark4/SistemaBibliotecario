<?php
$reporte = $_GET['reporte'];
switch ($reporte) {
    case 'menu':
        ?>
        <ul>
            <li><a href="index.php?reporte=global">Reporte Global</a></li>
            <li><a href="index.php?reporte=biblioteca">Reporte por Biblioteca</a></li>
        </ul>
        <?php
        break;
    case 'global':
        require 'reportes/global.php';
        break;
    case 'biblioteca':
        require 'reportes/biblioteca.php';
        break;
    case 'prestamos':
        require 'reportes/biblioteca.php';
        break;
    default:
        break;
}
?>
