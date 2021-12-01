<?php
require 'imports/dbConnection.php';

$id_libro = $_POST['id_libro'];
$id_biblioteca = $_POST['id_biblioteca'];
$cant = $_POST['cant'];
?>
<table class="report_table">
    <tr class="report_row">
        <th class="report_header">ID</th>
        <th class="report_header">Biblioteca</th>
        <th class="report_header">Libro</th>
        <th class="report_header">Estatus</th>
        <th class="report_header">Codigo de barras</th>
    </tr>
    <?php
    for ($i = 0; $i < sizeof($id_libro); $i++) {
        $query = "INSERT INTO libro_biblioteca VALUES(0,$id_libro[$i],$id_biblioteca[$i],1)";
        for ($j = 0; $j < $cant[$i]; $j++) {
            if (mysqli_query($connection, $query)) {
                echoLibroBiblioteca(mysqli_insert_id($connection));
            }
        }
    }
    ?>
</table>
<?php

function echoLibroBiblioteca($id_libro_biblioteca) {
    global $connection;
    $query = "SELECT libro_biblioteca.id_libro_biblioteca, biblioteca.nom_biblioteca, libro.titulo, estatus.des_estatus "
            . "FROM libro_biblioteca NATURAL JOIN biblioteca NATURAL JOIN libro NATURAL JOIN estatus "
            . "WHERE id_libro_biblioteca = '$id_libro_biblioteca'";

    $rows = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($rows);
    ?>
    <tr class="report_row">
        <td class="report_data numeric"><?php echo $row['id_libro_biblioteca']; ?></td>
        <td class="report_data text"><?php echo $row['nom_biblioteca']; ?></td>
        <td class="report_data text"><?php echo $row['titulo']; ?></td>
        <td class="report_data text"><?php echo $row['des_estatus']; ?></td>
        <td class="report_data">
            <img src="assets/images/barcode.png" width="150px"/>
            <p class="code_bar"><?php generaCodBar(); ?></p>
        </td>
    </tr>
    <?php
}

function generaCodBar() {
    for ($i = 0; $i < 12; $i++) {
        echo rand(0, 9);
    }
}
