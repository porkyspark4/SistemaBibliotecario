<?php
require 'imports/dbConnection.php';

$id_libro = $_POST['id_libro'];
$id_biblioteca = $_POST['id_biblioteca'];
$cant =$_POST['cant'];

$query = "INSERT INTO libro_biblioteca VALUES(0,$id_libro,$id_biblioteca,1)";
?>
<table>
    <tr>
        <th>ID</th>
        <th>Biblioteca</th>
        <th>Libro</th>
        <th>Estatus</th>
        <th>Codigo de barras</th>
    </tr>
    <?php
    for($i=0; $i<$cant; $i++){
    if(mysqli_query($connection, $query)){
        echoLibroBiblioteca(mysqli_insert_id($connection));
    }
}
    ?>

</table>
<?php


function echoLibroBiblioteca($id_libro_biblioteca){
    global $connection;
    $query = "SELECT libro_biblioteca.id_libro_biblioteca, biblioteca.nom_biblioteca, libro.titulo, estatus.des_estatus "
            . "FROM libro_biblioteca NATURAL JOIN biblioteca NATURAL JOIN libro NATURAL JOIN estatus "
            . "WHERE id_libro_biblioteca = '$id_libro_biblioteca'";
    
    $rows = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($rows);
    ?>
<tr>
    <td><?php echo $row['id_libro_biblioteca'];?></td>
    <td><?php echo $row['nom_biblioteca'];?></td>
    <td><?php echo $row['titulo'];?></td>
    <td><?php echo $row['des_estatus'];?></td>
    <td><?php generaCodBar();?></td>
</tr>
<?php

}

function generaCodBar(){
    for($i=0;$i<12;$i++){
        echo rand(0,9);
    }
}
