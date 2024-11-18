
<?php   
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
    
    // Verificar si se envía el formulario de creación de estudiante
    if (isset($_POST['procesar']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['celular']) && isset($_POST['programaList'])) {
        include "../api-estudiantes/create_estudiante.php"; 
        
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $celular = $_POST['celular'];
        $programa = $_POST['programaList'];
        
        crearEstudiante($nombre, $apellido, $celular, $programa);
    }
} if (isset($_POST['borrar']) && isset($_POST['codigo']) ){
    include "../api-estudiantes/delete_estudiantes.php";  
  }

?>
<!-- <script type="text/javascript">   
   location.href = "../views/estudiante.php" 
 </script> -->

 <?php

  function llenar_Lista_programas(){
    include "../api-estudiantes/get_programas_lista.php"; 
    $data = json_decode(listaDesplegablePrograma("GET"), true);
    echo "<select name='programaList' id='programaList'>";
      foreach ($data as $item) { 
        echo "<option value=".$item['id'].">".$item['nombre']."</option>";
       }
  echo "</select>";
  
  
  }



 function listarEstudiantes() {
  include_once "../api-estudiantes/get_all_estudiantes.php"; 
  
  // Llamada a la función que obtiene todos los estudiantes en formato JSON
  $data = json_decode(listar("GET"), true);

  // Verificar si la respuesta tiene datos válidos
  if (!empty($data)) {
      foreach ($data as $item) {
          echo "<tr class='hover:bg-gray-100'>";
          echo "<td class='border-b px-4 py-2'>" . htmlspecialchars($item['id']) . "</td>";
          echo "<td class='border-b px-4 py-2'>" . htmlspecialchars($item['nombre']) . "</td>";
          echo "<td class='border-b px-4 py-2'>" . htmlspecialchars($item['apellido']) . "</td>";
          echo "<td class='border-b px-4 py-2'>" . htmlspecialchars($item['celular']) . "</td>";
          echo "<td class='border-b px-4 py-2'>" . htmlspecialchars($item['programa_id']) . "</td>";
          echo "</tr>";
      }
  } else {
      echo "<tr><td colspan='5' class='text-center py-4'>No se encontraron estudiantes.</td></tr>";
  }
}

?>

