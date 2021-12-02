<?php
require '../imports/dbConnection.php';

$palabra = "'%".$_POST['palabra']."%'";

$query = "SELECT * FROM usuario WHERE CONCAT(nom_usuario,' ',ape_usuario) LIKE $palabra ORDER BY id_usuario ASC LIMIT 0,7";
$rows = mysqli_query($connection, $query);

while ($row = mysqli_fetch_array($rows)){
    $usuario = str_replace($_POST['palabra'], '<b>'.$_POST['palabra'].'</b>', $row['nom_usuario'].' '.$row['ape_usuario']);
    echo '<li onclick="set_item('.$row['id_usuario']
            .',\''.str_replace("'", "\'", $row['nom_usuario']).' '.$row['ape_usuario'].'\')">'
            .$usuario.'</li>';
}

?>



