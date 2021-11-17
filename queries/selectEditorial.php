<?php
    require 'imports/dbConnection.php';
    
    $query = "SELECT * FROM editorial";
    $rows = mysqli_query($connection, $query)
?>
<table>
    <tr>
    <th>ID</th>
    <th>Editorial</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($rows)){
        ?>
    <tr>
        <td><?php echo $row["id_editorial"];?></td>
        <td><?php echo $row["nom_editorial"];?></td>
    </tr>
    <?php
    }
    ?>
    
</table>
<?php

