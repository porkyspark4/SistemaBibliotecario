<?php
session_start();

require 'imports/dbConnection.php';

if (isset($_POST['logIn'])) {
    header('Location: procesos/iniciarSesion.php');
}

if (isset($_POST['signIn'])) {
    header('Location: procesos/crearCuenta.php');
}

if (isset($_POST['logOut'])) {
    session_unset();
    session_destroy();
}
?>
<div class="session_bar">
    <?php
    if (!isset($_SESSION['id_empleado'])) {
        ?>
        <form method="POST">
            <input type="submit" name="signIn" value="Crea Cuenta">
            <input type="submit" name="logIn" value="Inicia Sesión">
        </form>
        <?php
    } else {
        $datos_empleado = getEmpleadoById($_SESSION['id_empleado']);
        $datos_biblioteca = getBibliotecaById($_SESSION['id_biblioteca']);
        ?>
        <p><b>Usuario:</b> <?php echo $datos_empleado['nom_empleado'] . " " . $datos_empleado['ape_empleado']; ?></p>
        <p><b>Biblioteca:</b> <?php echo $datos_biblioteca['nom_biblioteca']; ?></p>
        <form method="POST">
            <input type="submit" name="logOut" value="Cerrar Sesión">
        </form>
        <?php
    }
    ?>
</div>


<?php

function getEmpleadoById($id) {
    global $connection;

    $query = "SELECT * FROM empleado WHERE id_empleado = $id";
    $rows = mysqli_query($connection, $query);
    return mysqli_fetch_array($rows);
}

function getBibliotecaById($id) {
    global $connection;

    $query = "SELECT * FROM biblioteca WHERE id_biblioteca = $id";
    $rows = mysqli_query($connection, $query);
    return mysqli_fetch_array($rows);
}
?>
