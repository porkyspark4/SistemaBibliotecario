<?php
require 'imports/dbConnection.php';

date_default_timezone_set('America/Mexico_City');

$fecha_devolucion = date("Y-m-d");
$id_empleado = $_SESSION['id_empleado'];
$arr_id_libro_biblioteca = $_POST['arr_id_libro_biblioteca'];
?>
<table class="report_table">
    <tr class="report_row">
        <th class="report_header">Clave</th>
        <th class="report_header">Libro</th>
        <th class="report_header">Autores</th>
        <th class="report_header">Fecha de devolucion</th>
    </tr>
    <?php
    foreach ($arr_id_libro_biblioteca as &$id_libro_biblioteca) {
        //Obtener det_prestamo por id_libro biblioteca (Se debe considerar el prestamo más reciente)
        $query = "SELECT det_prestamo.id_det_prestamo "
                . "FROM det_prestamo NATURAL JOIN enc_prestamo "
                . "WHERE id_libro_biblioteca = $id_libro_biblioteca ORDER BY fecha_prestamo DESC, id_det_prestamo DESC LIMIT 1";
        $rows = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($rows);

        $id_det_prestamo = $row['id_det_prestamo'];

        //Inserta devolucion
        $query = "INSERT INTO devolucion VALUES(0, '$fecha_devolucion', $id_det_prestamo, $id_empleado)";
        echo $query;

        if (mysqli_query($connection, $query)) {
            $libro = getLibroByIdLibroBiblioteca($id_libro_biblioteca);
            $autores = getAutoresLibro($libro['id_libro']);
            ?>
            <tr class="report_row">
                <td class="numeric"><?php echo $id_libro_biblioteca; ?></td>
                <td class="text"><?php echo $libro['titulo']; ?></td>
                <td class="text"><?php
                    while ($row = mysqli_fetch_array($autores)) {
                        echo $row['nom_autor'] . ',';
                    }
                    ?></td>
                <td class="center"><?php echo $fecha_devolucion; ?></td>
            </tr>
            <?php
        }
    }
    ?>
</table>
<form method="POST" action="reportes/printPDFdevolucion.php" target="_blank">
    <input type="hidden" name="id_det_prestamo" value="<?php echo $id_det_prestamo; ?>">
    <input type="submit" value="Imprimir PDF" name="submit"/>
</form>



