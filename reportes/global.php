<?php
require 'imports/dbConnection.php';
$query = "SELECT nom_biblioteca, COUNT(DISTINCT id_libro) AS titulos, COUNT(id_libro) AS ejemplares "
        . "FROM biblioteca NATURAL JOIN libro_biblioteca "
        . "GROUP BY nom_biblioteca";
$rows = mysqli_query($connection, $query);
?>

<h1>Reporte Global</h1>
<table class="report_table">
    <tr class="report_row">
        <th class="report_header">Biblioteca</th>
        <th class="report_header">Titulos</th>
        <th class="report_header">Ejemplares</th>

    </tr>
    <?php
    while ($row = mysqli_fetch_array($rows)) {
        ?>
        <tr class="report_row">
            <td class="text"><?php echo $row['nom_biblioteca']; ?></td>
            <td class="numeric"><?php echo $row['titulos']; ?></td>
            <td class="numeric"><?php echo $row['ejemplares']; ?></td>
        </tr>
        <?php
    }

    $query = "SELECT COUNT(DISTINCT id_libro), COUNT(id_libro) "
            . "FROM libro_biblioteca";
    $rows = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($rows);
    ?> 
    <tr  class="report_row">
        <td class="text"><b>Total</b></td>
        <td class="numeric"><?php echo $row[0]; ?></td>
        <td class="numeric"><?php echo $row[1]; ?></td>
    </tr>
    <?php
    ?>
</table>

<form method="POST" action="reportes/printPDFglobal.php" target="_blank">
    <input type="submit" value="Imprimir PDF" name="submit"/>
</form>




