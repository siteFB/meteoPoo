<?php
require_once('libraries/base/connexionBDD.php');

$db = getPdo();

$sql = 'SELECT * FROM `ephemeride`';

$query = $db->prepare($sql);

$query->execute();

$result = $query->fetchAll(PDO::FETCH_ASSOC);

?>