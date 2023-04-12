<?php
session_start();
require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/utils/utils.php');
require_once('../../libraries/models/Connexion.php');

$model = new Connexion();

// Protect validation with button
if (isset($_POST['btnConnexion'])) {

if (isset($_POST) && !empty($_POST)) {
    if (
        isset($_POST["email"], $_POST["pass"])
        && !empty($_POST["email"] && !empty($_POST["pass"]))
    ) {      

        $user = $model->seconnecter();


        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            info("erreur", "Cet utilisateur et/ou le mot de passe est incorrect");  // Blur messages
            redirect("../../templates/formConnexion.php");
            sleep(1);  // Protect against"Force Brute": Stop for 1s
        }

        $pass = password_hash($_POST["pass"], PASSWORD_ARGON2ID);   // Create and secure password
       if (!password_verify($_POST["pass"], $pass)) {
        info("erreur", "Cet utilisateur et/ou le mot de passe est incorrect");
        redirect("../../templates/formConnexion.php");
        sleep(1);
        }

        if (!$user) {
            info("erreur", "Cet utilisateur et/ou le mot de passe est incorrect");
            redirect("../../templates/formConnexion.php");
            sleep(1);
        }

        if (!password_verify($_POST["pass"], $user["pass"])) {  // Verify password
            info("erreur", "Cet utilisateur et/ou le mot de passe est incorrect!");
            redirect("../../templates/formConnexion.php");
            sleep(1);
        }

        $_SESSION["user"] = [
            "id" => $user["idUser"],
            "pseudo" => $user["pseudo"],
            "email" => $user["email"],
            "dateInscrit" => $user["dateInscrit"],
            "statut" => $user["statut"]
        ];      
    }
        // Redirect according to status & Protect empty fields with session
        if (isset($_SESSION['user']) && $user["statut"] == "Membre") {
            redirect("../../templates/espaceMembres/espaceMembre.php");

        } elseif (isset($_SESSION['user']) && $user["statut"] == "Admin") {
            redirect("../../templates/espaceAdminister/espaceAdmin.php");
            
        } else {
            redirect("../../templates/formConnexion.php");
            sleep(1); // & blurry message
        }
    }

// Bouton obligatoire
}else{
    redirect("../../templates/formConnexion.php");
}
?>
