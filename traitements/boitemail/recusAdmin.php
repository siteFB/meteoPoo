<?php

require_once('../../libraries/controllers/MailerAdmin.php');

$controller = new \Controllers\MailerAdmin();
$controller->receive();

/*
require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/sessions/sessionChoice.php');
require_once('../../libraries/models/Messagerie.php');

$model = new \Models\Message();

sess("Admin", "../../");

if (isset($_SESSION['user']['id']) and !empty($_SESSION['user']['id'])) {

    $id_destinataire = strip_tags($_SESSION['user']['id']);

    [$msg, $msg_nbr] = $model->readAll($id_destinataire);

if ($msg_nbr == 0) {
    $_SESSION['message'] = "Vous n'avez aucun message";
}
}
*/
?>

