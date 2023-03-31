<?php
session_start();
if (!isset($_SESSION["user"])) {
  header("Location: ../templates/formConnexion.php");
  exit();
}

require_once('../base/connexionBDD.php');

$sql = 'SELECT * FROM `users`';

$query = $db->prepare($sql);

$query->execute();

$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('../base/deconnexionBDD.php');
?>

