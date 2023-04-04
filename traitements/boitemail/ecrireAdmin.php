<?php
session_start();

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/sessions/sessionChoice.php');
require_once('../../libraries/base/deconnexionBDD.php');
require_once('../../libraries/utils/utils.php');

sess("Admin", "../../");

$db = getPdo();

if (isset($_SESSION['user']['id']) and !empty($_SESSION['user']['id'])) {
    if (isset($_POST['envoimessage'])) {
        if (
            isset($_POST['destinataire']) && !empty($_POST['destinataire'])
            && isset($_POST['titreMessage']) && !empty($_POST['titreMessage'])
            && isset($_POST['message']) && !empty($_POST['message'])
        ) {

            $destinataire = htmlspecialchars($_POST['destinataire']);
            $titreMessage = htmlspecialchars($_POST['titreMessage']);
            $message = htmlspecialchars($_POST['message']);

            // Récupérer le pseudo...
            $id_destinataire = $db->prepare('SELECT idUser FROM users WHERE pseudo = ?');
            $id_destinataire->execute(array($destinataire));

            // Protéger l'injection dans l'URL
            $dest_exist = $id_destinataire->rowCount();
            if ($dest_exist == 1) {
                // ... et récupérer l'ID
                $id_destinataire = $id_destinataire->fetch();
                $id_destinataire = $id_destinataire['idUser'];


                // Insérer le message: faire une requête
                $ins = $db->prepare('INSERT INTO messagerie(id_expediteur, id_destinataire, titreMessage, mesage) VALUES (?, ?, ?, ?)');
                $ins->execute(array($_SESSION['user']['id'], $id_destinataire, $titreMessage, $message));

                info("message", "Votre message a bien été envoyé");
                $db = deco();
                
                redirect("msgEcrireAdmin.php");

            } else {
                info("erreur", "Ce destinataire n'existe pas");
            }
        } else {
            info("erreur", "Le formulaire est incomplet");
        }
    }

    // La requête
    $destinataires = $db->query('SELECT pseudo FROM users ORDER BY pseudo');
}
?>