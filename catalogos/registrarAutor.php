<form action="index.php?catalogo=autores" method="POST">
    Autor: <input type="text" name="nom_autor" value="<?php echo isset($_POST['nom_autor']) ? $_POST['nom_autor'] : "";?>">
    <input type="submit" name="submit" value="Añadir">
</form>