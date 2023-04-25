<?php    // Zoom météo réservé aux inscrits connectés
session_start();

$controller = new \Controllers\EphemerideConsulter();
$controller->afficherUn();

?>