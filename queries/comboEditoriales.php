<?php
require 'imports/dbConnection.php';

$query = "SELECT * FROM editorial";
$rows = mysqli_query($connection, $query)
?>
<select name="id_editorial">
    <?php
    while ($row = mysqli_fetch_array($rows)) {
        ?>
        <option value="<?php echo $row['id_editorial']; ?>" <?php 
        if (isset($_POST['id_editorial'])){
            echo $row['id_editorial'] == $_POST['id_editorial'] ? 'selected' : '';
        }
        ?>><?php echo $row['nom_editorial'];?></option>
        <?php
    }
    ?>
</select>


