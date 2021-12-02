<?php
session_start();

require 'imports/dbConnection.php';

$_SESSION['id_empleado'] = 1;
$datos_empleado = null;
?>
<div class="session_bar">
    <?php
    if (!isset($_SESSION['id_empleado'])) {
        ?>
        <input type="button" name="signIn" value="Crea Cuenta">
        <input type="button" name="logIn" value="Inicia Sesión">
        <?php
    } else {
        $datos_empleado = getEmpleadoById($_SESSION['id_empleado']);
        ?>
        <p><b>Usuario:</b> <?php echo $datos_empleado['nom_empleado'] . " " . $datos_empleado['ape_empleado']; ?></p>
        <input type="button" name="logOut" value="Cerrar Sesión">
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
?>
