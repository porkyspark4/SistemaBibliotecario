<?php
    require 'imports/dbConnection.php';
    
    $query = "SELECT * FROM tema";
    $rows = mysqli_query($connection, $query)
?>
<table>
    <tr>
    <th>ID</th>
    <th>Tema</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($rows)){
        ?>
    <tr>
        <td><?php echo $row["id_tema"];?></td>
        <td><?php echo $row["nom_tema"];?></td>
    </tr>
    <?php
    }
    ?>
    
</table>
<?php

