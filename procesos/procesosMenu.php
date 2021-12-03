<?php
$proceso = $_GET['proceso'];

if (!isset($_SESSION['id_empleado'])) {
    header('Location: procesos/iniciarSesion.php');
}

switch ($proceso) {
    case 'menu':
        ?>
        <ul>
            <li><a href="index.php?proceso=altaLibro">Alta de libro</a></li>
            <li><a href="index.php?proceso=inventario">Inventario</a></li>
            <li><a href="index.php?proceso=prestamo">Prestamo</a></li>
        </ul>
        <?php
        break;
    case 'inventario':
        require 'procesos/inventario.php';
        break;
    case 'altaLibro':
        require 'procesos/altaLibro.php';
        break;
    case 'prestamo':
        require 'procesos/prestamo.php';
        break;
    case 'prestamo':
        require 'procesos/devolucion.php';
        break;
    default:
        break;
}
?>
