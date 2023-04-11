<?php
session_start();

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/sessions/sessionChoice.php');
require_once('../../libraries/base/deconnexionBDD.php');
require_once('../../libraries/utils/utils.php');

sess("Admin", "../../");

if (isset($_SESSION['user']['id']) and !empty($_SESSION['user']['id'])) {
    if (isset($_POST['envoimessage'])) {
        if (
            isset($_POST['destinataire']) && !empty($_POST['destinataire'])
            && isset($_POST['titreMessage']) && !empty($_POST['titreMessage'])
            && isset($_POST['mesage']) && !empty($_POST['mesage'])
        ) {

            $id_expediteur = $_SESSION['user']['id'];
            $destinataire = htmlspecialchars($_POST['destinataire']);
            $titreMessage = htmlspecialchars($_POST['titreMessage']);
            $mesage = htmlspecialchars($_POST['mesage']);

            // Récupérer le pseudo du destinataire
            $id_destinataire = pseudoDest($destinataire);

            // Protéger l'injection d'un id inexistant dans l'URL
            $dest_exist = $id_destinataire->rowCount();
            if ($dest_exist == 1) {
                // Récupérer l'ID du destinataire puisqu'il existe
                $id_destinataire = $id_destinataire->fetch();
                $id_destinataire = $id_destinataire['idUser'];

                // Stocker le message dans la BDD
                sendMess($id_destinataire, $titreMessage, $mesage);

                info("message", "Votre message a bien été envoyé");
                $db = deco();
            } else {
                $_SESSION['erreur'] = "Ce destinataire n'existe pas";
                $db = deco();
            }
        } else {
            info("erreur", "Le formulaire est incomplet");
            $db = deco();
        }
    }
}
?>
