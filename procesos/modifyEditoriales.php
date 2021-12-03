<?php
require '../imports/dbConnection.php';

$id_editorial = $_GET['id_editorial'];

$query = "SELECT * FROM editorial WHERE id_editorial=$id_editorial"; // Selecciona todos los datos de la tabla editorial 
$result = mysqli_query($connection, $query);
$editorial = mysqli_fetch_array($result);
?>  

<div > 
    <h1>MODIFICAR EDITORIAL</h1>
    <div>
        <div >
            <form class="" method="POST" action="../queries/modifyEditorial.php">
                <input name="id_editorial" type="hidden" value="<?php echo $editorial['id_editorial']; ?>">
                <table class="input_table">
                    <tr>
                        <td>
                            Nombre Editorial:
                        </td>
                        <td>
                            <input name="nom_editorial" type="text" value="<?php echo $editorial['nom_editorial'] ?>">
                        </td>
                    </tr>
                    <div class="Save"><input  class="BtnSave" type="submit" value="Guardar" ></div>
            </form>    
        </div>
    </div>
</div>