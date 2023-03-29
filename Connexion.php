<?php

class Connexion{
    protected $email;
    protected $pass;


public function __construct($email, $pass)
{
$this->setEmail ($email);
$this->setPass ($pass);
}

public function setEmail($email)
{
  if(isset($_POST["email"]) && !empty($_POST["email"])
  ){
    if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        $this->email = $email;
    }else{
        throw new exception("Email incorrect");}
  }
}

public function setPass($pass)
{
    if(isset($_POST["pass"]) && !empty($_POST["pass"])
    ){
    $pass = password_hash($_POST["pass"], PASSWORD_ARGON2ID);
    $this->pass = $pass;
}
}

public function getEmail($email)
{
return $this->email;
}

public function getPass($pass)
{
return $this->pass;
}

public function seconnecter()
{
    if (isset($_POST['btnConnexion'])) {

        if (isset($_POST) && !empty($_POST)) {
            if (
                isset($_POST["email"], $_POST["pass"])
                && !empty($_POST["email"] && !empty($_POST["pass"]))
            ) {
        
                require_once "base/connexionBDD.php"; 
        
                $connexionCompte = $db->prepare("SELECT * FROM `users` WHERE `email`= :email");
                $connexionCompte->bindValue(':email', $_POST['email']);
                $connexionCompte->execute();
                $user = $connexionCompte->fetch();
        
                if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    header("Location: formConnexion.php");
                    $_SESSION['erreur'] = "Cet utilisateur et/ou le mot de passe est incorrect";
                    sleep(1);
                }
        
                $pass = password_hash($_POST["pass"], PASSWORD_ARGON2ID);
               if (!password_verify($_POST["pass"], $pass)) {
                header("Location: formConnexion.php");
                $_SESSION['erreur'] = "Cet utilisateur et/ou le mot de passe est incorrect";
                sleep(1);
                }
        
                if (!$user) {
                    header("Location: formConnexion.php");
                    $_SESSION['erreur'] = "Cet utilisateur et/ou le mot de passe est incorrect";
                    sleep(1);
                }
        
                if (!password_verify($_POST["pass"], $user["pass"])) {
                    header("Location: formConnexion.php");
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
        
                if (isset($_SESSION['user']) && $user["statut"] == "Membre") {
                    header("Location: ../espaces/espaceMembres/espaceMembre.php");
        
                } elseif (isset($_SESSION['user']) && $user["statut"] == "Admin") {
                    header("Location: ../espaces/espaceAdminister/espaceAdmin.php");
                    
                } else {
                    header("Location: formConnexion.php");
                    die('Vous devez remplir tous les champs');
                }
            }
         
        }else{
            header("Location: formConnexion.php");
            die(); 
        }
}

}

$connect = new Connexion("email","pass");
$connect->seconnecter();




