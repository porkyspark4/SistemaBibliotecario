<?php
require 'imports/dbConnection.php';

$nom_empleado = $_POST['nom_empleado'];
$ape_empleado = $_POST['ape_empleado'];

$query= "INSERT INTO empleado VALUES(0,'$ape_empleado','$nom_empleado')";
if(mysqli_query($connection, $query)){
    echo 'Empleado Registrado!';
    
}else{
    echo 'Error al agregar Empleado!!!';
}