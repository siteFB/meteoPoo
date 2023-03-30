<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../../templates/formConnexion.php");
    die(); 
}

if(isset($_GET['idEphemeride']) && !empty($_GET['idEphemeride'])){
    require_once('../../base/connexionBDD.php');

    $id = strip_tags(stripslashes(htmlentities(trim($_GET['idEphemeride']))));

    $sql = 'SELECT * FROM `Ephemeride` WHERE `idEphemeride` = :id;';

    $query = $db->prepare($sql);
    
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();

    $produit = $query->fetch();

    if(!$produit){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: /templates/espaceAdminister/gererActu.php');
        die();
    }

    $sql = 'DELETE FROM `Ephemeride` WHERE `idEphemeride` = :id;';

    $query = $db->prepare($sql);
    
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();

    $_SESSION['message'] = "Éphéméride supprimée";
    header('Location: /templates/espaceAdminister/gererActu.php');

}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: /templates/espaceAdminister/gererActu.php');
}
?>

