<?php

require_once('../../libraries/controllers/Mailer.php');

$controller = new \Controllers\MailerAdmin();
$controller->receive();
?>
