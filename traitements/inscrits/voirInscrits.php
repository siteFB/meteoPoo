<?php
session_start();

require_once('../libraries/base/connexionBDD.php');
require_once('../libraries/sessions/sessionChoice.php');
require_once('../libraries/base/deconnexionBDD.php');
require_once('../libraries/models/Inscrits.php');

$model = new \Models\Inscrits();

sess("Admin", "../");

$result = $model->see();

$db = deco();

?>
