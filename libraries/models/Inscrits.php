<?php

require_once('../libraries/base/connexionBDD.php');

class Inscrits{

/**
 * Return la liste des inscrits: visible pour l'admin (read only, here)
 */
public function see()
{
    $db = getPdo();
    $sql = 'SELECT * FROM `users`';
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}
}
