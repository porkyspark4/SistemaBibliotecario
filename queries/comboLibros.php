<?php
require 'imports/dbConnection.php';

$query = "SELECT * FROM libro";
$rows = mysqli_query($connection, $query);
?>
<select name="id_libro">
    <?php
    while ($row = mysqli_fetch_array($rows)) {
        $autores = getAutoresLibro($row['id_libro']);
        ?>
        <option value="<?php echo $row['id_libro']; ?>">
            <?php
            echo $row['titulo'] . ' | ';
            if ($autores != null) {
                echoAutores($autores);
            }
            ?>
        </option>

        <?php
    }
    ?>
</select>
<?php

function getAutoresLibro($idLibro) {
    global $connection;
    $query = "SELECT autor.nom_autor  FROM libro_autor NATURAL JOIN autor WHERE id_libro = '$idLibro'";

    return mysqli_query($connection, $query);
}

function echoAutores($autores) {
    while ($row = mysqli_fetch_array($autores)) {
        echo $row['nom_autor'] . ',';
    }
}
?>

