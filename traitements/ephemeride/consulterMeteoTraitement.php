<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../../templates/formConnexion.php");
    exit(); 
}

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/base/deconnexionBDD.php');

$db = getPdo();

$sql = 'SELECT * FROM `ephemeride`';
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$db = deco(); 
?>
