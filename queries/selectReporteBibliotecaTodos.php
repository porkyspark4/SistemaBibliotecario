<?php
require 'imports/dbConnection.php';

$query = "SELECT nom_biblioteca FROM biblioteca";
$bibliotecas = mysqli_query($connection, $query);
$total_bibliotecas = mysqli_num_rows($bibliotecas);
for ($id_biblioteca = 1; $id_biblioteca <= $total_bibliotecas; $id_biblioteca++) {
    $biblioteca = mysqli_fetch_array($bibliotecas)['nom_biblioteca'];
    $query = "SELECT titulo, COUNT(id_libro) AS ejemplares,COUNT( IF (id_estatus = '1' , 1 , NULL)) AS disponibles "
            . "FROM libro NATURAL JOIN libro_biblioteca "
            . "WHERE id_biblioteca = $id_biblioteca "
            . "GROUP BY titulo";



    $rows = mysqli_query($connection, $query);
    ?>
    <h3><?php echo $biblioteca; ?></h3>
    <table class="report_table">
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
}
?>
<form method="POST" action="reportes/printPDFbibliotecaTodos.php" target="_blank">
    <input type="submit" value="Imprimir PDF" name="submit"/>
</form>
