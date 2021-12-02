<?php
require 'imports/dbConnection.php';

$id_biblioteca=$_POST['id_biblioteca'][0];

$query = "SELECT titulo, COUNT(id_libro) AS ejemplares,COUNT( IF (id_estatus = '1' , 1 , NULL)) AS disponibles "
        . "FROM libro NATURAL JOIN libro_biblioteca "
        . "WHERE id_biblioteca = $id_biblioteca "
        . "GROUP BY titulo";
$rows = mysqli_query($connection, $query);
?>
<table>
    <tr>
        <th>Titulo</th>
        <th>Total de Ejemplares</th>
        <th>Total Disponibles</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($rows)) {
        ?>
        <tr>
            <td><?php echo $row["titulo"]; ?></td>
            <td><?php echo $row["ejemplares"]; ?></td>
            <td><?php echo $row["disponibles"]; ?></td>
        </tr>
        <?php
    }
    $query = "SELECT 'Total', COUNT(id_libro) AS ejemplares,COUNT( IF (id_estatus = '1' , 1 , NULL)) AS disponibles "
            . "FROM libro_biblioteca "
            . "WHERE id_biblioteca = $id_biblioteca ";
    $rows = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($rows);
    ?>
    <tr>
        <td><b>Total</b></td>
        <td><?php echo $row["ejemplares"]; ?></td>
        <td><?php echo $row["disponibles"]; ?></td>
    </tr>
</table>
<?php

