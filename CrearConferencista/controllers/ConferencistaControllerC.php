<?php
class ConferencistaController
{
    public function index()
    {
        // Obtener todos los conferencistas
        $conferencistas = Conferencista::get_all_conferencistas();
        echo json_encode($conferencistas);
    }

    public function show($id)
    {
        // Obtener un conferencista por su ID
        $conferencista = Conferencista::get_conferencista($id);
        echo json_encode($conferencista);
    }

    public function store($data)
    {
        // Crear un nuevo conferencista
        $nombre = $data['nombre'] ?? null;
        $apellido = $data['apellido'] ?? null;
        $email = $data['email'] ?? null;

        if ($nombre && $apellido && $email) {
            $result = Conferencista::create_conferencista($nombre, $apellido, $email);
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['error' => 'Datos incompletos']);
        }
    }

    public function update($id, $data)
    {
        // Actualizar un conferencista existente
        $nombre = $data['nombre'] ?? null;
        $apellido = $data['apellido'] ?? null;
        $titulo_profesion = $data['titulo_profesion'] ?? null;

        if ($nombre && $apellido && $titulo_profesion) {
            $result = Conferencista::update_conferencista($id, $nombre, $apellido, $titulo_profesion);
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['error' => 'Datos incompletos']);
        }
    }

    public function delete($id)
    {
        // Eliminar un conferencista por su ID
        $result = Conferencista::delete_conferencista($id);
        echo json_encode(['success' => $result]);
    }
}
