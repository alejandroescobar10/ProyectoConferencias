<?php     
 

    if($_SERVER['REQUEST_METHOD'] == 'PUT' 
    && isset($_GET['codigo'], $_GET['nombre']) && isset($_GET['apellido']) && isset($_GET['celular'])  && isset($_GET['programa_id'])){
        include '../models/Estudiante.php';
        Estudiante::update_estudiante($_GET['codigo'], $_GET['nombre'], $_GET['apellido'], $_GET['celular'], $_GET['programa_id']);
    }







?>
