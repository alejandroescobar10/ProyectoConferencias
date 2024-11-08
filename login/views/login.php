<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-pink-900 flex justify-center items-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
        <h2 class="text-2xl font-bold mb-6 text-center">Iniciar sesión</h2>

        <form method="POST" action="index.php?action=login" class="space-y-4">
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Correo</label>
                <input type="email" name="correo" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500" placeholder="Correo electrónico" required>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Clave</label>
                <input type="password" name="clave" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500" placeholder="Contraseña" required>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">Iniciar sesión</button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            ¿No tienes una cuenta?
            <a href="index.php?action=register" class="text-indigo-600 hover:text-indigo-500">Regístrate</a>
        </p>
    </div>

</body>

</html>