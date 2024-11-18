<?php
require_once __DIR__ . '/Database.php';


class Estudiante
{
     public static function create_estudiante($nombre, $apellido, $celular, $programa_id) {
            $conn = Database::connect();
    
            $stmt = $conn->prepare('INSERT INTO estudiantes (nombre, apellido, celular, programa_id) VALUES (:nombre, :apellido, :celular, :programa_id)');
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':celular', $celular);
            $stmt->bindParam(':programa_id', $programa_id);
    
            return $stmt->execute();
        }
    
    
    public static function delete_estudiante($id)
    {
        $database = new Database();
        $conn = $database -> connect();

        $stmt = $conn->prepare('DELETE FROM estudiantes WHERE id=:id');
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public static function get_one_estudiante($id)
    {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare('SELECT e.codigo,e.nombre,e.apellido,e.celular,p.nombre FROM estudiantes e JOIN programas p ON e.programa_id = p.id where e.codigo=:id');
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll();
            echo json_encode($result);
        } else {
            header('HTTP/1.1 404 No se ha podido consultar el estudiante');
        }
    }

    // public static function get_all_estudiantes()
    // {
    //     $database = new Database();
    //     $conn = $database->connect();

    //     $stmt = $conn->prepare('SELECT e.codigo, e.nombre, e.apellido, e.celular, p.nombre FROM estudiantes e INNER JOIN programas p ON e.programa_id = p.id');
    //     $stmt->execute();

    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
    public static function get_all_estudiantes()
    {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare('SELECT e.codigo, e.nombre, e.apellido, e.celular, p.nombre FROM estudiantes e INNER JOIN programas p ON e.programa_id = p.id');
        if ($stmt->execute()) {
            $result = $stmt->fetchAll();
            return json_encode($result);
            header('HTTP/1.1 201 OK');
        } else {
            header('HTTP/1.1 404 No se ha podido consultar los estudiantes');
        }
    }
    public static function update_estudiante($codigo, $nombre, $apellido, $celular, $programa_id)
    {
        $database = new Database();
        $conn = $database->connect();

        $stmt = $conn->prepare('UPDATE estudiantes SET nombre = :nombre, apellido = :apellido, celular = :celular, programa_id=:programa_id WHERE id = :id');
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':celular', $celular);
        $stmt->bindParam(':programa_id', $programa_id);
        $stmt->bindParam(':codigo', $codigo);

        return $stmt->execute();
    }
      
      
    public static function get_all_programa_lista()
    {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare('SELECT id,nombre FROM programas');
        if ($stmt->execute()) {
            $result = $stmt->fetchAll();
            return json_encode($result);
            header('HTTP/1.1 201 OK');
        } else {
            header('HTTP/1.1 404 No se ha podido consultar las marcas');
        }
}
}