<?php 
  require 'imports/dbConnection.php';
  
  require 'queries/comboBibliotecas.php';
 ?>

<h2>Inventario</h2>
<form action="index.php?proceso=inventario" method="POST">
    <?php
   if (isset($_POST['addMod'])){
       for ($i=0; $i< count($_POST['id_biblioteca']); $i++){
           modInventario($i);
       }
       newModInventario();
   }
   else{
       newModInventario();
   }
    ?>
    <input type="submit" name="addMod" value="+" >
    <input type="submit" name="addStack" value="Agregar Libros"><br><br>
</form>

<?php
if (isset($_POST['addStack'])) {
    require 'queries/insertLibroBiblioteca.php';
}

function modInventario($index) {
    echo 'Biblioteca:';
    multiComboBiblioteca($index);

    echo '<br><br>Libro:';
//    require 'queries/comboLibros.php';
//    echo '<br><br>Cantidad:';
    ?>
    <input type="number" name="cant" value="0" min="0"><br><br>

    <?php
}
function newModInventario() {
    echo 'Biblioteca:';
    newComboBiblioteca();

    echo '<br><br>Libro:';
//    require 'queries/comboLibros.php';
//    echo '<br><br>Cantidad:';
    ?>
    <input type="number" name="cant" value="0" min="0"><br><br>
    
    <?php
}