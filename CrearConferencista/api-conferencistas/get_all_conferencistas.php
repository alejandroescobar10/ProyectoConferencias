<?php
require_once '../../conferencias/models/Database.php';
require_once '../models/Conferencista.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $conferencistas = Conferencista::get_all_conferencistas();
    echo json_encode($conferencistas);
}
