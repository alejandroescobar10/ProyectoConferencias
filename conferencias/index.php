<?php

if ($_GET['action'] == 'api/conferences') {
    $controller = new ConferenceController();
    $controller->listConferences();
} elseif ($_GET['action'] == 'api/register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $controller = new ConferenceController();
    $controller->registerForConference($data['studentId'], $data['conferenceId']);
}
