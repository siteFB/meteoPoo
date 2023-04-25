<?php

namespace Controllers;

session_start();

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/sessions/sessionChoice.php');
require_once('../../libraries/controllers/ControllerMail.php');
require_once('../../libraries/base/deconnexionBDD.php');
require_once('../../libraries/utils/utils.php');
require_once('../../libraries/models/Messagerie.php');

class MailerMembre extends ControllerMail{

    protected $modelName = \Models\Message::class;

    //Consulter un message
    public function zoom(){
    
    sess("Membre", "../../");
    
    if (isset($_GET['idUser']) && !empty($_GET['idUser'])) {
    
        $id = strip_tags(stripslashes(htmlentities(trim($_GET['idUser']))));
        $id_destinataire = strip_tags(stripslashes(htmlentities(trim($_SESSION['user']['id']))));
    
        [$msg_nbr, $resultat] = $this->model->readOnlyOne($id, $id_destinataire);
        return [$msg_nbr];

        if (!$resultat) {
            info("erreur", "Cet id n'existe pas");
            redirect("/templates/boitemailTemplate/msgRecusMembre.php");
        }
    }
}

    //Ecrire un message
    public function write(){

        sess("Membre", "../../");
        
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
                    $id_destinataire = $this->model->pseudoDest($destinataire);
        
                    // Protéger l'injection d'un id inexistant dans l'URL
                    $dest_exist = $id_destinataire->rowCount();
                    if ($dest_exist == 1) {
                        // Récupérer l'ID du destinataire puisqu'il existe
                        $id_destinataire = $id_destinataire->fetch();
                        $id_destinataire = $id_destinataire['idUser'];
        
                        // Stocker le message dans la BDD
                        $this->model->send($id_destinataire, $titreMessage, $mesage);
        
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
    }

    //Recevoir/lire un message
    public function receive(){
    sess("Membre", "../../");

    if (isset($_SESSION['user']['id']) and !empty($_SESSION['user']['id'])) {
    
        $id_destinataire = strip_tags($_SESSION['user']['id']);
    
        [$msg, $msg_nbr] = $this->model->readAll($id_destinataire);
    }
    
    if ($msg_nbr == 0) {
        $_SESSION['message'] = "Vous n'avez aucun message";
    }
    }

    //Supprimer un message
    public function supprimer(){
    sess("Membre", "../../");

    if (isset($_GET['idUser']) && !empty($_GET['idUser'])) {
        $id = strip_tags($_GET['idUser']);
    
        $resultat = $this->model->showOne($id);
    
        if (!$resultat) {
            info("erreur", "Cet id n'existe pas");
            redirect("../../templates/boitemailTemplate/msgRecusMembre.php");
        }
    
        $this->model->delete($id);
    
        info("message", "Message supprimé");
        redirect("../../templates/boitemailTemplate/msgRecusMembre.php");
    } else {
        info("erreur", "URL invalide");
        redirect("../../templates/boitemailTemplate/msgRecusMembre.php");
    }
    }

}
