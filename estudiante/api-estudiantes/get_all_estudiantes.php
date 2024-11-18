<?php
require_once '../models/Database.php';
require_once '../models/Estudiante.php';    
     
   function listar($metodo){
    if($metodo == 'GET'){
    return Estudiante::get_all_estudiantes();
    } 
   }     

?>