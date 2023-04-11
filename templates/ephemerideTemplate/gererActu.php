<?php
require_once('../../libraries/utils/utils.php');
include "../../traitements/ephemeride/gererActuTraitement.php";
?>
<?php
$titre = "Espace administrateur/Gérer l'actualité";

include "../../layout.php";
include "../../header.php";
include "../espaces/bienvenu.php";
?>
<link rel="stylesheet" href="../../boot.css">

<section>
    <?php
    buttonBack("Gérer l'éphéméride", "Admin", "/templates/espaceAdminister/espaceAdmin.php");
    ?>
    <div class="container mb-5" id="actuE23">
        <?php
        if (colorMess("erreur", "danger")) {
        } elseif (colorMess("message", "success")) {
        };
        ?>
        <section>
            <div class="container mt-5">
                <div class="row">
                    <?php
                    foreach ($result as $ephemeride) :
                    ?>
                        <div class="col-md-4 mt-1 mb-5">
                            <div class="card col" style="height:550px">
                                <img src="/images/<?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride['imgTemps'])))) ?>" class="card-img-top h-100">
                                <div class="card-body" style="height:200px">
                                    <h3 class="card-title"><?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride['titre'])))) ?></h3>
                                    <p class="card-text"><?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride['topo'])))) ?></p>
                                    <a href="../ephemerideTemplate/modifierActu.php?idEphemeride=<?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride['idEphemeride'])))) ?>" class="btn btn-success active" role="button" aria-pressed="true">Modifier</a>
                                    <a onclick="return confirm('Are you sure you want to delete ?')" href="/traitements/ephemeride/deleteActu.php?idEphemeride=<?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride['idEphemeride'])))) ?>" class="btn btn-danger active float-end" role="button" aria-pressed="true">Supprimer</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach
                    ?>
                </div>
                <a href="/templates/ephemerideTemplate/addActu.php" class="btn btn-warning mb-5"><?php echo '&nbsp'; ?>Ajouter<?php echo '&nbsp'; ?></a>
            </div>
            <hr>
    </div>
</section>

<?php
include "../../footer.php";
?>