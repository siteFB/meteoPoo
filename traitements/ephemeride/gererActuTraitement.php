<?php    // Gestion réservée à l'admin
session_start();

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/sessions/sessionChoice.php');
require_once('../../libraries/base/deconnexionBDD.php');
require_once('../../libraries/models/Ephemeride.php');

$model = new Ephemeride();

sess("Admin", "../../");

$result = $model->findAll();
$db = deco(); 
?>
