<?php    // Zoom météo réservé aux inscrits connectés
session_start();

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/base/deconnexionBDD.php');
require_once('../../libraries/utils/utils.php');
require_once('../../libraries/models/Ephemeride.php');

$model = new Ephemeride();

if (isset($_SESSION["user"]["statut"])){
if(isset($_GET['idEphemeride']) && !empty($_GET['idEphemeride'])){
    $id = strip_tags(stripslashes(htmlentities(trim($_GET['idEphemeride']))));
  
    $produit = $model->showOne($id);

    if(!$produit){
        info("erreur", "Cet id n'existe pas");
        redirect("consulterMeteo.php");
    }

}else{
    info("erreur", "URL invalide");
    redirect("consulterMeteo.php");
}
}else{
    info("erreur", "Vous devez vous connecter");
    redirect("index.php");
}
?>