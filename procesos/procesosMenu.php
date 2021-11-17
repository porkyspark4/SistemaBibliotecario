<?php
$proceso = $_GET['proceso'];
switch ($proceso) {
    case 'menu':
?>
<ul>
    <li><a href="index.php?proceso=altaLibro">Alta de libro</a></li>
    <li><a href="index.php?proceso=inventario">Inventario</a></li>
</ul>
    <?php
        break;
    case 'inventario':
        require 'procesos/inventario.php';
        break;
    default:
        break;
}

?>
