<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../../templates/formConnexion.php");
    exit(); 
}

if(isset($_GET['idEphemeride']) && !empty($_GET['idEphemeride'])){
  
    require_once('../../libraries/base/connexionBDD.php');
    
    $db = getPdo();

    $id = strip_tags(stripslashes(htmlentities(trim($_GET['idEphemeride']))));

    $sql = 'SELECT `imgTemps` FROM `Ephemeride` WHERE `idEphemeride` = :id;';

    $query = $db->prepare($sql);
    
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();

    $produit = $query->fetch();

    if(!$produit){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: consulterMeteo.php');
    }
    
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: consulterMeteo.php');
}
?>