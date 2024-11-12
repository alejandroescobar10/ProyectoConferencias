<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'administrador') {
    header('Location: ../login.php'); // Redirige si no es administrador
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-6">Panel de Administración</h1>
    <nav>
        <ul class="space-y-4">
            <li>
                <a href="views/conferencistas.php" class="block bg-blue-500 text-white p-4 rounded hover:bg-blue-700">Gestionar Conferencistas</a>
            </li>
            <li>
                <a href="views/responsables.php" class="block bg-green-500 text-white p-4 rounded hover:bg-green-700">Gestionar Responsables</a>
            </li>
            <li>
                <a href="views/estudiantes.php" class="block bg-yellow-500 text-white p-4 rounded hover:bg-yellow-700">Gestionar Estudiantes</a>
            </li>
            <li>
                <a href="../../CrearConferencia/views/ConferencistaV.php" class="block bg-purple-500 text-white p-4 rounded hover:bg-purple-700">Gestionar Conferencias</a>
            </li>
        </ul>
    </nav>
</body>

</html>