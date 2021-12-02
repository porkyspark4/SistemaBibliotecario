<?php
require 'imports/dbConnection.php';

//SUBMIT
if (isset($_POST["submit"])){
    require 'queries/insertLibro.php';
}

//CREACION Y LLENADO ARRAY AUTORES
$arr_autores = isset($_POST['arr_autores']) ? $_POST['arr_autores'] : array();
if(isset($_POST["add_autor"])){
    array_push($arr_autores, $_POST["id_autor"]);
}

//CREACION Y LLENADO ARRAY TEMAS
$arr_temas = isset($_POST['arr_temas']) ? $_POST['arr_temas'] : array();
if(isset($_POST["add_tema"])){
    array_push($arr_temas, $_POST["id_tema"]);
}

?>
<h2>Alta libro</h2>

<form action="index.php?proceso=altaLibro" method="POST">
    <table>
        <tr>
            <td>Titulo:</td>
            <td><input type="text" name="titulo"  value="<?php echo isset($_POST['titulo']) ? $_POST['titulo'] : '';?>"></td>
        </tr>
        <tr>
            <td>ISBN:</td>
            <td><input type="text" name="isbn" placeholder="0000000000000" maxlength="13" value="<?php echo isset($_POST['isbn']) ? $_POST['isbn'] : '';?>"></td>
        </tr>
        <tr>
            <td>Editorial:</td>
            <td><?php require 'queries/comboEditoriales.php'; ?></td>
        </tr>
        <tr>
            <td>Autor:</td>
            <td><?php require 'queries/comboAutores.php'; ?></td>
            <td><input type="submit" name="add_autor" value="+"></td>
        </tr>
        <tr>
            <td colspan="3">
                <textarea rows="5" cols="40" readonly><?php listAutores(); ?></textarea>
                <?php listHiddenAutores(); ?>
            </td>
        </tr>
        <tr>
            <td>Tema:</td>
            <td><?php require 'queries/comboTemas.php'; ?></td>
            <td><input type="submit" name="add_tema" value="+"></td>
        </tr>
        <tr>
            <td colspan="3">
                <textarea rows="5" cols="40" readonly><?php listTemas(); ?></textarea>
                <?php listHiddenTemas(); ?>
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Agregar"></td>
        </tr>
    </table>
<?php 
echo isset($msg) ? $msg : '';
?>
</form>

<?php

function listAutores() {
    global $arr_autores;
    
    foreach ($arr_autores as &$autor_id) {
        echo getAutorById($autor_id)."\n";
    }
}

function listHiddenAutores(){
    global $arr_autores;
    
    foreach ($arr_autores as &$autor_id) {
        ?>
        <input type="hidden" name="arr_autores[]" value="<?php echo $autor_id; ?>">
        <?php
    }
}

function listTemas() {
    global $arr_temas;
    
    foreach ($arr_temas as &$tema_id) {
        echo getTemaById($tema_id)."\n";
    }
}

function listHiddenTemas(){
       global $arr_temas;
    
    foreach ($arr_temas as &$tema_id) {
        ?>
        <input type="hidden" name="arr_temas[]" value="<?php echo $tema_id; ?>">
        <?php
    }
}

function getAutorById($id) {
    global $connection;
    
    $query = "SELECT nom_autor FROM autor WHERE id_autor = '$id'";
    $rows = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($rows);
    return $row["nom_autor"];
}

function getTemaById($id) {
    global $connection;
    
    $query = "SELECT nom_tema FROM tema WHERE id_tema = '$id'";
    $rows = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($rows);
    return $row["nom_tema"];
}
?>