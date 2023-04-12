<?php

require_once('../../libraries/models/model.php');

class Connexion extends Model{

/**
 * Connexion
 */
public function seconnecter()
{
    $connexionCompte = $this->db->prepare("SELECT * FROM `users` WHERE `email`= :email");
    $connexionCompte->bindValue(':email', $_POST['email']);
    $connexionCompte->execute();
    $user = $connexionCompte->fetch();

    return $user;
}
}