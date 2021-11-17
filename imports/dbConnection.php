<?php

$server = "localhost";
$user = "root";
$pswd = "";
$db = "biblioteca_sgbd";

$connection = mysqli_connect($server, $user, $pswd, $db);

if (!$connection) {
    echo 'Error en la conexion';
}
?>