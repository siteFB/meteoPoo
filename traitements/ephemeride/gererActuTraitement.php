<?php    // Gestion réservée à l'admin
session_start();

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/sessions/sessionChoice.php');
require_once('../../libraries/base/deconnexionBDD.php');

$db = getPdo();

sess("Admin", "../../");

$sql = 'SELECT * FROM `ephemeride`';

$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$db = deco(); 
?>
