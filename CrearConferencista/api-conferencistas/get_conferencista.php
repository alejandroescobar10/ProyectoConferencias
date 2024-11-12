<?php
require_once '../../conferencias/models/Database.php';
require_once '../models/Conferencista.class.php';

$db = Database::connect();

if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    // Ejemplo de consulta (ajusta según tu base de datos)
    $stmt = $db->prepare("SELECT nombre, apellido, titulo_profesion FROM conferencistas WHERE id = :codigo");
    $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $conferencista = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($conferencista);
    } else {
        echo json_encode(["message" => "Conferencista no encontrado"]);
    }
} else {
    echo json_encode(["message" => "Código no proporcionado"]);
}
