<?php
session_start();
require_once('../../base/connexionBDD.php');

$sql = 'SELECT * FROM `ephemeride`';
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('../../base/deconnexionBDD.php');

$titre = "Consulter la météo";
$gererTitre = "Consulter l'éphéméride";

include "../layout.php";
include "../header.php";
include "../espaces/bienvenu.php";
include "../buttonBack.php";
?>

<link rel="stylesheet" href="../../boot.css">

<h2 class="display-5 fw-bold text-center mb-5 mt-5">Éphéméride</h2>
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
                        <button type="button" class="btn btn-primary" style="float:left;"><a class="text-white" href="details.php?idEphemeride=<?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride['idEphemeride'])))) ?>">Consulter</a></button>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<?php
include "../footer.php";
?>