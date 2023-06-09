<?php

namespace Models;

require_once('../../libraries/models/model.php');

class Message extends Model
{

    protected $table = 'messagerie';
    protected $chooseId = 'idMessagerie';
    protected $item = '$resultat';

    /**
     * Récupérer le pseudo et l'id du destinataire du message
     */
    public function pseudoDest(string $destinataire)
    {
        $id_destinataire = $this->db->prepare('SELECT idUser
                                                   FROM users
                                                   WHERE pseudo = :destinataire
                                                   ');
        $id_destinataire->bindValue(':destinataire', $destinataire);
        $id_destinataire->execute();

        return $id_destinataire;
    }

    /** 
     * Envoyer un message: stocker dans la BDD
     */
    public function send(int $id_destinataire, string $titreMessage, string $mesage)
    {
        $ins = $this->db->prepare('INSERT INTO messagerie(id_expediteur, id_destinataire, titreMessage, mesage)
                               VALUES (:id_expediteur, :id_destinataire, :titreMessage, :mesage)
                               ');

        $ins->bindValue(':id_expediteur', $_SESSION['user']['id']);
        $ins->bindValue(':id_destinataire', $id_destinataire);
        $ins->bindValue(':titreMessage', $titreMessage);
        $ins->bindValue(':mesage', $mesage);
        $ins->execute();
    }

    /**
     * Récupérer et compter et ranger par date et lire tous les messages reçus
     */
    public function readAll(int $id_destinataire)
    {
        $msg = $this->db->prepare("SELECT pseudo, idMessagerie, id_expediteur, titreMessage, dateMess 
                         FROM users
                         LEFT JOIN messagerie
                         ON users.idUser = messagerie.id_expediteur
                         WHERE id_destinataire = :id_destinataire 
                         ORDER BY dateMess
                         DESC;
                     ");
        $msg->bindValue(':id_destinataire', $id_destinataire);
        $msg->execute();
        $msg->fetch();
        $msg_nbr = $msg->rowCount();
        
        return [$msg, $msg_nbr];
    }

    /** 
     * Lire et compter tous les messages d'un seul destinataire
     */
    public function readOnlyOne(int $id, int $id_destinataire)
    {
        $msg = $this->db->prepare('SELECT pseudo, titreMessage, idMessagerie, mesage, dateMess
                         FROM messagerie
                         LEFT JOIN users
                         ON users.idUser = messagerie.id_expediteur
                         WHERE id_destinataire = :id_destinataire
                         AND messagerie.id_expediteur = :idUser
                         ORDER BY dateMess
                         DESC
                         ');
        $msg->bindValue(':idUser', $id);
        $msg->bindValue(':id_destinataire', $id_destinataire);
        $msg->execute();
        $msg_nbr = $msg->rowCount();
        $resultat = $msg->fetchAll();

        return [$msg_nbr, $resultat];
    }
}
