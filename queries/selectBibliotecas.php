<?php
    require 'imports/dbConnection.php';
    
    $query = "SELECT * FROM biblioteca";
    $rows = mysqli_query($connection, $query)
?>
<table>
    <tr>
    <th>ID</th>
    <th>Biblioteca</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($rows)){
        ?>
    <tr>
        <td><?php echo $row["id_biblioteca"];?></td>
        <td><?php echo $row["nom_biblioteca"];?></td>
    </tr>
    <?php
    }
    ?>
    
</table>
<?php

