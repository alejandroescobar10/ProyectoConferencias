
<?php
echo getcwd();

include '../models/Estudiante.php';

    
    function crearEstudiante($nombre, $apellido, $celular, $programa){
      if ($_SERVER['REQUEST_METHOD']=="POST"){
        Estudiante::create_estudiante($nombre, $apellido, $celular, $programa);
      }
    }
?>