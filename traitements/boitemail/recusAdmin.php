<?php
session_start();

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/sessions/sessionChoice.php');
require_once('../../libraries/base/deconnexionBDD.php');

sess("Admin", "../../");

if (isset($_SESSION['user']['id']) and !empty($_SESSION['user']['id'])) {

    $id_destinataire = strip_tags($_SESSION['user']['id']);

    [$msg, $msg_nbr] = readAllMess($id_destinataire);
}

if ($msg_nbr == 0) {
    $_SESSION['message'] = "Vous n'avez aucun message";
}
?>

