<?php

require '../imports/dbConnection.php';

function EliminarEditorial($id_editorial) {
    global $connection;

    $query = "DELETE FROM editorial WHERE id_editorial = $id_editorial";

    if (mysqli_query($connection, $query)) {
        header("Location: ../index.php?catalogo=editoriales&error=0");
    } else {
        header("Location: ../index.php?catalogo=editoriales&error=1");
    }
}

EliminarEditorial($_GET['id_editorial']);
?>
