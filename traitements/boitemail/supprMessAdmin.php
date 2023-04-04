<?php
session_start();

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/sessions/sessionChoice.php');
require_once('../../libraries/base/deconnexionBDD.php');
require_once('../../libraries/utils/utils.php');

sess("Admin", "../../");

if (isset($_GET['idUser']) && !empty($_GET['idUser'])) {

    $db = getPdo();

    $id = strip_tags($_GET['idUser']);

    $requete = $db->prepare('SELECT * FROM messagerie WHERE idMessagerie = :id; ');

    $requete->bindValue(':id', $id, PDO::PARAM_INT);

    $requete->execute();

    $resultat = $requete->fetch();

    if (!$resultat) {
        info("erreur", "Cet id n'existe pas");
        redirect("../../templates/boitemailTemplate/msgRecusAdmin.php");
        exit();
    }

    $sql = 'DELETE FROM messagerie WHERE idMessagerie = :id;';

    $requete = $db->prepare($sql);

    $requete->bindValue(':id', $id, PDO::PARAM_INT);

    $requete->execute();

    info("message", "Message supprimé");
    redirect("../../templates/boitemailTemplate/msgRecusAdmin.php");


} else {
    info("erreur", "URL invalide");
    redirect("../../templates/boitemailTemplate/msgRecusAdmin.php");
}
?>

