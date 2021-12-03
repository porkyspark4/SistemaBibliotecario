<?php
    require '../imports/dbConnection.php';
    
    $id_editorial = $_POST["id_editorial"];
    $nom_editorial = $_POST["nom_editorial"];
    


function modificaEditorial() {
    global $id_editorial, $nom_editorial, $connection;

    $query = "UPDATE editorial SET nom_editorial= '$nom_editorial' WHERE id_editorial = '$id_editorial'";
    if (mysqli_query($connection, $query)) {
        header("Location: ../index.php?catalogo=editoriales");
    } else {
        echo 'No se pudo realizar el query';
    }
}
if (isset($id_editorial)) {
    modificaEditorial();
} else {
    header("Location: ../index.php?catalogo=editoriales");
}

