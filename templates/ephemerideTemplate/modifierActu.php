<?php
include "../../traitements/ephemeride/modifierActuTraitement.php";
?>
<?php
$titre = "Espace administrateur/Gérer l'actualité";
$gererTitre = "Modifier l'éphéméride";

include "../../layout.php";
include "../../header.php";
include "../espaces/bienvenu.php";
?>

<link rel="stylesheet" href="../../boot.css">
<section>

<span class="d-flex justify-content-center">
    <h2 class="text-center mt-5 mb-5 text-primary"><?php echo strip_tags(stripslashes(htmlentities(trim($gererTitre)))) ?></h2>
    <?php
    
    if (isset($_SESSION["user"]) && ($_SESSION["user"]["statut"] == "Admin")) {

        echo "
        <div>
            <button type='button' class='btn btn-success mx-5 mt-5 '><a class='text-white' href='/templates/espaceAdminister/espaceAdmin.php'>Retour</a></button>
        </div>
               ";
    ?>
</span>

    <main class="container mb-5 w-25" id="actuE23">
        <div>
            <section>
                <?php
                if (!empty($_SESSION['erreur'])) {
                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['erreur'] . '</div>';
                    $_SESSION['erreur'] = "";
                }
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="imgTemps"></label>
                        <input type="file" id="imgTemps" name="imgTemps" class="form-control mb-2" value="../../images/'<?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride["imgTemps"])))) ?>" accept="image/png, image/jpeg, image/jpg">
                    </div>
                    <div>
                    <div>
                        <label for="fileName">Nommer l'image <i>(facultatif)</i></label><br>
                        <input type="text" id="fileName" name="fileName" class="form-control mb-4" value=""> 
                    </div>
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" id="titre" name="titre" class="form-control mb-4" placeholder="Titre" value="<?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride["titre"])))) ?>">
                    </div>
                    <div class="form-group">
                        <label for="topo">Topo</label>
                        <input type="textarea" placeholder="Topo" id="topo" name="topo" class="form-control mb-4" placeholder="Topo" value="<?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride["topo"])))) ?>">
                    </div>
                    </div>
                    <br>
                    <input type="hidden" name="idEphemeride" value="<?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride['idEphemeride'])))) ?>">
                    <button class="btn btn-primary">Modifier</button>
                </form>
            </section>
        </div>
    </main>
</section>
<?php
   } else{
        header('Location: ../../templates/formConnexion.php');
    }
?>
<?php
include "../../footer.php";
?>