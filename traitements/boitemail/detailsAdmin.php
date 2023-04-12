<?php
session_start();

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/sessions/sessionChoice.php');
require_once('../../libraries/base/deconnexionBDD.php');
require_once('../../libraries/utils/utils.php');
require_once('../../libraries/models/Messagerie.php');

$model = new Message();

sess("Admin", "../../");

if (isset($_GET['idUser']) && !empty($_GET['idUser'])) {

    $id = strip_tags(stripslashes(htmlentities(trim(($_GET['idUser'])))));
    $id_destinataire = strip_tags(stripslashes(htmlentities(trim($_SESSION['user']['id']))));

    [$msg_nbr, $resultat] = $model->readOnlyOne($id, $id_destinataire);

    if (!$resultat) {
        info("erreur", "Cet id n'existe pas");
        redirect("/templates/boitemailTemplate/msgRecusAdmin.php");
    }
}
?>


