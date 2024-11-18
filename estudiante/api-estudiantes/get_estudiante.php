<?php    
    require_once '../models/Estudiante.php';    

    return Estudiante::get_one_estudiante($_GET["id"]);


?>