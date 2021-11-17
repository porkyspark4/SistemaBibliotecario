<?php
require 'imports/dbConnection.php';

$nom_usuario = $_POST['nom_usuario'];
$ape_usuario = $_POST['ape_usuario'];

$query= "INSERT INTO usuario VALUES(0,'$ape_usuario','$nom_usuario')";
if(mysqli_query($connection, $query)){
    echo 'Usuario Registrado!';
    
}else{
    echo 'Error al agregar Usuario!!!';
}