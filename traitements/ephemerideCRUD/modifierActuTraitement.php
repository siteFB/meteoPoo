<?php    // Gestion réservée à l'admin: modifier
session_start();

$controllerCRUD = new \Controllers\EphemerideCRUD();
$controllerCRUD->modifier();
?>