<form action="index.php?catalogo=empleados" method="POST">
    Apellido: <input type="text" name="ape_empleado" value="<?php echo isset($_POST['ape_empleado']) ? $_POST['ape_empleado'] : "";?>"><br>
    Nombre: <input type="text" name="nom_empleado" value="<?php echo isset($_POST['nom_empleado']) ? $_POST['nom_empleado'] : "";?>">
    <input type="submit" name="submit" value="Añadir">
</form>
