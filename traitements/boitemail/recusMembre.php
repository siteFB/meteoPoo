<?php
session_start();
if (!isset($_SESSION["user"]) && $user["statut"] == "Membre") {
    header("Location: ../templates/formConnexion.php");
    exit();
}

require_once('../../libraries/base/connexionBDD.php');

$db = getPdo();

if(isset($_SESSION['user']['id']) AND !empty($_SESSION['user']['id'])){  

    $id_destinataire = strip_tags($_SESSION['user']['id']);

$msg = $db->prepare("SELECT * FROM `messagerie` 
                     WHERE `id_destinataire` = :id_destinataire
                     ORDER BY dateMess
                     DESC
                     ");

$msg->bindValue(':id_destinataire', $id_destinataire, PDO::PARAM_INT);

$msg->execute();
$msg_nbr = $msg->rowCount();
}
?>
