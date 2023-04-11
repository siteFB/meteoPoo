<?php
session_start();
require_once('../../libraries/base/deconnexionBDD.php');
require_once('../../libraries/utils/utils.php');

$titre = "Déconnexion de votre espace personnel";

include "layout.php";
include "header.php";
?>
<?php
if (isset($_SESSION["user"])) {

    unset($_SESSION["user"]);
    $db = deco();
    redirect("../../templates/formConnexion.php");
}
redirect("../../templates/formConnexion.php");
?>


