<?php   // Consulter: réservé aux inscrits connectés
session_start();

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/base/deconnexionBDD.php');
require_once('../../libraries/utils/utils.php');

if (isset($_SESSION["user"]["statut"])){
$db = getPdo();

$sql = 'SELECT * FROM `ephemeride`';
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$db = deco();

}else{
    info("erreur", "Vous devez vous connecter");
    redirect("index.php");
}
?>
