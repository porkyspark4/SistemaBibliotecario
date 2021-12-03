<?php
require 'imports/dbConnection.php';

date_default_timezone_set('America/Mexico_City');

$id_empleado = $_SESSION['id_empleado'];
$id_usuario = $_POST['id_usuario'];
$fecha_prestamo = date("Y-m-d");
$fecha_lim_devolucion = date("Y-m-d", strtotime($fecha_prestamo . '+ 3 days'));

$query = "INSERT INTO enc_prestamo VALUES(0,$id_empleado, $id_usuario, $fecha_prestamo, $fecha_lim_devolucion)";
if (mysqli_query($connection, $query)) {
    $id_enc_prestamo = mysqli_insert_id($connection);
    $empleado = getEmpleadoById($id_empleado);
    $usuario = getUsuarioById($id_usuario);
    ?>
    <table class="report_table">
        <tr class="report_row">
            <th class="report_header">Fecha prestamo</th>
            <th class="report_header">Fecha límite de devolución</th>
        </tr>
        <tr class="report_row">
            <td class="center"><?php echo $fecha_prestamo; ?></td>
            <td class="center"><?php echo $fecha_lim_devolucion; ?></td>
        </tr>
    </table>
    <br>
    <table class="report_table">
        <tr class="report_row">
            <th class="report_header">No. de Prestamo</th>
            <td class="text"><?php echo $id_enc_prestamo; ?></td>
        </tr>
        <tr class="report_row">
            <th class="report_header">Empleado</th>
            <td class="text"><?php echo $empleado['nom_empleado'] . " " . $empleado['ape_empleado']; ?></td>
        </tr>
        <tr class="report_row">
            <th class="report_header">Usuario</th>
            <td class="text"><?php echo $usuario['nom_usuario'] . " " . $usuario['ape_usuario']; ?></td>
        </tr>
    </table>
    <br>
    <table class="report_table">
        <tr class="report_row">
            <th class="report_header">Clave</th>
            <th class="report_header">Título</th>
            <th class="report_header">Biblioteca</th>
        </tr>
        <?php
    }

    $arr_id_libro_biblioteca = $_POST['arr_id_libro_biblioteca'];

    foreach ($arr_id_libro_biblioteca as &$id_libro_biblioteca) {
        //Corroborar que el libro esta disponible
        $query = "SELECT * FROM libro_biblioteca NATURAL JOIN estatus NATURAL JOIN biblioteca WHERE id_libro_biblioteca = $id_libro_biblioteca";
        $rows = mysqli_query($connection, $query);
        $ejemplar = mysqli_fetch_array($rows);

        $libro = getLibroByIdLibroBiblioteca($id_libro_biblioteca);
        $autores = getAutoresLibro($libro['id_libro']);

        if (mysqli_query($connection, $query)) {
            ?>
            <tr class="report_row">
                <td class="numeric"><?php echo $id_libro_biblioteca; ?></td>
                <td class="text"><?php echo $libro['titulo']; ?></td>
                <td class="text"><?php echo $ejemplar['nom_biblioteca']; ?></td>
            </tr>
            <?php
        }
    }
    ?>
</table>
<form method="POST" action="reportes/printPDFprestamo.php" target="_blank">
    <input type="hidden" name="enc_prestamo" value="<?php echo $id_enc_prestamo; ?>">
    <input type="submit" value="Imprimir PDF" name="submit"/>
</form>
<?php


