<?php

/**
 * Return a database connection
 * 
 * @return PDO
 */
function getPdo(): PDO
{
    $servername = "localhost";
    $database = "meteoPoo";
    $username = "root";
    $password = "";

    try {
        $db = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        echo "erreur de connexion:" . $e->getMessage();
        die();

        return $db;
    };
}

/*  Inscrits  */

/**
 * Return la liste des inscrits: visible pour l'admin (read only, here)
 * 
 */
function seeInscrits()
{
    $db = getPdo();
    $sql = 'SELECT * FROM `users`';
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

/*  Éphéméride  */

/**
 * Return CRUD éphéméride: modifier
 * 
 */
function modifierActu(int $id, string $image, string $titre, string $topo)
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
 * Afficher toutes les éphémérides: read
 * 
 */
function showActu()
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
 * 
 */
function showOneActu(int $id)
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
 * Return CRUD éphéméride: delete
 * 
 */
function deleteEphemeride(int $id): void
{
    $db = getPdo();
    $sql = 'DELETE FROM `Ephemeride` WHERE `idEphemeride` = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
}


/**
 * Return CRUD éphéméride: create
 * 
 */
function addEphemeride(string $imgTemps, string $titre, string $topo)
{
    $db = getPdo();
    $sql = 'INSERT INTO `ephemeride`(`imgTemps`, `titre`, `topo`) VALUES (:imgTemps, :titre, :topo);';
    $query = $db->prepare($sql);
    $query->bindValue(':imgTemps', $imgTemps, PDO::PARAM_STR);
    $query->bindValue(':titre', $titre, PDO::PARAM_STR);
    $query->bindValue(':topo', $topo, PDO::PARAM_STR);

    $query->execute();
}

/*  Messages box */

/**
 * Récupérer et afficher un seul message
 * 
 */
function oneMess(int $id)
{
    $db = getPdo();
    $requete = $db->prepare('SELECT * FROM messagerie WHERE idMessagerie = :id; ');
    $requete->bindValue(':id', $id, PDO::PARAM_INT);
    $requete->execute();
    $resultat = $requete->fetch();

    return $resultat;
}

/**
 * Récupérer et compter et ranger par date tous les messages reçus
 * 
 */
function readAllMess(int $id_destinataire)
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
 * Supprimer un message
 * 
 */
function deleteMess(int $id)
{
    $db = getPdo();
    $sql = 'DELETE FROM messagerie WHERE idMessagerie = :id;';
    $requete = $db->prepare($sql);
    $requete->bindValue(':id', $id, PDO::PARAM_INT);
    $requete->execute();

    
}

/** 
 * Lire et compter tous les messages d'un seul destinataire
 * 
 */
function readOneMess(int $id, int $id_destinataire)
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
 * Récupérer le pseudo et l'id du destinataire
 * 
 */
function pseudoDest(string $destinataire)
{
    $db = getPdo();
            $id_destinataire = $db->prepare('SELECT idUser FROM users WHERE pseudo = :destinataire');
            $id_destinataire->bindValue(':destinataire', $destinataire, PDO::PARAM_STR);
            $id_destinataire->execute();


}


?>