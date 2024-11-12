<?php
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
            <button onclick="listConferencistas()" class="bg-gray-500 text-white px-4 py-2 rounded">Listar Conferencistas</button>
        </div>

        <div id="result" class="mt-4 bg-white p-4 rounded shadow"></div>
    </div>

    <script>
        function listConferencistas() {
            fetch('api/conferencistas')
                .then(response => response.json())
                .then(data => {
                    let html = '<ul class="space-y-2">';
                    data.forEach(conf => {
                        html += `
                            <li class="p-2 border-b border-gray-200">
                                <strong>Codigo:</strong> ${conf.codigo} <br>
                                <strong>Nombre:</strong> ${conf.nombre} <br>
                                <strong>Apellido:</strong> ${conf.apellido} <br>
                                <strong>Título/Profesión:</strong> ${conf.titulo_profesion}
                            </li>`;
                    });
                    html += '</ul>';
                    document.getElementById('result').innerHTML = html;
                })
                .catch(error => console.error('Error al listar conferencistas:', error));
        }

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
                    listConferencistas();
                })
                .catch(error => console.error('Error al agregar conferencista:', error));
        }

        function updateConferencista() {
            const conferencista = {
                codigo: document.getElementById('codigo').value,
                nombre: document.getElementById('nombre').value,
                apellido: document.getElementById('apellido').value,
                titulo_profesion: document.getElementById('titulo_profesion').value
            };

            fetch(`../api-conferencistas/update_conferencista.php/?codigo=${codigo}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(conferencista)
                })
                .then(response => response.json())
                .then(result => {
                    alert(result.success ? "Conferencista actualizado" : "Error al actualizar conferencista");
                    listConferencistas();
                })
                .catch(error => console.error('Error al actualizar conferencista:', error));
        }

        function deleteConferencista() {
            const codigo = document.getElementById('codigo').value;
            if (confirm("¿Estás seguro de que deseas eliminar este conferencista?")) {
                fetch(`api/conferencistas/${codigo}`, {
                        method: 'DELETE'
                    })
                    .then(response => response.json())
                    .then(result => {
                        alert(result.success ? "Conferencista eliminado" : "Error al eliminar conferencista");
                        listConferencistas();
                    })
                    .catch(error => console.error('Error al eliminar conferencista:', error));
            }
        }
    </script>

</body>

</html>