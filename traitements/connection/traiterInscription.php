<?php
session_start();
require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/utils/utils.php');
require_once('../../libraries/models/Inscription.php');

if (isset($_POST) && !empty($_POST)){
        if(
            isset($_POST["pseudo"]) && !empty($_POST["pseudo"]) 
            && isset($_POST["email"]) && !empty($_POST["email"])           
            && isset($_POST["pass"]) && !empty($_POST["pass"])
        ){
            $pseudo = trim($_POST["pseudo"]);
            $pseudo = strip_tags($_POST["pseudo"]); 
            $pseudo = stripslashes($_POST["pseudo"]);
            $pseudo = htmlentities($_POST["pseudo"]);
  
            if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                die("L'adresse mail est invalide");
            }  
            
            $email = htmlentities($_POST["email"]);

            $pass = password_hash($_POST["pass"], PASSWORD_ARGON2ID);
           
            [$recupNouvelEntree, $db] = sinscrire($pass, $pseudo, $email);
        
            $id = $db->lastInsertId();

            $_SESSION["user"] = [
                        "id" => $id,
                        "pseudo" => $pseudo,
                        "email" => $_POST["email"],
                        "statut" => $user["statut"]
            ];            
            redirect("../../templates/formConnexion.php");
              
        }else{   //Champs vides au clic
            info("erreur", "Vous devez remplir tous les champs");
            redirect("../../templates/index.php");
        }
    }
?>