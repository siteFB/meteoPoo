<?php   // Éphéméride limitée accessible depuis l'accueil avant connection
require_once('libraries/base/connexionBDD.php');
require_once('libraries/base/deconnexionBDD.php');

$result = showActu();
$db = deco(); 
?>