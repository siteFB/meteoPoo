<?php
$titre = "Déconnexion espace membre";

include "layout.php";
include "header.php";

?>
<?php
session_start();

//Déconnxeion de la base de données
$db = null;

//Supprimer la session si elle existe
if (!isset($_SESSION["user"])) {
unset($_SESSION["user"]);
    header("Location: /templates/formConnexion.php");
    die();
}
header("Location: /templates/formConnexion.php");
?>


