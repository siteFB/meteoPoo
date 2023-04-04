<?php
session_start();

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/sessions/sessionChoice.php');
require_once('../../libraries/base/deconnexionBDD.php');
require_once('../../libraries/utils/utils.php');

sess("Membre", "../../");

if (isset($_GET['idUser']) && !empty($_GET['idUser'])) {

$db = getPdo();

    $id = strip_tags(stripslashes(htmlentities(trim($_GET['idUser']))));
    $id_destinataire = strip_tags(stripslashes(htmlentities(trim($_SESSION['user']['id']))));

    $msg = $db->prepare('SELECT pseudo, titreMessage, idMessagerie, mesage, dateMess
                         FROM messagerie
                         LEFT JOIN users
                         ON users.idUser = messagerie.id_expediteur
                         WHERE messagerie.id_expediteur = :idUser AND id_destinataire = :id_destinataire
                         ORDER BY dateMess
                         DESC
                         ');

    $msg->bindValue(':idUser', $id, PDO::PARAM_INT);
    $msg->bindValue(':id_destinataire', $id_destinataire, PDO::PARAM_INT);

    $msg->execute();

    $msg_nbr = $msg->rowCount();

    $resultat = $msg->fetchAll(PDO::FETCH_ASSOC);

    if (!$resultat) {
        info("erreur", "Cet id n'existe pas");
        redirect("/templates/boitemailTemplate/msgRecusMembre.php");
    }
}
?>
