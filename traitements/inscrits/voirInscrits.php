<?php
session_start();

require_once('../libraries/base/connexionBDD.php');
require_once('../libraries/sessions/sessionChoice.php');
require_once('../libraries/base/deconnexionBDD.php');

sess("Admin", "../");

$db = getPdo();

$sql = 'SELECT * FROM `users`';
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$db = deco();

?>
