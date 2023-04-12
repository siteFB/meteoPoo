<?php

require_once('../../libraries/base/connexionBDD.php');

class Inscription{

/**
 * Inscription
 */
public function sinscrire(string $pass, string $pseudo, string $email)
{
    $db = getPdo();
    $recupNouvelEntree = $db->prepare(" INSERT INTO `users`(`pseudo`,`email`,`pass`)
    VALUES (:pseudo, :email, '$pass')");  
    $recupNouvelEntree->bindValue(':pseudo', $pseudo);
    $recupNouvelEntree->bindValue(':email', $email);
    $recupNouvelEntree->execute();
    return [$recupNouvelEntree, $db];
}
}
