<?php
require_once('../../libraries/utils/utils.php');
include "../../traitements/ephemerideCRUD/modifierActuTraitement.php";
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
    buttonBack("Modifier l'éphéméride", "Admin", "/templates/espaceAdminister/espaceAdmin.php");
    ?>
    <main class="container mb-5 w-25" id="actuE23">
        <div>
            <section>
            <?php
                if (colorMess("erreur", "danger")) {
                } elseif (colorMess("message", "success")) {
                };
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="imgTemps"></label>
                        <input type="file" id="imgTemps" name="imgTemps" class="form-control mb-2" value="../../images/'<?php echo strip_tags(stripslashes(htmlentities(trim($produit["imgTemps"])))) ?>" accept="image/png, image/jpeg, image/jpg">
                    </div>
                    <div>
                        <div>
                            <label for="fileName">Nommer l'image <i>(facultatif)</i></label><br>
                            <input type="text" id="fileName" name="fileName" class="form-control mb-4" value="">
                        </div>
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" id="titre" name="titre" class="form-control mb-4" placeholder="Titre" value="<?php echo strip_tags(stripslashes(htmlentities(trim($produit["titre"])))) ?>">
                        </div>
                        <div class="form-group">
                            <label for="topo">Topo</label>
                            <input type="textarea" placeholder="Topo" id="topo" name="topo" class="form-control mb-4" placeholder="Topo" value="<?php echo strip_tags(stripslashes(htmlentities(trim($produit["topo"])))) ?>">
                        </div>
                    </div>
                    <br>
                    <input type="hidden" name="idEphemeride" value="<?php echo strip_tags(stripslashes(htmlentities(trim($produit['idEphemeride'])))) ?>">
                    <button class="btn btn-primary">Modifier</button>
                </form>
            </section>
        </div>
    </main>
</section>

<?php
include "../../footer.php";
?>