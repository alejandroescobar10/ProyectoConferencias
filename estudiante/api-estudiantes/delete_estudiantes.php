<?php    
    
    if($_SERVER['REQUEST_METHOD'] == 'DELETE' ){
        include '../models/Estudiante.php';    
        Estudiante::delete_estudiante($_GET["codigo"]);
    } 

    


?>