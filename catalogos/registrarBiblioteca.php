<form action="index.php?catalogo=bibliotecas" method="POST">
    Biblioteca: <input type="text" name="nom_biblioteca" value="<?php echo isset($_POST['nom_biblioteca']) ? $_POST['nom_biblioteca'] : "";?>">
    <input type="submit" name="submit" value="Añadir">
</form>