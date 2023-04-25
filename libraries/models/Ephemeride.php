<?php

namespace Models;

require_once('../../libraries/models/Model.php');

class Ephemeride extends Model
{

    protected $table = 'Ephemeride';
    protected $chooseId = 'idEphemeride';
    protected $item = '$produit';
    protected $chooseFetch = 'fetchAll';
    protected $return = '$result';

    /**
     * Return CRUD éphéméride: create
     */
    public function add(string $imgTemps, string $titre, string $topo)
    {
        $sql = 'INSERT INTO `ephemeride`(`imgTemps`, `titre`, `topo`)
            VALUES (:imgTemps, :titre, :topo);';
        $query = $this->db->prepare($sql);
        $query->bindValue(':imgTemps', $imgTemps);
        $query->bindValue(':titre', $titre);
        $query->bindValue(':topo', $topo);

        $query->execute();
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
        $query->bindValue(':id', $id);
        $query->bindValue(':imgTemps', $image);
        $query->bindValue(':titre', $titre);
        $query->bindValue(':topo', $topo);

        $query->execute();
    }

    /**
     * Return CRUD éphéméride: read all
     */
    public function afficherTout()
    {
        require_once('../../libraries/base/connexionBDD.php');
        $sql = 'SELECT * FROM `ephemeride`';

        $query = $this->db->prepare($sql);
        
        $query->execute();
        
        $result = $query->fetchAll($this->db::FETCH_ASSOC);

        return $result; 
    }


}
