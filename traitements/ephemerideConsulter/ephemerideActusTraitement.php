<?php   // Éphéméride statique: accessible AVANT connection

require_once('libraries/base/connexionBDD.php');
require_once('libraries/base/deconnexionBDD.php');
require_once('libraries/models/IndexVisiteurs.php');

$result = showActu();
$db = deco(); 
?>