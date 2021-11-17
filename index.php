<!DOCTYPE html>
<?php
$catalogos = isset($_GET['catalogo']) ? true : false;
$procesos = isset($_GET['proceso']) ? true : false;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style/index.css?ts=<?= time() ?>&quot;"/>
        <link rel="stylesheet" type="text/css" href="style/header.css?ts=<?= time() ?>&quot;"/>
        <link rel="stylesheet" type="text/css" href="style/topNav.css?ts=<?= time() ?>&quot;"/>
        <link rel="stylesheet" type="text/css" href="style/sideNav.css?ts=<?= time() ?>&quot;"/>
        <link rel="stylesheet" type="text/css" href="style/template.css?ts=<?= time() ?>&quot;"/>
        <link href="https://fonts.googleapis.com/css2?family=Zen+Kurenaido&display=swap" rel="stylesheet">
        <title>Sistema Bibliotecario</title>
    </head>
    <body>
        <?php
        require 'imports/header.php';
        ?>
        <main>
            <?php
//                    require 'imports/topNav.php';
            require 'imports/sideNav.php';
            ?>
            <section>
                <?php
                if ($catalogos) {
                    require 'catalogos/template.php';
                }
                else if($procesos){
                    require 'procesos/procesosMenu.php';
                }
                ?>
            </section>
        </main>
    </body>
</html>
