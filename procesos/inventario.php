<?php
require 'imports/dbConnection.php';

require 'queries/comboBibliotecas.php';
require 'queries/comboLibros.php';

if (isset($_POST['addStack'])) {
    require 'queries/insertLibroBiblioteca.php';
} else {
    ?>
    <h2>Inventario</h2>
    <form action="index.php?proceso=inventario" method="POST">
        <?php
        if (isset($_POST['addMod'])) {
            for ($i = 0; $i < count($_POST['id_biblioteca']); $i++) {
                modInventario($i);
            }
            //modulo vacío
            modInventario(null);
        } else {
            //modulo vacío
            modInventario(null);
        }
        ?>
        <input type="submit" name="addMod" value="+" >
        <input type="submit" name="addStack" value="Agregar Libros"><br><br>
    </form>
    <?php
}

function modInventario($index) {
    ?>
    <div class="mod_inventario">
        <table class="input_table">
            <tr>
                <td class="input_cell"><?php echo 'Biblioteca:'; ?></td>
                <td class="input_cell"><?php comboBiblioteca($index); ?></td>
            </tr>
            <tr>
                <td class="input_cell"><?php echo 'Libro:'; ?></td>
                <td class="input_cell"><?php comboLibros($index); ?></td>
            </tr>
            <tr>
                <td class="input_cell"><?php echo 'Cantidad:'; ?></td>
                <td class="input_cell">
                    <input type="number" name="cant[]" min="0"
                           value="<?php echo isset($index) ? $_POST['cant'][$index] : '0'; ?>" >
                </td>
            </tr>
        </table>
    </div>
    <?php
}
