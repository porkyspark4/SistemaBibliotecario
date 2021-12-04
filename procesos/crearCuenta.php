<?php
require '../imports/dbConnection.php';

$success = false;
$error_msg = "";

if (isset($_POST['submit'])) {
    $nom_empleado = $_POST['nom_empleado'];
    $ape_empleado = $_POST['ape_empleado'];
    $password = $_POST['password'];
    $password_cpy = $_POST['password_cpy'];

    if ($password == $password_cpy) {
        //Se encripta la contraseña
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO empleado VALUES(0, '$ape_empleado', '$nom_empleado', '$password')";
//        echo $query;
        if (mysqli_query($connection, $query)) {
            $success = true;
        } else {
            $error_msg = "Error en los datos";
        }
    } else {
        $error_msg = "Las contraseñas deben coincidir";
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
        ?>
        <main>
            <div class="sign_in_panel">
                <h2>Crear Cuenta</h2>
                <hr>
                <?php
                $id_empleado = mysqli_insert_id($connection);
                if ($success) {
                    echo "Su clave de Empleado es: $id_empleado";
                    ?>
                    <form action="iniciarSesion.php" method="POST">
                        <input type="hidden" name="id_empleado" value="$id_empleado">
                        <input type="hidden" name="password" value="$password">
                        <input type="submit" name="signIn" value="Inicia Sesión">
                    </form>

                    <?php
                } else {
                    ?>
                    <form method="POST">
                        <table class="input_table">
                            <tr>
                                <td class="input_cell">Nombre:</td>
                                <td class="input_cell"><input type="text" name="nom_empleado"></td>
                            </tr>
                            <tr>
                                <td class="input_cell">Apellido(s):</td>
                                <td class="input_cell"><input type="text" name="ape_empleado"></td>
                            </tr>
                            <tr>
                                <td class="input_cell">Contraseña:</td>
                                <td class="input_cell"><input type="password" name="password"></td>
                            </tr>
                            <tr>
                                <td class="input_cell">Repita su contraseña:</td>
                                <td class="input_cell"><input type="password" name="password_cpy"></td>
                            </tr>
                            <tr>
                                <td class="input_cell" colspan="2"><input type="submit" name="submit" value="Crear Cuenta"></td>
                            </tr>
                        </table>
                        <p><?php echo $error_msg; ?></p>
                    </form>
                    <?php
                }
                ?>
            </div>
        </main>
    </body>
</html>


