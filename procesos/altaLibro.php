<?php
session_start();
//session_destroy();

require 'imports/dbConnection.php';

//SUBMIT
if (isset($_POST["submit"])){
    require 'queries/insertLibro.php';
}

//CREACION DE ARRAYS
if (!isset($_SESSION["arr_autores"])) {
    $_SESSION["arr_autores"] = array();
}
if (!isset($_SESSION["arr_temas"])) {
    $_SESSION["arr_temas"] = array();
}

//LLENADO DE ARRAYS
if (isset($_POST["add_autor"])) {
    array_push($_SESSION["arr_autores"], $_POST["id_autor"]);
}
if (isset($_POST["add_tema"])) {
    array_push($_SESSION["arr_temas"], $_POST["id_tema"]);
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
            <td colspan="3"><textarea rows="5" cols="40" readonly><?php listAutores(); ?></textarea></td>
        </tr>
        <tr>
            <td>Tema:</td>
            <td><?php require 'queries/comboTemas.php'; ?></td>
            <td><input type="submit" name="add_tema" value="+"></td>
        </tr>
        <tr>
            <td colspan="3"><textarea rows="5" cols="40" readonly><?php listTemas(); ?></textarea></td>
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
    $arr_autores = $_SESSION['arr_autores'];
    foreach ($arr_autores as &$autor_id) {
        echo getAutorById($autor_id)."\n";
    }
}

function listTemas() {
    $arr_temas = $_SESSION['arr_temas'];
    foreach ($arr_temas as &$tema_id) {
        echo getTemaById($tema_id)."\n";
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