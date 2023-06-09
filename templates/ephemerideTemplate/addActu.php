<?php
require_once('../../libraries/utils/utils.php');
include "../../traitements/ephemerideCRUD/addActuTraitement.php";
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
    buttonBack("Ajouter une éphéméride", "Admin", "/templates/espaceAdminister/espaceAdmin.php");
    ?>
    <main class="container mb-5 w-25" id="actuE23">
        <div>
            <section>
            <?php
                if (colorMess("erreur", "danger")) {
                } elseif (colorMess("message", "success")) {
                };
                ?>
                <form action="/traitements/ephemerideCRUD/addActuTraitement.php" method="post">
                    <div class="form-group">
                        <label for="imgTemps"></label>
                        <input type="file" id="imgTemps" name="imgTemps" class="form-control" placeholder="image" value="<?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride['imgTemps'])))) ?>">
                    </div>
                    <div class="form-group">
                        <label for="titre"></label>
                        <input type="text" id="titre" name="titre" class="form-control" placeholder="titre">
                    </div>
                    <div class="form-group">
                        <label for="topo"></label>
                        <input type="textarea" id="topo" name="topo" class="form-control" placeholder="topo">
                    </div>
                    <br>
                    <input type="hidden" name="idEphemeride" value="<?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride['idEphemeride'])))) ?>">
                    <button class="submit btn btn-primary">Ajouter</button>
                </form>
            </section>
        </div>
    </main>
</section>

<?php
include "../../footer.php";
?>