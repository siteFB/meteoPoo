<?php
require_once('../../libraries/base/deconnexionBDD.php');
require_once('../../libraries/utils/utils.php');

$titre = "Déconnexion de votre espace personnel";

include "layout.php";
include "header.php";
?>
<?php
session_start();

if (isset($_SESSION["user"])) {

    // Supprimer la session 
    unset($_SESSION["user"]);
    // Déconnecter BDD
    $db = deco();

    redirect("../../templates/formConnexion.php");
    exit();
}
redirect("../../templates/formConnexion.php");
?>


