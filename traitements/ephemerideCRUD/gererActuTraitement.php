<?php    // Gestion réservée à l'admin: accueil


$controllerCRUD = new \Controllers\EphemerideCRUD();
$controllerCRUD->accueilMeteoAdmin();
/*
require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/sessions/sessionChoice.php');
require_once('../../libraries/base/deconnexionBDD.php');
require_once('../../libraries/models/Ephemeride.php');

$model = new Ephemeride();

sess("Admin", "../../");

$result = $model->findAll();
$db = deco();
*/
?>
