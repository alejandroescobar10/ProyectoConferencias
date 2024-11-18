<?php
require_once '../../conferencias/models/Database.php';
require_once '../models/Conferencista.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Validación de datos
    if ($data && isset($data['codigo'], $data['nombre'], $data['apellido'], $data['titulo_profesion'])) {
        $codigo = $data['codigo']; // Cambié 'id' por 'codigo' para que coincida con lo enviado
        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $titulo_profesion = $data['titulo_profesion'];

        // Llamada a la función de actualización del conferencista
        $resultado = Conferencista::update_conferencista($codigo, $nombre, $apellido, $titulo_profesion);

        echo json_encode($resultado ? ['success' => true] : ['success' => false]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos o JSON no válido']);
    }
}
