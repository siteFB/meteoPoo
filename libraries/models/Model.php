<?php

require_once('../../libraries/base/connexionBDD.php');

class Model{

    protected $db;
    protected $table;
    protected $chooseId;
    protected $item;

    public function __construct()
    {
        $this->db = getPdo();
    }
    
/**
 * Delete one
 */
public function delete(int $id): void
{
    $query = $this->db->prepare("DELETE FROM {$this->table}
                                 WHERE {$this->chooseId} = :id;
                                 ");
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
}

/**
 * Afficher un seul
 */
public function showOne(int $id)
{
    $requete = $this->db->prepare("SELECT * 
                                   FROM {$this->table}
                                   WHERE {$this->chooseId} = :id;
                                   ");
    $requete->bindValue(':id', $id, PDO::PARAM_INT);
    $requete->execute();
    $item = $requete->fetch();

    return $item;
}


}