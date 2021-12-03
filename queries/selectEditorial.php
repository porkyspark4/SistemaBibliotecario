<?php
require 'imports/dbConnection.php';

$query = "SELECT * FROM editorial";
$rows = mysqli_query($connection, $query)
?>
<table>
    <tr>
        <th>ID</th>
        <th>Editorial</th>
        <th>Acciones</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($rows)) {
        ?>
        <tr>
            <td><?php echo $row["id_editorial"]; ?></td>
            <td><?php echo $row["nom_editorial"]; ?></td>
            <td>
                <a type="text" name="eliminar" href="queries/deleteEditorial.php?id_editorial=<?php echo $row['id_editorial'] ?>"><b>Eliminar</b>
                </a>
                <a type="text" name="editar"  href="procesos/modifyEditoriales.php?id_editorial=<?php echo $row['id_editorial'] ?>"><b>Modificar</b>
                </a>
            </td>
        </tr>
        <?php
    }
    ?>
    <?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 0) {
            ?>
            <p style="color: greenyellow;"> Eliminacion Exitosa </p> 
        <?php } else { ?>
            <p style="color: red;"> Eliminacion Fallida </p>   
            <?php
        }
    }
    ?>
</table>
<?php

