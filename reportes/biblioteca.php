<?php
require 'imports/dbConnection.php';
require 'queries/comboBibliotecas.php';
$query = "SELECT * FROM biblioteca ORDER BY id_biblioteca ASC";
$rows = mysqli_query($connection, $query);
?>




<h1>Reporte Por Biblioteca</h1>


<div>
    <form method="POST" action="reportes/printPDFbiblioteca.php">
        <table >
            <tr>
                <td class="input_cell"><?php echo 'Elegir Biblioteca:'; ?></td>
                <td >
                    <select name="id_biblioteca" id ="id_biblioteca" >
                        <?php
                        while ($row = mysqli_fetch_array($rows)) {
                            ?>
                            <option value="<?php echo $row['id_biblioteca']; ?>" 
                            <?PHP
                            if (isset($_POST['id_biblioteca']) && isset($index)) {
                                echo $row['id_biblioteca'] == $_POST['id_biblioteca'][$index] ? "selected" : "";
                            }
                            ?>>
                            <?php echo $row['nom_biblioteca']; ?></option>

                            <?php
                        }
                        ?>
                    </select></td>
            </tr>     
        </table>
        <input class="reporteBiblioteca" type="submit" name="registrar" value="Generar Reporte"><br>                    
    </form>
</div>

