<!DOCTYPE html>
<?php
$catalogos = isset($_GET['catalogo']) ? true : false;
$procesos = isset($_GET['proceso']) ? true : false;
$reportes = isset($_GET['reporte']) ? true : false;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style/index.css?ts=<?= time() ?>&quot;"/>
        <link rel="stylesheet" type="text/css" href="style/header.css?ts=<?= time() ?>&quot;"/>
        <link rel="stylesheet" type="text/css" href="style/topNav.css?ts=<?= time() ?>&quot;"/>
        <link rel="stylesheet" type="text/css" href="style/sideNav.css?ts=<?= time() ?>&quot;"/>
        <link rel="stylesheet" type="text/css" href="style/template.css?ts=<?= time() ?>&quot;"/>
        <link rel="stylesheet" type="text/css" href="style/inventario.css?ts=<?= time() ?>&quot;"/>
        <link rel="stylesheet" type="text/css" href="style/inputs.css?ts=<?= time() ?>&quot;"/>
        <link rel="stylesheet" type="text/css" href="style/session.css?ts=<?= time() ?>&quot;"/>
        <link href="https://fonts.googleapis.com/css2?family=Zen+Kurenaido&display=swap" rel="stylesheet">
        <title>Sistema Bibliotecario</title>
    </head>
    <body>
        <?php
        require 'imports/header.php';
        require 'imports/session.php';
        ?>
        <main>
            <?php
            require 'imports/sideNav.php';
            ?>
            <section>
                <?php
                if ($catalogos) {
                    require 'catalogos/template.php';
                } else if ($procesos) {
                    require 'procesos/procesosMenu.php';
                } else if ($reportes) {
                    require 'reportes/reportesMenu.php';
                }
                ?>
            </section>
        </main>
    </body>
</html>
