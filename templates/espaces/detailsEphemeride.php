<?php
require_once('../../libraries/utils/utils.php');
include "../../traitements/ephemeride/detailsEphemerideTraitement.php";
?>

<?php
$titre = "Espace consulter la météo: détails";

include "../../layout.php";
include "../../header.php";
include "../espaces/bienvenu.php";
?>
<link rel="stylesheet" href="../../boot.css">

<?php
if (isset($_SESSION['user']) && $_SESSION['user']['statut'] == "Membre") {
    buttonBack("Zoom sur l'éphéméride", "Membre", "/templates/espaceMembres/espaceMembre.php");

} elseif (isset($_SESSION['user']) && $_SESSION['user']['statut'] == "Admin") {
    buttonBack("Zoom sur l'éphéméride", "Admin", "/templates/espaceAdminister/espaceAdmin.php");
}
  ?>
<div class="row ">
    <div class="col-4 mx-auto text-center mt-5 mb-3">
        <img src="../../images/<?php echo strip_tags(stripslashes(htmlentities(trim($produit['imgTemps'])))) ?>" style="height:60vh; width:70vh" class="pb-3 mb-5">
    </div>
</div>

<?php
include "../../footer.php";
?>