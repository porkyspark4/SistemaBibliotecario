<?php
    require 'imports/dbConnection.php';
    
    $query = "SELECT * FROM autor";
    $rows = mysqli_query($connection, $query)
?>
<table>
    <tr>
    <th>ID</th>
    <th>Autor</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($rows)){
        ?>
    <tr>
        <td><?php echo $row["id_autor"];?></td>
        <td><?php echo $row["nom_autor"];?></td>
    </tr>
    <?php
    }
    ?>
    
</table>
<?php

