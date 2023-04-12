<?php

require_once('../../libraries/base/connexionBDD.php');

class Connexion{

/**
 * Connexion
 */
public function seconnecter()
{
    $db = getPdo();
    $connexionCompte = $db->prepare("SELECT * FROM `users` WHERE `email`= :email");
    $connexionCompte->bindValue(':email', $_POST['email']);
    $connexionCompte->execute();
    $user = $connexionCompte->fetch();

    return $user;
}
}