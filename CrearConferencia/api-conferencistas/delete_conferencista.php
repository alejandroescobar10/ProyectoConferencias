<?php
require_once '../includes/Database.class.php';
require_once '../includes/Conferencista.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];
    $resultado = Conferencista::delete_conferencista($id);
    echo json_encode($resultado ? ['success' => true] : ['success' => false]);
}
