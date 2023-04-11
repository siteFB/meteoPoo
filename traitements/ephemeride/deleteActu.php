<?php
session_start();

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/sessions/sessionChoice.php');
require_once('../../libraries/utils/utils.php');

sess("Admin", "../../");

if(isset($_GET['idEphemeride']) && !empty($_GET['idEphemeride'])){

    $db = getPdo();

    $id = strip_tags(stripslashes(htmlentities(trim($_GET['idEphemeride']))));

    $produit = showOneActu($id);

    if(!$produit){
        info("erreur", "Cet id n'existe pas");
        redirect("../../templates/ephemerideTemplate/gererActu.php");
    }

    deleteEphemeride($id);

    info("erreur", "Éphéméride supprimée");
    redirect("../../templates/ephemerideTemplate/gererActu.php");

}else{
    info("erreur", "URL invalide");
    redirect("../../templates/ephemerideTemplate/gererActu.php");
}
?>

