<?php
class Conferencista
{
    public static function create_conferencista($nombre, $apellido, $titulo_profesion)
    {
        $database = new Database();
        $conn = Database::connect();

        $stmt = $conn->prepare('INSERT INTO conferencistas (nombre, apellido, titulo_profesion) VALUES (:nombre, :apellido, :titulo_profesion)');
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':titulo_profesion', $titulo_profesion);

        return $stmt->execute();
    }
    public static function delete_conferencista($id)
    {
        $database = new Database();
        $conn = Database::connect();

        $stmt = $conn->prepare('DELETE FROM conferencistas WHERE id = :id');
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
    public static function get_conferencista($id)
    {
        $database = new Database();
        $conn = Database::connect();

        $stmt = $conn->prepare('SELECT * FROM conferencistas WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function get_all_conferencistas()
    {
        $database = new Database();
        $conn = Database::connect();

        $stmt = $conn->prepare('SELECT * FROM conferencistas');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function update_conferencista($id, $nombre, $apellido, $titulo_profesion)
    {
        $database = new Database();
        $conn = Database::connect();

        $stmt = $conn->prepare('UPDATE conferencistas SET nombre = :nombre, apellido = :apellido, titulo_profesion = :titulo_profesion WHERE id = :id');
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':titulo_profesion', $titulo_profesion);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
