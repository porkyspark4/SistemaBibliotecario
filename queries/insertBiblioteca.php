<?php
require 'imports/dbConnection.php';

$nom_biblioteca = $_POST['nom_biblioteca'];

$query= "INSERT INTO biblioteca VALUES(0,'$nom_biblioteca')";
if(mysqli_query($connection, $query)){
    echo 'Biblioteca Registrada!';
    
}else{
    echo 'Error al agregar Biblioteca!!!';
}