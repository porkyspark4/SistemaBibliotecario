<?php
require 'imports/dbConnection.php';
$query = "SELECT nom_biblioteca, COUNT(DISTINCT id_libro) AS titulos, COUNT(id_libro) AS ejemplares "
        . "FROM biblioteca NATURAL JOIN libro_biblioteca "
        . "GROUP BY nom_biblioteca";
$rows = mysqli_query($connection, $query);
?>

<h1>Reporte Global</h1>
<table>
    <tr>
        <th>Biblioteca</th>
        <th>Titulos</th>
        <th>Ejemplares</th>

    </tr>
    <?php
    while ($row = mysqli_fetch_array($rows)) {
        ?>
        <tr>
            <td><?php echo $row['nom_biblioteca']; ?></td>
            <td><?php echo $row['titulos']; ?></td>
            <td><?php echo $row['ejemplares']; ?></td>
        </tr>
        <?php
    }

    $query = "SELECT COUNT(DISTINCT id_libro), COUNT(id_libro) "
            . "FROM libro_biblioteca";
    $rows = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($rows);
    ?> 
    <tr>
        <td><b>Total</b></td>
        <td><?php echo $row[0]; ?></td>
        <td><?php echo $row[1]; ?></td>
    </tr>
    <?php
    ?>
</table>

<form method="POST" action="reportes/printPDFglobal.php"><input type="submit" value="Imprimir PDF" name="submit"/></form>




