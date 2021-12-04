<h2>Total de ejemplares prestados por biblioteca</h2>
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

    $query = "SELECT COUNT(id_det_prestamo) AS total "
            . "FROM det_prestamo NATURAL JOIN libro_biblioteca NATURAL JOIN enc_prestamo "
            . "WHERE libro_biblioteca.id_biblioteca = $id_biblioteca "
            . "AND enc_prestamo.fecha_prestamo BETWEEN '$fecha_inicio' AND '$fecha_termino'";

    $rows = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($rows);
    ?>
    <p><b>Total de ejemplares: </b><?php echo $row['total']; ?></p>

    <?php
}
?>