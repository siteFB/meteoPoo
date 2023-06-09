<?php

require_once('libraries/base/connexionBDD.php');

/**
 * Afficher toutes les éphémérides: read
 *   réservé uniquement aux visiteurs
 */
function showActu()
{
    $db = getPdo();
    $sql = 'SELECT * FROM `ephemeride`';
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();

    return $result;
}
