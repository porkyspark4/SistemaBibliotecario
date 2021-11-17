<?php
require 'imports/dbConnection.php';
$msg = 'LIBRO INSERTADO CON EXITO';

$titulo = $_POST['titulo'];
$id_editorial = $_POST['id_editorial'];
$isbn = $_POST['isbn'];
$arr_autores = $_SESSION['arr_autores'];
$arr_temas = $_SESSION['arr_temas'];

//INSERT LIBRO
$query = "INSERT INTO libro VALUES(0,'$isbn','$titulo','$id_editorial')";
$msg = mysqli_query($connection, $query) ?  $msg : 'ERROR AL INSERTAR LIBRO';
$id_libro = mysqli_insert_id($connection);

//INSERT LIBRO-AUTOR
foreach ($arr_autores as &$id_autor) {
    $query = "INSERT INTO libro_autor VALUES(0, '$id_libro','$id_autor')";
    $msg = mysqli_query($connection, $query) ?  $msg : 'ERROR AL INSERTAR AUTOR';
}
//INSERT LIBRO-TEMA
foreach ($arr_temas as &$id_tema) {
    $query = "INSERT INTO libro_tema VALUES(0, '$id_libro','$id_tema')";
    $msg = mysqli_query($connection, $query) ? $msg : 'ERROR AL INSERTAR TEMA' ;
}

session_unset();
unset($_POST['titulo']);
unset($_POST['isbn']);
unset($_POST['id_editorial']);
?>
