<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../../conferencias/models/Conference.php'; // Asegúrate de que la ruta es correcta
require_once __DIR__ . '/../../conferencias/models/Database.php';

class AuthController
{
    private $userModel;

    public function __construct($db)
    {
        session_start();
        $this->userModel = new User($db);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codigo = $_POST['codigo'];
            $correo = $_POST['correo'];
            $clave = $_POST['clave'];
            $rol = $_POST['role'];

            if ($this->userModel->register($codigo, $correo, $clave, $rol)) {
                echo "<script>
                alert('Registro exitoso');
                window.location.href = 'index.php?action=login';
              </script>";
                exit();
            } else {
                echo "Error en el registro.";
            }
        }

        require_once 'views/register.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = $_POST['correo'];
            $clave = $_POST['clave'];

            // Obtener los datos del usuario
            $user = $this->userModel->login($correo, $clave);

            if ($user) {
                $_SESSION['user'] = $user;
                $_SESSION['student_id'] = $user['codigo'];

                // Llama al método para obtener el nombre desde la tabla estudiantes
                $studentName = Conference::getEstudianteNombre($user['codigo']);
                $_SESSION['student_name'] = $studentName;
                $_SESSION['user_role'] = $user['rol'];
                $_SESSION['token'] = bin2hex(random_bytes(16)); // Generar el token


                // Redirigir según el rol
                if ($_SESSION['user_role'] === 'administrador') {
                    header('Location: /parcial3/ProyectoConferencias/conferencias/views/menu.php'); // Ruta absoluta

                } else {
                    header('Location: /parcial3/ProyectoConferencias/estudiante/views/estudiante.php'); // Ruta absoluta para estudiante
                }
                exit();
            } else {
                echo "<script>alert('Credenciales incorrectas');</script>";
            }
        }

        require_once 'views/login.php';
    }
}
