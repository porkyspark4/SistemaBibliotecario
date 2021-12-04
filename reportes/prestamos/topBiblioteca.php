<h2>Titulos mas prestados por biblioteca</h2>
<?php
require 'imports/dbConnection.php';
require 'queries/comboBibliotecas.php';


date_default_timezone_set('America/Mexico_City');

?>
<form method="POST">
    <?php comboBiblioteca(0); ?>
    <input type = "date" name = "fecha_inicio" value = "<?php echo date('Y-m-d'); ?>">
    <input type = "date" name = "fecha_termino" value = "<?php echo date('Y-m-d'); ?>">
    <input type="submit" name="submit" value="Consultar">

</form>

<?php
if (isset($_POST['submit'])) {
    $id_biblioteca = $_POST['id_biblioteca'][0];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_termino = $_POST['fecha_termino'];
    ?>
    <table>
        <tr>
            <th>Titulo</th>
            <th>Total de prestamos</th>
        </tr>
        <?php
        $query = "SELECT titulo, COUNT(id_libro_biblioteca) AS total "
                . "FROM det_prestamo NATURAL JOIN libro_biblioteca NATURAL JOIN libro NATURAL JOIN enc_prestamo "
                . "WHERE id_biblioteca =$id_biblioteca AND enc_prestamo.fecha_prestamo BETWEEN '$fecha_inicio' AND '$fecha_termino' GROUP BY id_libro ORDER BY total DESC";
//        echo $query;
        $rows = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($rows)) {
            ?>
            <tr>

                <td><?php echo $row['titulo']; ?></td>
                <td><?php echo $row['total']; ?></td>
            </tr>

            <?php
        }
        ?>
    </table>
    <?php
}    