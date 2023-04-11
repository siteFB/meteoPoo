<?php   // Consulter: réservé aux inscrits connectés
session_start();

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/base/deconnexionBDD.php');
require_once('../../libraries/utils/utils.php');

if (isset($_SESSION["user"]["statut"])){

$result = showActu();

$db = deco();

}else{
    info("erreur", "Vous devez vous connecter");
    redirect("index.php");
}
?>
