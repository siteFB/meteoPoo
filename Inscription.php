<?php
require_once('Connexion.php');

class Inscription extends Connexion{
    public $pseudo;

public function __construct($pseudo, $email, $pass)
{
parent::__construct($email, $pass);  
$this->pseudo = $pseudo;
$pseudo = htmlentities($_POST["pseudo"]);
}

public function seconnecter()
{
    if (isset($_POST) && !empty($_POST)){        
        if(
            isset($_POST["pseudo"]) && !empty($_POST["pseudo"]) 
            && isset($_POST["email"]) && !empty($_POST["email"])           
            && isset($_POST["pass"]) && !empty($_POST["pass"])
        ){
            $pseudo = htmlentities($_POST["pseudo"]);
  
            if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                die("L'adresse mail est invalide");
            }  
            
            $pass = password_hash($_POST["pass"], PASSWORD_ARGON2ID);
 
            require_once "base/connexionBDD.php";
            
            $recupNouvelEntree = $db->prepare(" INSERT INTO `users`(`pseudo`,`email`,`pass`)
            VALUES (:pseudo, :email, :pass)");  

            $recupNouvelEntree->bindValue(':pseudo',  $_POST['pseudo']);
            $recupNouvelEntree->bindValue(':email', $_POST['email']);
            $recupNouvelEntree->bindValue(':email', $_POST['pass']);
            $recupNouvelEntree->execute();
        
            $id = $db->lastInsertId();

            $_SESSION["user"] = [
                        "id" => $id,
                        "pseudo" => $pseudo,
                        "email" => $_POST["email"],
                        "statut" => $user["statut"]
            ];            
            header("Location: formConnexion.php");
              
        }else{   //Champs vides au clic
            $_SESSION['erreur'] = "Vous devez remplir tous les champs";
            header("Location: ../accueil/index.php");

        }
    }
}
}

$nouvelInscrit = new Inscription("pseudo","email","pass");
$nouvelInscrit->seconnecter();





