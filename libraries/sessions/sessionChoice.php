<?php
function sess(string $role, string $path)
{

  if(isset($_SESSION["user"]) && $_SESSION["user"]["statut"] == $role) {
    
// retour à la connexion si session est false
}else {
    unset($_SESSION["user"]);
    header("Location: ". $path ."/templates/formConnexion.php/#seconnect");
    exit();
}

}
?>