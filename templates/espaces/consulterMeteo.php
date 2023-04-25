<?php
require_once('../../libraries/utils/utils.php');
include "../../traitements/ephemerideConsulter/lireMeteoTraitement.php";
?>

<?php
$titre = "Consulter la météo";

include "../../layout.php";
include "../../header.php";
include "../espaces/bienvenu.php";
?>
<link rel="stylesheet" href="../../boot.css">

<h2 class="display-5 fw-bold text-center mb-5 mt-5">Éphéméride</h2>
<?php  // Boutons retour selon profil
if (isset($_SESSION['user']) && $_SESSION['user']['statut'] == "Membre") {
    buttonBack("Consulter la météo", "Membre", "/templates/espaceMembres/espaceMembre.php");

} elseif (isset($_SESSION['user']) && $_SESSION['user']['statut'] == "Admin") {
    buttonBack("Consulter la météo", "Admin", "/templates/espaceAdminister/espaceAdmin.php");
}
?>
<div class="container">
    <div class="row mb-5">
        <?php
        foreach ($result as $ephemeride) {
        ?>
            <div class="col-md-4 mb-5">
                <div class="card col h-100">
                    <img src="/images/<?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride['imgTemps'])))) ?>" class="card-img-top h-100">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride['titre'])))) ?></h3>
                        <p class="card-text"><?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride['topo'])))) ?></p>
                        <button type="button" class="btn btn-primary" style="float:left;"><a class="text-white" href="detailsEphemeride.php?idEphemeride=<?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride['idEphemeride'])))) ?>">Consulter</a></button>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<?php
include "../../footer.php";
?>