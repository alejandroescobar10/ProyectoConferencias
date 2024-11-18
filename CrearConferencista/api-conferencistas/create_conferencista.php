<?php
require_once '../../conferencias/models/Database.php';
require_once '../models/Conferencista.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $resultado = Conferencista::create_conferencista($data['nombre'], $data['apellido'], $data['titulo_profesion']);
    echo json_encode($resultado ? ['success' => true] : ['success' => false]);
}
