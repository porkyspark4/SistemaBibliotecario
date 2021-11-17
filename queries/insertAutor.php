<?php
require 'imports/dbConnection.php';

$nom_autor = $_POST['nom_autor'];

$query= "INSERT INTO autor VALUES(0,'$nom_autor')";
if(mysqli_query($connection, $query)){
    echo 'Autor Registrado!';
    
}else{
    echo 'Error al agregar Autor!!!';
}