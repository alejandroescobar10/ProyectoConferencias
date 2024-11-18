<?php
require_once '../../conferencias/models/Database.php';
require_once '../models/Conferencista.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Obtener el parámetro 'codigo' desde la URL
    parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $params);
    $codigo = $params['codigo'] ?? null;

    // Validar que el código no sea nulo
    if ($codigo) {
        // Llamar a la función de eliminación del conferencista
        $resultado = Conferencista::delete_conferencista($codigo);
        echo json_encode($resultado ? ['success' => true] : ['success' => false]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Código no proporcionado']);
    }
}
