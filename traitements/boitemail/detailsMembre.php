<?php
session_start();

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/sessions/sessionChoice.php');
require_once('../../libraries/base/deconnexionBDD.php');
require_once('../../libraries/utils/utils.php');

sess("Membre", "../../");

if (isset($_GET['idUser']) && !empty($_GET['idUser'])) {

    $id = strip_tags(stripslashes(htmlentities(trim($_GET['idUser']))));
    $id_destinataire = strip_tags(stripslashes(htmlentities(trim($_SESSION['user']['id']))));

    [$msg_nbr, $resultat] = readOneMess($id, $id_destinataire);

    if (!$resultat) {
        info("erreur", "Cet id n'existe pas");
        redirect("/templates/boitemailTemplate/msgRecusMembre.php");
    }
}
?>
