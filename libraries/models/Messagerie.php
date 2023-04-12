<?php

require_once('../../libraries/base/connexionBDD.php');

class Message{


/** 
 * Récupérer le pseudo et l'id du destinataire du message
 */
public function pseudoDest(string $destinataire)
{
    $db = getPdo();
            $id_destinataire = $db->prepare('SELECT idUser FROM users WHERE pseudo = :destinataire');
            $id_destinataire->bindValue(':destinataire', $destinataire, PDO::PARAM_STR);
            $id_destinataire->execute();

            return $id_destinataire;
}

/** 
 * Envoyer un message: stocker dans la BDD
 */
public function send(int $id_destinataire, string $titreMessage, string $mesage)
{
    $db = getPdo();
    $ins = $db->prepare('INSERT INTO messagerie(id_expediteur, id_destinataire, titreMessage, mesage)
    VALUES (:id_expediteur, :id_destinataire, :titreMessage, :mesage)');

$ins->bindValue(':id_expediteur', $_SESSION['user']['id'], PDO::PARAM_INT);
$ins->bindValue(':id_destinataire', $id_destinataire, PDO::PARAM_INT);
$ins->bindValue(':titreMessage', $titreMessage, PDO::PARAM_STR);
$ins->bindValue(':mesage', $mesage, PDO::PARAM_STR);
$ins->execute();
}

/**
 * Récupérer et compter et ranger par date et lire tous les messages reçus
 */
public function readAll(int $id_destinataire)
{
    $db = getPdo();
    $msg = $db->prepare("SELECT  pseudo, idMessagerie, id_expediteur, titreMessage, dateMess 
                         FROM `messagerie`
                         LEFT JOIN users
                         ON users.idUser = messagerie.id_expediteur
                         WHERE `id_destinataire` = :id_destinataire 
                         ORDER BY dateMess
                         DESC
                     ");
    $msg->bindValue(':id_destinataire', $id_destinataire, PDO::PARAM_INT);
    $msg->execute();
    $msg_nbr = $msg->rowCount();
    $msg->fetch();

return [$msg, $msg_nbr];
}

/**
 * Récupérer et afficher un seul message
 */
public function oneMess(int $id)
{
    $db = getPdo();
    $requete = $db->prepare('SELECT * FROM messagerie WHERE idMessagerie = :id; ');
    $requete->bindValue(':id', $id, PDO::PARAM_INT);
    $requete->execute();
    $resultat = $requete->fetch();

    return $resultat;
}

/** 
 * Lire et compter tous les messages d'un seul destinataire
 */
public function readOnlyOne(int $id, int $id_destinataire)
{
    $db = getPdo();
    $msg = $db->prepare('SELECT pseudo, titreMessage, idMessagerie, mesage, dateMess
                         FROM messagerie
                         LEFT JOIN users
                         ON users.idUser = messagerie.id_expediteur
                         WHERE messagerie.id_expediteur = :idUser AND id_destinataire = :id_destinataire
                         ORDER BY dateMess
                         DESC
                         ');
    $msg->bindValue(':idUser', $id, PDO::PARAM_INT);
    $msg->bindValue(':id_destinataire', $id_destinataire, PDO::PARAM_INT);
    $msg->execute();
    $msg_nbr = $msg->rowCount();
    $resultat = $msg->fetchAll(PDO::FETCH_ASSOC);

    return [$msg_nbr, $resultat];
}

/**
 * Supprimer un message
 */
public function delete(int $id)
{
    $db = getPdo();
    $sql = 'DELETE FROM messagerie WHERE idMessagerie = :id;';
    $requete = $db->prepare($sql);
    $requete->bindValue(':id', $id, PDO::PARAM_INT);
    $requete->execute();   
}



}