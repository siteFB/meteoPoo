<?php
session_start();

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/sessions/sessionChoice.php');
require_once('../../libraries/base/deconnexionBDD.php');
require_once('../../libraries/utils/utils.php');

sess("Admin", "../../");

if (isset($_GET['idUser']) && !empty($_GET['idUser'])) {
    $id = strip_tags($_GET['idUser']);

    $resultat = oneMess($id);

    if (!$resultat) {
        info("erreur", "Cet id n'existe pas");
        redirect("../../templates/boitemailTemplate/msgRecusAdmin.php");
    }
    
    deleteMess($id);

    info("message", "Message supprimé");
    redirect("../../templates/boitemailTemplate/msgRecusAdmin.php");

} else {
    info("erreur", "URL invalide");
    redirect("../../templates/boitemailTemplate/msgRecusAdmin.php");
}
?>

