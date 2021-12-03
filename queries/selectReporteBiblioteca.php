<?php
require 'imports/dbConnection.php';

$id_biblioteca = $_POST['id_biblioteca'][0];

$query = "SELECT titulo, COUNT(id_libro) AS ejemplares,COUNT( IF (id_estatus = '1' , 1 , NULL)) AS disponibles "
        . "FROM libro NATURAL JOIN libro_biblioteca "
        . "WHERE id_biblioteca = $id_biblioteca "
        . "GROUP BY titulo";
$rows = mysqli_query($connection, $query);
?>
<table  class="report_table">
    <tr class="report_row">
        <th class="report_header">Titulo</th>
        <th class="report_header">Total de Ejemplares</th>
        <th class="report_header">Total Disponibles</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($rows)) {
        ?>
        <tr class="report_row">
            <td class="text"><?php echo $row["titulo"]; ?></td>
            <td class="numeric"><?php echo $row["ejemplares"]; ?></td>
            <td class="numeric"><?php echo $row["disponibles"]; ?></td>
        </tr>
        <?php
    }
    $query = "SELECT 'Total', COUNT(id_libro) AS ejemplares,COUNT( IF (id_estatus = '1' , 1 , NULL)) AS disponibles "
            . "FROM libro_biblioteca "
            . "WHERE id_biblioteca = $id_biblioteca ";
    $rows = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($rows);
    ?>
    <tr class="report_row">
        <td class="text"><b>Total</b></td>
        <td class="numeric"><?php echo $row["ejemplares"]; ?></td>
        <td class="numeric"><?php echo $row["disponibles"]; ?></td>
    </tr>
</table>
<?php
?>
<form method="POST" action="reportes/printPDFbiblioteca.php" target="_blank">
    <input type="hidden" name="id_biblioteca" value="<?php echo $id_biblioteca; ?>">
    <input type="submit" value="Imprimir PDF" name="submit"/>
</form>
