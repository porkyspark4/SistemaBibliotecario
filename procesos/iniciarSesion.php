<?php
session_start();
require '../imports/dbConnection.php';

if(isset($_POST['submit'])){
    $id_empleado = $_POST['id_empleado'];
    $password = $_POST['password'];
    $id_biblioteca = $_POST['id_biblioteca'][0];
    
    $query = "SELECT password FROM empleado WHERE id_empleado = $id_empleado";
    $rows = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($rows);
    
    if(PASSWORD_VERIFY($password, $row['password'])){
        $_SESSION['id_empleado'] = $id_empleado;
        $_SESSION['id_biblioteca'] = $id_biblioteca;
        header('Location: ../index.php?proceso=menu');
    }
}

?>


<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../style/index.css?ts=<?= time() ?>&quot;"/>
        <link rel="stylesheet" type="text/css" href="../style/header.css?ts=<?= time() ?>&quot;"/>
        <link rel="stylesheet" type="text/css" href="../style/inputs.css?ts=<?= time() ?>&quot;"/>
        <link rel="stylesheet" type="text/css" href="../style/session.css?ts=<?= time() ?>&quot;"/>
        <link href="https://fonts.googleapis.com/css2?family=Zen+Kurenaido&display=swap" rel="stylesheet">
        <title>Sistema Bibliotecario</title>
    </head>
    <body>
        <?php
        require '../imports/header.php';
        require '../queries/comboBibliotecas.php';
        ?>
        <main>
            <div class="sign_in_panel">
                <h2>Iniciar Sesion</h2>
                <hr>
                <form method="POST">
                    <table class="input_table">
                        <tr>
                            <td class="input_cell">Clave de Empleado:</td>
                            <td class="input_cell"><input type="text" name="id_empleado"></td>
                        </tr>
                        <tr>
                            <td class="input_cell">Biblioteca:</td>
                            <td class="input_cell"><?php comboBiblioteca(null); ?></td>
                        </tr>
                        <tr>
                            <td class="input_cell">Contraseña:</td>
                            <td class="input_cell"><input type="password" name="password"></td>
                        </tr>
                        <tr>
                            <td class="input_cell" colspan="2"><input type="submit" name="submit" value="Iniciar Sesión"></td>
                        </tr>
                        <tr>
                            <td class="input_cell" colspan="2">¿No tienes cuenta? <a href="crearCuenta.php">Click Aquí</a></td>
                        </tr>
                    </table>
                </form>
            </div>
        </main>
    </body>
</html>


