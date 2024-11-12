<?php
require_once '../includes/Database.class.php';
require_once '../includes/Conferencista.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $conferencistas = Conferencista::get_all_conferencistas();
    echo json_encode($conferencistas);
}
