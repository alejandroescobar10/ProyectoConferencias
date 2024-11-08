<?php
require_once __DIR__ . '/Database.php';


class Conference
{
    public static function getConferences()
    {
        $db = Database::connect();
        $query = $db->prepare("SELECT c.id, c.titulo, c.fecha, c.hora, c.cupo, c.cupo - COUNT(d.id) AS cupo_disponible,
        conf.nombre AS conferencista
        FROM conferencia c
        LEFT JOIN Detalle_inscritos d ON c.id = d.conferencia_id
        LEFT JOIN Conferencistas conf ON c.conferencista_id = conf.id
        GROUP BY c.id");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getEstudianteNombre($studentId)
    {
        $db = Database::connect();
        $query = $db->prepare("SELECT e.nombre 
                        FROM usuarios u 
                        JOIN estudiantes e ON u.id = e.codigo 
                        WHERE e.codigo = :estudiante_id");
        $query->bindParam(':estudiante_id', $studentId);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['nombre'] : null; // Retorna el nombre o null si no se encuentra
    }
}
