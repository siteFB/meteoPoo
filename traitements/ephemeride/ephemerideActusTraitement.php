<?php   // Éphéméride limitée accessible depuis l'accueil avant connection
require_once('libraries/base/connexionBDD.php');
require_once('libraries/base/deconnexionBDD.php');
require_once('libraries/models/Ephemeride.php');

$model = new Ephemeride();

$result = $model->showActu();
$db = deco(); 
?>