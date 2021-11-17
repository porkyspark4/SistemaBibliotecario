<?php
require 'imports/dbConnection.php';

$query = "SELECT * FROM tema";
$rows = mysqli_query($connection, $query)
?>
<select name="id_tema">
    <?php
    while ($row = mysqli_fetch_array($rows)) {
        ?>
        <option value="<?php echo $row['id_tema']; ?>"><?php echo $row['nom_tema'];?></option>
        <?php
    }
    ?>
</select>


