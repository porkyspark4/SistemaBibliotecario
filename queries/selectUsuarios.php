<?php
    require 'imports/dbConnection.php';
    
    $query = "SELECT * FROM usuario";
    $rows = mysqli_query($connection, $query)
?>
<table>
    <tr>
    <th>ID</th>
    <th>Apellido</th>
    <th>Nombre</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($rows)){
        ?>
    <tr>
        <td><?php echo $row["id_usuario"];?></td>
        <td><?php echo $row["ape_usuario"];?></td>
        <td><?php echo $row["nom_usuario"];?></td>
    </tr>
    <?php
    }
    ?>
    
</table>
<?php

