<?php    // Gestion réservée à l'admin: supprimer
session_start();

$controllerCRUD = new \Controllers\EphemerideCRUD();
$controllerCRUD->delete();
?>

