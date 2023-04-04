<?php
session_start();

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/sessions/sessionChoice.php');
require_once('../../libraries/base/deconnexionBDD.php');

sess("Admin", "../../");

$db = getPdo();

if (isset($_SESSION['user']['id']) and !empty($_SESSION['user']['id'])) {

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

