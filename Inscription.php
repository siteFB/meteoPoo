<?php
class inscription{
    public $pseudo;
    protected $email;
    protected $pass;

public function __construct($pseudo, $email, $pass)
{
$this->pseudo = $pseudo;
$pseudo = trim($_POST["pseudo"]);
$pseudo = strip_tags($_POST["pseudo"]); 
$pseudo = stripslashes($_POST["pseudo"]);
$pseudo = htmlentities($_POST["pseudo"]);                      var_dump($pseudo);
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
  }else{
    throw new exception("Email incorrect");
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
return $this->email;                                           var_dump($email);
}

public function getPass($pass)
{
return $this->pass;                                            var_dump($pass);
}

public function sinscrire()
{
    if (isset($_POST) && !empty($_POST)){ 
    require_once "base/connexionBDD.php";         
    $recupNouvelEntree = $db->prepare(" INSERT INTO `users`(`pseudo`,`email`,`pass`)
    VALUES (:pseudo, :email, :pass)");  
    $recupNouvelEntree->bindValue(':pseudo', $_POST["pseudo"]);
    $recupNouvelEntree->bindValue(':email', $_POST['email']);
    $recupNouvelEntree->bindValue(':pass', $_POST['pass']);
    $recupNouvelEntree->execute();
    header("Location: formConnexion.php");
              
}else{
    $_SESSION['erreur'] = "Vous devez remplir tous les champs";
    header("Location: index.php");
}
}
}

$nouvelInscrit = new Inscription("pseudo","email","pass" );
$nouvelInscrit->sinscrire();





