<?php
session_start();
if (!isset($_SESSION["user"]) && $user["statut"] == "Admin") {
    header("Location: ../../templates/formConnexion.php");
    exit(); 
}

require_once('../../libraries/base/connexionBDD.php');

if(isset($_GET['idEphemeride']) && !empty($_GET['idEphemeride'])){

    $db = getPdo();

    $id = strip_tags(stripslashes(htmlentities(trim($_GET['idEphemeride']))));

    $sql = 'SELECT * FROM `Ephemeride` WHERE `idEphemeride` = :id;';

    $query = $db->prepare($sql);
    
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();

    $produit = $query->fetch();

    if(!$produit){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: /templates/ephemerideTemplate/gererActu.php');
        die();
    }

    $sql = 'DELETE FROM `Ephemeride` WHERE `idEphemeride` = :id;';

    $query = $db->prepare($sql);
    
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();

    $_SESSION['message'] = "Éphéméride supprimée";
    header('Location: /templates/ephemerideTemplate/gererActu.php');

}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: /templates/ephemerideTemplate/gererActu.php');
}
?>

