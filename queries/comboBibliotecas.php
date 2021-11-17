<?php
require 'imports/dbConnection.php';

function multiComboBiblioteca($index) {

//    require 'imports/dbConnection.php';
    global $connection;
    $query = "SELECT * FROM biblioteca";
    $rows = mysqli_query($connection, $query);
    ?> 
    <select name="id_biblioteca[]">
    <?php
    while ($row = mysqli_fetch_array($rows)) {
        ?>
            <option value="<?php echo $row['id_biblioteca']; ?>" <?php echo $row['id_biblioteca'] == $_POST['id_biblioteca'][$index] ? "selected" : ""; ?> >
            <?php echo $row['nom_biblioteca']; ?></option>

                <?php
            }
            ?>
    </select>|
        <?php
    }

    function newComboBiblioteca() {
//        require 'imports/dbConnection.php';
    global $connection;
        $query = "SELECT * FROM biblioteca";
        $rows = mysqli_query($connection, $query);
        ?> 
    <select name="id_biblioteca[]">
    <?php
    while ($row = mysqli_fetch_array($rows)) {
        ?>
            <option value="<?php echo $row['id_biblioteca']; ?>">
            <?php echo $row['nom_biblioteca']; ?></option>

                <?php
            }
            ?>
    </select>|
        <?php
    }
    