<?php
session_start();

require_once('../libraries/base/connexionBDD.php');
require_once('../libraries/sessions/sessionChoice.php');
require_once('../libraries/base/deconnexionBDD.php');

sess("Admin", "../");

$result = seeInscrits();

$db = deco();

?>
