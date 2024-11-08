<?php
require_once 'models/Database.php';
require_once 'models/Conference.php'; // Asegúrate de incluir tu modelo

class ConferenceController
{
    public function listConferences()
    {
        // Obtener conferencias
        $conferences = Conference::getConferences();
        echo json_encode($conferences);
    }

    public function registerForConference($studentId, $conferenceId)
    {
        // Función para inscribir al estudiante en una conferencia específica
        $db = Database::connect();
        $query = $db->prepare("INSERT INTO detalle_inscritos (estudiante_id, conferencia_id) VALUES (?, ?)");
        $query->execute([$studentId, $conferenceId]);
        echo json_encode(["status" => "success"]);
    }

    public function showConferencePage()
    {
        $studentId = $_SESSION['student_id'];
        $studentName = Conference::getEstudianteNombre($studentId); // Obtener el nombre del estudiante
        $conferences = Conference::getConferences(); // Obtener las conferencias

        include 'views/conferences.php'; // Cargar la vista con las conferencias
    }
}
