<?php
session_start();

//Protéger la validation avec le bouton
if (isset($_POST['btnConnexion'])) {

if (isset($_POST) && !empty($_POST)) {
    if (
        isset($_POST["email"], $_POST["pass"])
        && !empty($_POST["email"] && !empty($_POST["pass"]))
    ) {

        require_once "../../base/connexionBDD.php"; 

        $connexionCompte = $db->prepare("SELECT * FROM `users` WHERE `email`= :email");
        $connexionCompte->bindValue(':email', $_POST['email']);
        $connexionCompte->execute();
        $user = $connexionCompte->fetch();

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            header("Location: templates/formConnexion.php");
            $_SESSION['erreur'] = "Cet utilisateur et/ou le mot de passe est incorrect";
            sleep(1);  // Contrer Force Brute: Arrêt d'1s
        }

        $pass = password_hash($_POST["pass"], PASSWORD_ARGON2ID);
       if (!password_verify($_POST["pass"], $pass)) {
        header("Location: templates/formConnexion.php");
        $_SESSION['erreur'] = "Cet utilisateur et/ou le mot de passe est incorrect";
        sleep(1);
        }

        if (!$user) {
            header("Location: templates/formConnexion.php");
            $_SESSION['erreur'] = "Cet utilisateur et/ou le mot de passe est incorrect";
            sleep(1);
        }

        if (!password_verify($_POST["pass"], $user["pass"])) {
            header("Location: templates/formConnexion.php");
            $_SESSION['erreur'] = "Cet utilisateur et/ou le mot de passe est incorrect2!";
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

        //Redirection selon le statut
        //Protéger les champs vides avec la session
        if (isset($_SESSION['user']) && $user["statut"] == "Membre") {
            header("Location: /templates/espaceMembres/espaceMembre.php");

        } elseif (isset($_SESSION['user']) && $user["statut"] == "Admin") {
            header("Location: /templates/espaceAdminister/espaceAdmin.php");
            
        } else {
            header("Location: /../templates/formConnexion.php");
            die('Vous devez remplir tous les champs');
        }
    }

//Redirection si le bouton n'est pas utilisé  
}else{
    header("Location: /../templates/formConnexion.php");
    die(); 
}
?>
