<?php
$error_msg = "";

$arr_id_libro_biblioteca = isset($_POST['arr_id_libro_biblioteca']) ? $_POST['arr_id_libro_biblioteca'] : array();
if (isset($_POST['addLibro'])) {

    //Validacion [el ejemplar pertenece a biblioteca y esta prestado]
    if (estaEnBiblioteca($_POST['id_libro_biblioteca'], $_SESSION['id_biblioteca'])) {
        if (estaPrestado($_POST['id_libro_biblioteca'])) {
            array_push($arr_id_libro_biblioteca, $_POST['id_libro_biblioteca']);
        } else {
            $error_msg = "El ejemplar " . $_POST['id_libro_biblioteca'] . " ya ha sido devuelto";
        }
    } else {
        $biblioteca = getBibliotecaById($_SESSION['id_biblioteca'])['nom_biblioteca'];

        $error_msg = "El ejemplar " . $_POST['id_libro_biblioteca'] . " no pertenece a la biblioteca de " . $biblioteca;
    }
}

if (isset($_POST['devolucion'])) {
    require 'queries/insertDevolucion.php';
} else {
    ?>
    <h2>Devolución de libros</h2>
    <form method="POST">
        <table class="input_table">
            <tr>
                <td class="input_cell">Clave de libro</td>
                <td class="input_cell"><input type="text" name="id_libro_biblioteca"></td>
                <td class="input_cell"><input type="submit" name="addLibro" value="+"></td>
            </tr>
        </table>
        <div class="lista_libros">
            <?php listaLibrosBiblioteca(); ?>
        </div>
        <p class="error"><?php echo $error_msg; ?></p>
        <input type="submit" name="devolucion" value="Realizar Devolucion">
    </form>

    <?php
}

function estaEnBiblioteca($id_libro_biblioteca, $id_biblioteca){
    global $connection;
    
    $query = "SELECT id_biblioteca FROM libro_biblioteca WHERE id_libro_biblioteca = $id_libro_biblioteca";
    $rows = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($rows);
    
    return $row['id_biblioteca'] == $id_biblioteca;
}

function estaPrestado($id_libro_biblioteca){
    global $connection;
    
    $query = "SELECT des_estatus FROM libro_biblioteca NATURAL JOIN estatus WHERE id_libro_biblioteca = $id_libro_biblioteca";
    $rows = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($rows);
    
    return $row['des_estatus'] == 'PRESTADO';
}

function listaLibrosBiblioteca() {
    global $arr_id_libro_biblioteca;

    foreach ($arr_id_libro_biblioteca as &$id) {
        $libro = getLibroByIdLibroBiblioteca($id);
        $autores = getAutoresLibro($libro['id_libro']);
        ?>
        <input type="hidden" name="arr_id_libro_biblioteca[]" value="<?php echo $id; ?>">
        <input type="text" value="<?php
        echo $id . " " . $libro['titulo'] . " | ";

        while ($row = mysqli_fetch_array($autores)) {
            echo $row['nom_autor'] . ',';
        }
        ?>" disabled>
               <?php
    }
}

function getLibroByIdLibroBiblioteca($id) {
    global $connection;

    $query = "SELECT * FROM libro NATURAL JOIN libro_biblioteca WHERE libro_biblioteca.id_libro_biblioteca = $id";
    $rows = mysqli_query($connection, $query);

    return mysqli_fetch_array($rows);
}

function getAutoresLibro($idLibro) {
    global $connection;
    $query = "SELECT autor.nom_autor  FROM libro_autor NATURAL JOIN autor WHERE id_libro = '$idLibro'";

    return mysqli_query($connection, $query);
}
?>