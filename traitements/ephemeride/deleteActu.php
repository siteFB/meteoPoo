<?php
session_start();

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/sessions/sessionChoice.php');
require_once('../../libraries/utils/utils.php');

sess("Admin", "../../");

if(isset($_GET['idEphemeride']) && !empty($_GET['idEphemeride'])){

    $db = getPdo();

    $id = strip_tags(stripslashes(htmlentities(trim($_GET['idEphemeride']))));

    $sql = 'SELECT * FROM `Ephemeride` WHERE `idEphemeride` = :id;';

    $query = $db->prepare($sql);   
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $produit = $query->fetch();

    if(!$produit){
        info("erreur", "Cet id n'existe pas");
        redirect("../../templates/ephemerideTemplate/gererActu.php");
        exit();
    }

    $sql = 'DELETE FROM `Ephemeride` WHERE `idEphemeride` = :id;';

    $query = $db->prepare($sql);    
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    info("erreur", "Éphéméride supprimée");
    redirect("../../templates/ephemerideTemplate/gererActu.php");

}else{
    info("erreur", "URL invalide");
    redirect("../../templates/ephemerideTemplate/gererActu.php");
}
?>

