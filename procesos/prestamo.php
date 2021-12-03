<?php
$error_msg = "";

$arr_id_libro_biblioteca = isset($_POST['arr_id_libro_biblioteca']) ? $_POST['arr_id_libro_biblioteca'] : array();
if (isset($_POST['addLibro'])) {
    
    //Validacion [el ejemplar pertenece a biblioteca y esta disponible]
    if(estaEnBiblioteca($_POST['id_libro_biblioteca'], $_SESSION['id_biblioteca'])){
        if(estaDisponible($_POST['id_libro_biblioteca'])) {
            array_push($arr_id_libro_biblioteca, $_POST['id_libro_biblioteca']);
        } else {
            $error_msg = "El ejemplar ".$_POST['id_libro_biblioteca']." no ha sido devuelto";
        }
    } else {
        $biblioteca = getBibliotecaById($_SESSION['id_biblioteca'])['nom_biblioteca'];
        
        $error_msg = "El ejemplar ".$_POST['id_libro_biblioteca']." no pertenece a la biblioteca de ".$biblioteca;
    }
}

if (isset($_POST['prestamo'])) {
    require 'queries/insertPrestamo.php';
} else {
    ?>
    <h2>Préstamo</h2>
    <form method="POST">
        <table class="input_table">
            <tr>
                <td class="input_cell">Usuario</td>
                <td class="input_cell input_auto_container">
                    <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo isset($_POST['id_usuario']) ? $_POST['id_usuario'] : "" ?>">
                    <input autocomplete="off" type="text" name="nom_usuario" id="auto_usuario" onkeyup="autocompletar()" value="<?php
                    if (isset($_POST['id_usuario'])) {
                        $usuario = getUsuarioById($_POST['id_usuario']);
                        echo $usuario['nom_usuario'] . " " . $usuario['ape_usuario'];
                    }
                    ?>">
                    <ul id="lista_auto_usuario"></ul>
                </td>
            </tr>
            <tr>
                <td class="input_cell">Clave de libro:</td>
                <td class="input_cell"><input type="numeric" name="id_libro_biblioteca"></td>
                <td class="input_cell"><input type="submit" name="addLibro" value="+"></td>
            </tr>
        </table>
        <div class="lista_libros">
            <?php listaLibrosBiblioteca(); ?>
        </div>
        <p class="error"><?php echo $error_msg; ?></p>
        <input type="submit" name="prestamo" value="Realizar Prestamo">
    </form>

    <script>
        //autocompletar();

        function autocompletar() {
            var min = 0;
            var palabra = $('#auto_usuario').val();

            if (palabra.length > min) {
                $.ajax({
                    url: 'queries/autocompleteUsuarios.php',
                    type: 'POST',
                    data: {palabra: palabra},
                    success: function (data) {
                        $('#lista_auto_usuario').show();
                        $('#lista_auto_usuario').html(data);
                    }
                })
            } else {
                $('#lista_auto_usuario').hide();
            }
        }

        function set_item(id, nombre) {
            $('#auto_usuario').val(nombre);
            $('#id_usuario').val(id);
            $('#lista_auto_usuario').hide();
        }
    </script>

    <?php
}

function estaEnBiblioteca($id_libro_biblioteca, $id_biblioteca){
    global $connection;
    
    $query = "SELECT id_biblioteca FROM libro_biblioteca WHERE id_libro_biblioteca = $id_libro_biblioteca";
    $rows = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($rows);
    
    return $row['id_biblioteca'] == $id_biblioteca;
}

function estaDisponible($id_libro_biblioteca){
    global $connection;
    
    $query = "SELECT des_estatus FROM libro_biblioteca NATURAL JOIN estatus WHERE id_libro_biblioteca = $id_libro_biblioteca";
    $rows = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($rows);
    
    return $row['des_estatus'] == 'DISPONIBLE';
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

function getUsuarioById($id) {
    global $connection;

    $query = "SELECT * FROM usuario WHERE id_usuario = $id";
    $rows = mysqli_query($connection, $query);
    return mysqli_fetch_array($rows);
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