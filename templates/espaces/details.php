<?php
session_start();

if(isset($_GET['idEphemeride']) && !empty($_GET['idEphemeride'])){
    require_once('../../base/connexionBDD.php');

    $id = strip_tags(stripslashes(htmlentities(trim($_GET['idEphemeride']))));

    $sql = 'SELECT `imgTemps` FROM `Ephemeride` WHERE `idEphemeride` = :id;';

    $query = $db->prepare($sql);
    
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();

    $produit = $query->fetch();

    if(!$produit){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: consulterMeteo.php');
    }
    
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: consulterMeteo.php');
}
?>
<?php
$titre = "Espace consulter la météo: détails";
$gererTitre = "Zoom sur l'éphéméride";

include "../layout.php";
include "../header.php";
include "../espaces/bienvenu.php";
include "../buttonBack.php";
?>

<link rel="stylesheet" href="../../boot.css">

<div class="row ">
    <div class="col-4 mx-auto text-center mt-5 mb-3">
        <img src="../../images/<?php echo strip_tags(stripslashes(htmlentities(trim($produit['imgTemps'])))) ?>" style="height:60vh; width:70vh" class="pb-3 mb-5">
    </div>
</div>

<?php
include "../footer.php";
?>