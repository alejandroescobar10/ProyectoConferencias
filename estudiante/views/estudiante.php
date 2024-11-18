<?php
require_once '../models/Database.php';
include "../controller/EstudianteControllers.php";
?>

<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../");
    exit();
}


?>
<html>

<head>
    <title> Estudiante </title>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudiantes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-pink-900 p-8 flex justify-center">
    <div class="max-w-3xl bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4 text-center">Lista de Estudiantes</h1>

        <!-- Formulario de estudiante -->
        <form class="space-y-4" method="POST" action="../controller/EstudianteControllers.php">
            <div class="flex items-center space-x-2">
                <label for="codigo" class="text-gray-700 font-semibold">Código:</label>
                <input type="text" name="codigo" id="codigo" class="border rounded-md px-2 py-1 w-full">
                <input type="button" value="Traer Datos" name="traerdatos" id="traerdatos" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer">
            </div> 

            <div class="flex items-center space-x-2">
                <label for="nombre" class="text-gray-700 font-semibold">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="border rounded-md px-2 py-1 w-full">
            </div>

            <div class="flex items-center space-x-2">
                <label for="apellido" class="text-gray-700 font-semibold">Apellido:</label>
                <input type="text" name="apellido" id="apellido" class="border rounded-md px-2 py-1 w-full">
            </div>

            <div class="flex items-center space-x-2">
                <label for="celular" class="text-gray-700 font-semibold">Celular:</label>
                <input type="text" name="celular" id="celular" class="border rounded-md px-2 py-1 w-full">
            </div>

            <!-- Lista desplegable de programas -->
            <div class="flex items-center space-x-2">
                <label for="programaList" class="text-gray-700 font-semibold">Programa:</label>
                <select name="programaList" id="programaList" class="border rounded-md px-2 py-1 w-full" <?php llenar_Lista_programas(); ?>>
                </select>
            </div>

            <div class="flex space-x-4">
                <button type="submit" name="procesar" id="procesar" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">Agregar</button>
                <button type="button" name="borrar" id="borrar" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Eliminar</button>
                <button type="button" name="actualizar" id="actualizar" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700">Actualizar</button>
                <button type="button" name="salir" id="salir" onclick="window.location.href='../../'" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-500">Salir</button>
            </div>

            <!-- Tabla para mostrar estudiantes -->
            <table class="table-auto min-w-full border border-gray-300 mt-6">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 border-b">ID</th>
                        <th class="px-4 py-2 border-b">Nombre</th>
                        <th class="px-4 py-2 border-b">Apellido</th>
                        <th class="px-4 py-2 border-b">Celular</th>
                        <th class="px-4 py-2 border-b">Programa</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                listarEstudiantes()
                    ?>
                </tbody>
            </table>
        </form>
    </div>

    <script>
        function borrar() {
            // Obtenemos la URL a la que se enviará la solicitud DELETE      
            var xhr = new XMLHttpRequest();
            var codigo = document.querySelector('#codigo').value;
            alert(codigo);
            xhr.open('DELETE', "../api-estudiantes/delete_estudiantes.php?codigo=" + codigo, true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    // Maneja la respuesta si es necesaria
                    console.log(xhr.responseText);
                } else {
                    // Maneja el error si es necesario
                    console.error(xhr.statusText);
                }
            };

            xhr.onerror = function() {
                // Maneja el error si es necesario
                console.error('Error de red.');
            };

            xhr.send();


            location.href = "../views/estudiante.php";
        }

        function actualizar() {
            // Obtenemos la URL a la que se enviará la solicitud DELETE

            var xhr = new XMLHttpRequest();
            var codigo = document.querySelector('#codigo').value;
            var nombre = document.querySelector('#nombre').value;
            var apellido = document.querySelector('#apellido').value;
            var celular = document.querySelector('#celular').value;
            var programa = document.querySelector('#programaList').value;

            let quiereActualizar = confirm("¿Actualizar?");
            if (quiereActualizar) {
                xhr.open('PUT', "../api-estudiantes/update_estudiante.php?codigo=" + codigo + "&nombre=" + nombre + "&apellido=" + apellido + "&celular=" + celular + "&programa=" + programa, true);
                xhr.onload = function() {

                    //console.log(xhr.responseText);

                    if (xhr.status >= 200 && xhr.status < 300) {
                        // Maneja la respuesta si es necesaria
                        //  console.log(xhr.responseText);
                        alert('estudiante Actualizado');

                    } else {
                        // Maneja el error si es necesario
                        //console.error(xhr.statusText);
                    }
                };

                xhr.onerror = function() {
                    // Maneja el error si es necesario
                    // console.error('Error de red.');
                };
                xhr.send();
                alert("codigo actualizado" + codigo);
                location.href = "../views/estudiante.php";
            }

        }

        function encontrarDatos() {
            // Obtenemos la URL a la que se enviará la solicitud DELETE
            //el código del registro a traer para modificar    
            var codigo = document.querySelector('#codigo').value;

            //alert(codigo);        
            var theObject = new XMLHttpRequest();
            theObject.open('GET', "../api-estudiantes/get_estudiante.php?codigo=" + codigo, true);
            theObject.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            theObject.onreadystatechange = function() {
                if (theObject.readyState === 4 & theObject.status === 200) {
                    //document.getElementById('container').innerHTML = theObject.responseText;
                    const obj = JSON.parse(theObject.responseText);
                    console.log(obj);
                    document.querySelector('#nombre').value = obj[0].nombre;
                    document.querySelector('#apellido').value = obj[0].apellido;
                    document.querySelector('#celular').value = obj[0].celular;
                    document.querySelector('#programaList').value = obj[0].programa;
                    //console.log(theObject.responseText);


                }
            }

            theObject.send("");

        }
        
        document.querySelector("#borrar").addEventListener("click", function() {
            borrar();
        });
        document.querySelector("#actualizar").addEventListener("click", function() {
            actualizar();
        });
        document.querySelector("#traerdatos").addEventListener("click", function() {
            encontrarDatos();
        });

    </script>
</body>

</html>