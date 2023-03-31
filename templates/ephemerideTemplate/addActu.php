<?php
include "../../traitements/ephemeride/addActuTraitement.php";
?>
<?php
$titre = "Espace administrateur/Gérer l'actualité";
$gererTitre = "Ajouter une éphéméride";

include "../../layout.php";
include "../../header.php";
include "../espaces/bienvenu.php";
?>

<link rel="stylesheet" href="../../boot.css">
<section>

<span class="d-flex justify-content-center mt-5">
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
                <form action="" method="post">
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
}else{
        header('Location: ../../templates/formConnexion.php');
    }
    ?>
<?php
include "../../footer.php";
?>