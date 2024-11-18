<?php
require_once 'controller/AuthController.php';

// Crear conexión a la base de datos
$db = new PDO('mysql:host=localhost;port=3307;dbname=parcial_3', 'root', '');
$authController = new AuthController($db);

// Manejar las acciones
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

switch ($action) {
    case 'register':
        $authController->register();
        break;
    case 'login':
    default:
        $authController->login();
        break;
}
