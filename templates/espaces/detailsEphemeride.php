<?php
include "../../traitements/ephemeride/detailsEphemerideTraitement.php";
?>

<?php
$titre = "Espace consulter la météo: détails";
$gererTitre = "Zoom sur l'éphéméride";

include "../../layout.php";
include "../../header.php";
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
include "../../footer.php";
?>