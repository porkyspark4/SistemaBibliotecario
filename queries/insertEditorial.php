<?php
require 'imports/dbConnection.php';

$nom_editorial = $_POST['nom_editorial'];

$query= "INSERT INTO editorial VALUES(0,'$nom_editorial')";
if(mysqli_query($connection, $query)){
    echo 'Editorial Registrada!';
    
}else{
    echo 'Error al agregar Editorial!!!';
}