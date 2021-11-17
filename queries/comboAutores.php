<?php
require 'imports/dbConnection.php';

$query = "SELECT * FROM autor";
$rows = mysqli_query($connection, $query)
?>
<select name="id_autor">
    <?php
    while ($row = mysqli_fetch_array($rows)) {
        ?>
        <option value="<?php echo $row['id_autor']; ?>"><?php echo $row['nom_autor'];?></option>
        
        <?php
    }
    ?>
</select>


