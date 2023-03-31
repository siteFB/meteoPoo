<?php
$titre = "Déconnexion espace membre";

include "layout.php";
include "header.php";
?>
<?php
session_start();
require_once('../../libraries/base/deconnexionBDD.php');

//Déconnxeion de la base de données
$db = deco();

//Supprimer la session si elle existe
if (!isset($_SESSION["user"])) {
unset($_SESSION["user"]);
    header("Location: /templates/formConnexion.php");
    die();
}
header("Location: /templates/formConnexion.php");
?>


