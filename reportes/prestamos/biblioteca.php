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

