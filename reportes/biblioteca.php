<?php
require 'imports/dbConnection.php';
require 'queries/comboBibliotecas.php';
$query = "SELECT * FROM biblioteca ORDER BY id_biblioteca ASC";
$rows = mysqli_query($connection, $query);
?>

<h1>Reporte Por Biblioteca</h1>

<div>
    <?php
    if (!isset($_POST['filter'])) {
        ?>
        <form method="POST" action="index.php?reporte=biblioteca">
            <table class="input_table">
                <tr>
                    <td class="input_cell"><input type="radio" name="filter" value="biblioteca" onclick=""></td>
                    <td class="input_cell"><?php echo 'Elegir Biblioteca'; ?></td>
                </tr> 
                <tr>
                    <td class="input_cell"><input type="radio" name="filter" value="todos"></td>
                    <td class="input_cell" colspan="2"><?php echo 'Todos'; ?></td>
                </tr>
            </table>
            <input class="reporteBiblioteca" type="submit" name="next" value="Siguiente"><br>                    
        </form>
        <?php
    } else {
        $filter = $_POST['filter'];
        if ($filter == "biblioteca") {
            ?>
            <form method="POST" action="index.php?reporte=biblioteca">
                <input type="hidden" name="filter" value="biblioteca">
                <table class="input_table">
                    <tr>
                        <td class="input_cell"><?php echo 'Elegir Biblioteca:'; ?></td>
                        <td class="input_cell"><?php comboBiblioteca(null); ?></td>
                    </tr> 
                </table>
                <input class="reporteBiblioteca" type="submit" name="submit" value="Generar Reporte"><br>
            </form>
            <?php
            if(isset($_POST['submit'])){
                require 'queries/selectReporteBiblioteca.php';
            }
        } else if ($filter == "todos") {
            ?>
            
            <?php
        }
    }
    ?>

</div>

