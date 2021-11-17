<?php
require 'imports/dbConnection.php';

$nom_tema = $_POST['nom_tema'];

$query= "INSERT INTO tema VALUES(0,'$nom_tema')";
if(mysqli_query($connection, $query)){
    echo 'Tema Registrado!';
    
}else{
    echo 'Error al agregar Tema!!!';
}