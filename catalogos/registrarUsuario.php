<form action="index.php?catalogo=usuarios" method="POST">
    Apellido: <input type="text" name="ape_usuario" value="<?php echo isset($_POST['ape_usuario']) ? $_POST['ape_usuario'] : "";?>"><br>
    Nombre: <input type="text" name="nom_usuario" value="<?php echo isset($_POST['nom_usuario']) ? $_POST['nom_usuario'] : "";?>">
    <input type="submit" name="submit" value="Añadir">
</form>