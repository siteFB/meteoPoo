<?php
session_start();

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/sessions/sessionChoice.php');
require_once('../../libraries/utils/utils.php');
require_once('../../libraries/models/Ephemeride.php');

$model = new Ephemeride();

sess("Admin", "../../");

if(isset($_GET['idEphemeride']) && !empty($_GET['idEphemeride'])){

    $id = strip_tags(stripslashes(htmlentities(trim($_GET['idEphemeride']))));

    $produit = $model->showOne($id);

    if(!$produit){
        info("erreur", "Cet id n'existe pas");
        redirect("../../templates/ephemerideTemplate/gererActu.php");
    }

    $model->delete($id);

    info("erreur", "Éphéméride supprimée");
    redirect("../../templates/ephemerideTemplate/gererActu.php");

}else{
    info("erreur", "URL invalide");
    redirect("../../templates/ephemerideTemplate/gererActu.php");
}
?>

