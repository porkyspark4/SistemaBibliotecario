<form action="index.php?catalogo=editoriales" method="POST">
    Editorial: <input type="text" name="nom_editorial" value="<?php echo isset($_POST['nom_editorial']) ? $_POST['nom_editorial'] : "";?>">
    <input type="submit" name="submit" value="Añadir">
</form>