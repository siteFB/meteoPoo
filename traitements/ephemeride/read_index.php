<?php
require_once('base/connexionBDD.php');

$sql = 'SELECT * FROM `ephemeride`';

$query = $db->prepare($sql);

$query->execute();

$result = $query->fetchAll(PDO::FETCH_ASSOC);

?>