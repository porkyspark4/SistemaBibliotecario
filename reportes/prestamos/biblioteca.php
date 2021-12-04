<h2>Historial de prestamos por Biblioteca</h2>
<?php
require 'imports/dbConnection.php';
require 'queries/comboBibliotecas.php';


date_default_timezone_set('America/Mexico_City');
?>
<form method="POST">
    <?php comboBiblioteca(null); ?>
    <input type = "date" name = "fecha_inicio" value = "<?php echo date('Y-m-d'); ?>">
    <input type = "date" name = "fecha_termino" value = "<?php echo date('Y-m-d'); ?>">
    <input type="submit" name="submit" value="Consultar">

</form>

<?php
if (isset($_POST['submit'])) {
    $id_biblioteca = $_POST['id_biblioteca'][0];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_termino = $_POST['fecha_termino'];
//    echo $id_biblioteca;
    ?>
    <table>
        <tr>
            <th>Usuario</th>
            <th>Fecha de prestamo</th>
            <th>Fecha de devolucion</th>
            <th>Clave de ejemplar</th>
        </tr>
        <?php
        $query = "SELECT CONCAT(usuario.nom_usuario,' ',usuario.ape_usuario) AS user, enc_prestamo.fecha_prestamo, devolucion.feha_devolucion, det_prestamo.id_libro_biblioteca "
                . "FROM det_prestamo NATURAL JOIN enc_prestamo NATURAL JOIN usuario NATURAL JOIN devolucion NATURAL JOIN libro_biblioteca "
                . "WHERE libro_biblioteca.id_libro_biblioteca= $id_biblioteca "
                . "AND enc_prestamo.fecha_prestamo BETWEEN '$fecha_inicio' AND '$fecha_termino'";
//        echo $query;
        $rows = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($rows)) {
            ?>
            <tr>
                <td><?php echo $row['user']; ?></td>
                <td><?php echo $row['fecha_prestamo']; ?></td>
                <td><?php echo $row['fecha_prestamo']; ?></td>
                <td><?php echo $row['id_libro_biblioteca']; ?></td>
            </tr>

            <?php
        }
        ?>
    </table>
    <?php
}
?>


