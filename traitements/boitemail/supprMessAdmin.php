<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../templates/formConnexion.php");
    die();
}

    if(isset($_GET['idUser']) && !empty($_GET['idUser'])){
        require_once('../../base/connexionBDD.php');
    
        $id = strip_tags($_GET['idUser']);

$requete = $db->prepare('SELECT * FROM messagerie WHERE idMessagerie = :id; ');

$requete->bindValue(':id', $id, PDO::PARAM_INT);

$requete->execute();

$resultat = $requete->fetch();

echo '<pre>';
print_r($resultat);
echo '</pre>';

if(!$resultat){
    $_SESSION['erreur'] = "Cet id n'existe pas";
    header('Location: ../../traitements/boitemail/recusAdmin.php');
    die();
}

$sql = 'DELETE FROM messagerie WHERE idMessagerie = :id;';

$requete = $db->prepare($sql);

$requete->bindValue(':id', $id, PDO::PARAM_INT);

$requete->execute();

$_SESSION['message'] = "Message supprimé";
header('Location: ../../traitements/boitemail/recusAdmin.php');

}else{
$_SESSION['erreur'] = "URL invalide";
header('Location: ../../traitements/boitemail/recusAdmin.php');
}

?>

