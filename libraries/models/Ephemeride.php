<?php

require_once('libraries/base/connexionBDD.php');

class Ephemeride{

/**
 * Return CRUD éphéméride: create
 */
public function add(string $imgTemps, string $titre, string $topo)
{
    $db = getPdo();
    $sql = 'INSERT INTO `ephemeride`(`imgTemps`, `titre`, `topo`) VALUES (:imgTemps, :titre, :topo);';
    $query = $db->prepare($sql);
    $query->bindValue(':imgTemps', $imgTemps, PDO::PARAM_STR);
    $query->bindValue(':titre', $titre, PDO::PARAM_STR);
    $query->bindValue(':topo', $topo, PDO::PARAM_STR);

    $query->execute();
}

/**
 * Afficher toutes les éphémérides: read
 */
public function showActu()
{
    $db = getPdo();
    $sql = 'SELECT * FROM `ephemeride`';
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

/**
 * Afficher le détail d'une seule éphéméride: read
 */
public function showOne(int $id)
{
    $db = getPdo();
    $sql = 'SELECT * FROM `Ephemeride` WHERE `idEphemeride` = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $produit = $query->fetch();

    return $produit;
}

/**
 * Return CRUD éphéméride: upload
 */
public function modifier(int $id, string $image, string $titre, string $topo)
{
    $db = getPdo();
    $sql = 'UPDATE `ephemeride` SET `imgTemps`=:imgTemps, `titre`=:titre, `topo`=:topo WHERE `idEphemeride`=:id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->bindValue(':imgTemps', $image, PDO::PARAM_STR);
    $query->bindValue(':titre', $titre, PDO::PARAM_STR);
    $query->bindValue(':topo', $topo, PDO::PARAM_STR);

    $query->execute();
}

/**
 * Return CRUD éphéméride: delete
 */
public function delete(int $id): void
{
    $db = getPdo();
    $sql = 'DELETE FROM `Ephemeride` WHERE `idEphemeride` = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
}

}
?>