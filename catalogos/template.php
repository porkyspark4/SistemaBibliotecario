<?php
require 'imports/topNav.php';

$catalogo = $_GET['catalogo'];

?>
<div class="form_cotainer">
     <?php
//Genera formulario de registros
    switch ($catalogo) {
            case 'editoriales':
                require 'catalogos/registrarEditorial.php';
                if(isset($_POST['submit'])){
                    require 'queries/insertEditorial.php';
                }
                break;
            case 'autores':
                require 'catalogos/registrarAutor.php';
                if(isset($_POST['submit'])){
                    require 'queries/insertAutor.php';
                }
                break;
            case 'temas':
                require 'catalogos/registrarTema.php';
                if(isset($_POST['submit'])){
                    require 'queries/insertTema.php';
                }
                break;
            case 'bibliotecas':
                require 'catalogos/registrarBiblioteca.php';
                if(isset($_POST['submit'])){
                    require 'queries/insertBiblioteca.php';
                }
                break;
            case 'usuarios':
              require 'catalogos/registrarUsuario.php';
                if(isset($_POST['submit'])){
                    require 'queries/insertUsuario.php';
                }
                break;
            case 'empleados':
                require 'catalogos/registrarEmpleado.php';
                if(isset($_POST['submit'])){
                    require 'queries/insertEmpleado.php';
                }
                break;
            default:
                break;
        }
    
    ?>
    
</div>
<div class="table_container">

    <?php
//Genera tablas
    switch ($catalogo) {
            case 'editoriales':
                echo '<h2>Editoriales</h2>';
                require 'queries/selectEditorial.php';
                break;
            case 'autores':
                echo '<h2>Autores</h2>';
                require 'queries/selectAutores.php';
                break;
            case 'temas':
                echo '<h2>Temas</h2>';
                require 'queries/selectTemas.php';
                break;
            case 'bibliotecas':
                echo '<h2>Bibliotecas</h2>';
                require 'queries/selectBibliotecas.php';
                break;
            case 'usuarios':
                echo '<h2>Usuarios</h2>';
                require 'queries/selectUsuarios.php';
                break;
            case 'empleados':
                echo '<h2>Empleados</h2>';
                require 'queries/selectEmpleados.php';
                break;
            default:
                break;
        }
    
    ?>
</div>
