<?php
session_start();
if (!isset($_SESSION["user"]) && $user["statut"] == "Membre") {
    header("Location: ../templates/formConnexion.php");
    exit();
}

if (isset($_GET['idUser']) && !empty($_GET['idUser'])) {

require_once('../../libraries/base/connexionBDD.php');

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
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: /traitements/boitemail/recusMembre.php');
    }
}
?>
