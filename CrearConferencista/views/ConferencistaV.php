<?php

session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user'])) {
    header('Location: ../../../../login/views/login.php'); // Si no está autenticado, redirigir al login
    exit;
}
require_once '../../conferencias/models/Database.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Conferencistas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100 text-gray-900">

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Gestión de Conferencistas</h1>

        <div class="mb-4">
            <label for="codigo" class="block font-medium">Código:</label>
            <input type="text" id="codigo" class="w-full p-2 border border-gray-300 rounded">
            <button onclick="getConferencista()" class="bg-yellow-500 text-white px-4 py-2 rounded">Traer Datos</button>
        </div>

        <div class="mb-4">
            <label for="nombre" class="block font-medium">Nombre:</label>
            <input type="text" id="nombre" class="w-full p-2 border border-gray-300 rounded">
        </div>

        <div class="mb-4">
            <label for="apellido" class="block font-medium">Apellido:</label>
            <input type="text" id="apellido" class="w-full p-2 border border-gray-300 rounded">
        </div>

        <div class="mb-4">
            <label for="titulo_profesion" class="block font-medium">Título/Profesión:</label>
            <input type="text" id="titulo_profesion" class="w-full p-2 border border-gray-300 rounded">
        </div>

        <div class="flex space-x-2 mb-4">
            <button onclick="addConferencista()" class="bg-blue-500 text-white px-4 py-2 rounded">Agregar Conferencista</button>
            <button onclick="updateConferencista()" class="bg-green-500 text-white px-4 py-2 rounded">Actualizar Conferencista</button>
            <button onclick="deleteConferencista()" class="bg-red-500 text-white px-4 py-2 rounded">Eliminar Conferencista</button>
        </div>

        <div id="result" class="mt-4 bg-white p-4 rounded shadow">
            <table id="conferencistas-table" class="min-w-full table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border-b">Código</th>
                        <th class="px-4 py-2 border-b">Nombre</th>
                        <th class="px-4 py-2 border-b">Apellido</th>
                        <th class="px-4 py-2 border-b">Título/Profesión</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Los conferencistas se agregarán aquí automáticamente -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Función para cargar todos los conferencistas al entrar a la vista
        window.onload = function() {
            loadConferencistas();
        }

        // Función para listar todos los conferencistas desde la base de datos
        function loadConferencistas() {
            fetch('../api-conferencistas/get_all_conferencistas.php') // Asegúrate de tener la ruta correcta para tu API
                .then(response => response.json())
                .then(data => {
                    let html = '';
                    data.forEach(conf => {
                        console.log(conf);
                        html += `
                            <tr data-codigo="${conf.codigo}">
                                <td class="px-4 py-2 border-b text-center">${conf.id}</td>
                                <td class="px-4 py-2 border-b text-center">${conf.nombre}</td>
                                <td class="px-4 py-2 border-b text-center">${conf.apellido}</td>
                                <td class="px-4 py-2 border-b text-center">${conf.titulo_profesion}</td>
                            </tr>`;
                    });
                    document.querySelector('#conferencistas-table tbody').innerHTML = html;
                })
                .catch(error => console.error('Error al cargar los conferencistas:', error));
        }

        // Función para traer los datos de un conferencista por su código
        function getConferencista() {
            const codigo = document.getElementById('codigo').value;

            fetch(`../api-conferencistas/get_conferencista.php?codigo=${codigo}`)
                .then(response => response.json())
                .then(data => {
                    if (data.message === "Conferencista no encontrado") {
                        alert(data.message);
                    } else {
                        document.getElementById('nombre').value = data.nombre;
                        document.getElementById('apellido').value = data.apellido;
                        document.getElementById('titulo_profesion').value = data.titulo_profesion;
                    }
                })
                .catch(error => console.error('Error al traer datos del conferencista:', error));
        }

        // Función para agregar un nuevo conferencista
        function addConferencista() {
            const conferencista = {
                codigo: document.getElementById('codigo').value,
                nombre: document.getElementById('nombre').value,
                apellido: document.getElementById('apellido').value,
                titulo_profesion: document.getElementById('titulo_profesion').value
            };

            fetch('../api-conferencistas/create_conferencista.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(conferencista)
                })
                .then(response => response.json())
                .then(result => {
                    alert(result.success ? "Conferencista agregado" : "Error al agregar conferencista");
                    if (result.success) {
                        loadConferencistas(); // Recargar la lista de conferencistas
                    }
                    clearForm();
                })
                .catch(error => console.error('Error al agregar conferencista:', error));
        }

        // Función para actualizar un conferencista
        function updateConferencista() {
            const conferencista = {
                codigo: document.getElementById('codigo').value,
                nombre: document.getElementById('nombre').value,
                apellido: document.getElementById('apellido').value,
                titulo_profesion: document.getElementById('titulo_profesion').value
            };

            fetch('../api-conferencistas/update_conferencista.php', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(conferencista)
                })
                .then(response => response.json())
                .then(result => {
                    alert(result.success ? "Conferencista actualizado" : "Error al actualizar conferencista");
                    if (result.success) {
                        loadConferencistas(); // Recargar la lista de conferencistas
                    }
                    clearForm();
                })
                .catch(error => console.error('Error al actualizar conferencista:', error));
        }

        // Función para eliminar un conferencista
        function deleteConferencista() {
            const codigo = document.getElementById('codigo').value;

            fetch(`../api-conferencistas/delete_conferencista.php?codigo=${codigo}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(result => {
                    alert(result.success ? "Conferencista eliminado" : "Error al eliminar conferencista");
                    if (result.success) {
                        loadConferencistas(); // Recargar la lista de conferencistas
                    }
                    clearForm();
                })
                .catch(error => console.error('Error al eliminar conferencista:', error));
        }

        // Función para limpiar los campos del formulario
        function clearForm() {
            document.getElementById('codigo').value = '';
            document.getElementById('nombre').value = '';
            document.getElementById('apellido').value = '';
            document.getElementById('titulo_profesion').value = '';
        }
    </script>

</body>

</html>