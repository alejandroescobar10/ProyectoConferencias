<?php    
    require_once '../models/Estudiante.php';    
   function listaDesplegablePrograma($metodo){
    if($metodo == 'GET'){
    return Estudiante::get_all_programa_lista();
    } 
   }     

?>