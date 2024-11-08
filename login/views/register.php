<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-pink-900 flex items-center justify-center min-h-screen px-70 py-70">
    <div class="max-w-lg px-20 py-8 bg-white rounded-lg shadow-md relative">
        <h2 class="text-3xl text-center font-bold">Registrate</h2>
        <form method="POST" action="index.php?action=register">
            <div class="mt-4">
                <label for="codigo" class="block text-sm font-medium text-gray-700 ">Codigo</label>
                <input type="text" id="codigo" name="codigo" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm border-gray-300 rounded-md py-2" placeholder="Ingrese su nombre" require>
            </div>
            <div class="mt-4">
                <label for="correo" class="block text-sm font-medium text-gray-700 ">Correo</label>
                <input type="text" id="correo" name="correo" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm border-gray-300 rounded-md py-2" placeholder="Ingrese su edad" require>
            </div>
            <div class="mt-4">
                <label for="clave" class="block text-sm font-medium text-gray-700">Clave</label>
                <input type="password" id="clave" name="clave" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm border-gray-300 rounded-md py-2" placeholder="Ingrese su contraseña" require>
            </div>
            <div class="mt-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
                <select id="role" name="role" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm border-gray-300 rounded-md py-2">
                    <option value="estudiante">Estudiante</option>
                    <option value="administrador">Administrador</option>
                </select>
            </div>


            <div class="mt-6">
                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-400 text-white font-bold py-3 px-4 rounded-md">Registrarse</button>
            </div>
        </form>


        <p class="mt-6 text-center text-sm text-gray-600">
            ¿Ya tienes una cuenta?
            <a href="index.php?action=login" class="text-purple-600 hover:text-purple-500">Iniciar sesión</a>
        </p>


    </div>

</body>


</html>