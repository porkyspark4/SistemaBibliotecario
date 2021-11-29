<?php
require 'imports/dbConnection.php';

function comboLibros($index) {
    global $connection;

    $query = "SELECT * FROM libro";
    $rows = mysqli_query($connection, $query);
    ?>
    <select name="id_libro[]">
        <?php
        while ($row = mysqli_fetch_array($rows)) {
            $autores = getAutoresLibro($row['id_libro']);
            ?>
            <option value="<?php echo $row['id_libro']; ?>"
            <?php
            if (isset($_POST['id_libro']) && isset($index)) {
                echo $row['id_libro'] == $_POST['id_libro'][$index] ? "selected" : "";
            }
            ?> >
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
}

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

