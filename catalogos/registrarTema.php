<form action="index.php?catalogo=temas" method="POST">
    Tema: <input type="text" name="nom_tema" value="<?php echo isset($_POST['nom_tema']) ? $_POST['nom_tema'] : "";?>">
    <input type="submit" name="submit" value="Añadir">
</form>