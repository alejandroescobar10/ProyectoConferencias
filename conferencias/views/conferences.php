<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conferencias</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        async function loadConferences() {
            const response = await fetch('api/conferences');
            const conferences = await response.json();

            let tableBody = document.getElementById('conference-list-body');
            conferences.forEach(conf => {
                tableBody.innerHTML += `
                    <tr>
                        <td class="border px-4 py-2">${conf.titulo}</td>
                        <td class="border px-4 py-2">${conf.fecha}</td>
                        <td class="border px-4 py-2">${conf.hora}</td>
                        <td class="border px-4 py-2">${conf.conferencista}</td>
                        <td class="border px-4 py-2">${conf.cupo_disponible}</td>
                        <td class="border px-4 py-2">
                            <button onclick="register(${conf.id})" class="bg-purple-600 text-white px-4 py-2 rounded">Inscribirse</button>
                        </td>
                    </tr>
                `;
            });
        }

        async function register(conferenceId) {
            const studentId = <?php echo $_SESSION['student_id']; ?>;
            const response = await fetch(`api/register`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    studentId,
                    conferenceId
                })
            });
            const result = await response.json();
            if (result.status === "success") alert("Inscripción exitosa");
        }

        window.onload = loadConferences;
    </script>
</head>

<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">Bienvenido, <?php echo json_encode($_SESSION['student_name']); ?></h1>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-200 text-gray-600">
                <th class="border px-4 py-2">Conferencias</th>
                <th class="border px-4 py-2">Fecha</th>
                <th class="border px-4 py-2">Hora</th>
                <th class="border px-4 py-2">Conferencista</th>
                <th class="border px-4 py-2">Cupo disponible</th>
                <th class="border px-4 py-2">Inscribirse</th>
            </tr>
        </thead>
        <tbody id="conference-list-body">
            <!-- Las conferencias se agregarán aquí -->
        </tbody>
    </table>
</body>

</html>