<?php

require_once('../../libraries/models/model.php');

class Ephemeride extends Model{

    protected $table = 'Ephemeride';
    protected $chooseId = 'idEphemeride';
    protected $item = '$produit';

/**
 * Return CRUD éphéméride: create
 */
public function add(string $imgTemps, string $titre, string $topo)
{
    $sql = 'INSERT INTO `ephemeride`(`imgTemps`, `titre`, `topo`)
            VALUES (:imgTemps, :titre, :topo);';
    $query = $this->db->prepare($sql);
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
    $sql = 'SELECT *
            FROM `ephemeride`';
    $query = $this->db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

/**
 * Return CRUD éphéméride: upload
 */
public function modifier(int $id, string $image, string $titre, string $topo)
{
    $sql = 'UPDATE `ephemeride`
            SET `imgTemps`=:imgTemps, `titre`=:titre, `topo`=:topo
            WHERE `idEphemeride`=:id;';
    $query = $this->db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->bindValue(':imgTemps', $image, PDO::PARAM_STR);
    $query->bindValue(':titre', $titre, PDO::PARAM_STR);
    $query->bindValue(':topo', $topo, PDO::PARAM_STR);

    $query->execute();
}

}
?>