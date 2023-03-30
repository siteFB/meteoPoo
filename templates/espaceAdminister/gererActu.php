<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../..//templates/formConnexion.php");
    die();
    exit;
}

require_once('../../base/connexionBDD.php');

$sql = 'SELECT * FROM `ephemeride`';

$query = $db->prepare($sql);

$query->execute();

$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('../../base/deconnexionBDD.php');

$titre = "Espace administrateur/Gérer l'actualité";
$gererTitre = "Gérer l'éphéméride";

include "../../templates/layout.php";
include "../../templates/header.php";
include "../../templates/espaces/bienvenu.php";
?>

<link rel="stylesheet" href="../../boot.css">
<section>

<span class="d-flex justify-content-center">
    <h2 class="text-center mt-5 mb-5"><?php echo strip_tags(stripslashes(htmlentities(trim($gererTitre)))) ?></h2>
    <?php
    
    if (isset($_SESSION["user"]) && ($_SESSION["user"]["statut"] == "Admin")) {

        echo "
        <div>
            <button type='button' class='btn btn-success mx-5 mt-5 '><a class='text-white' href='/templates/espaceAdminister/espaceAdmin.php'>Retour</a></button>
        </div>
               ";
    } else{
        header('Location: ../../templates/formConnexion.php');
    }
    ?>
</span>

    <div class="container mb-5" id="actuE23">
        <?php
        if (!empty($_SESSION['erreur'])) {
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['erreur'] . '</div>';
            $_SESSION['erreur'] = "";
        }
        ?>
        <?php
        if (!empty($_SESSION['message'])) {
            echo '<div class="alert alert-success" role="alert">' . $_SESSION['message'] . '</div>';
            $_SESSION['message'] = "";
        }
        ?>

        <section>
            <div class="container mt-5">
                <div class="row">
                    <?php
                    foreach ($result as $ephemeride) {
                    ?>
                        <div class="col-md-4 mt-1 mb-5">
                            <div class="card col" style="height:550px">
                                <img src="/images/<?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride['imgTemps'])))) ?>" class="card-img-top h-100">
                                <div class="card-body" style="height:200px">
                                    <h3 class="card-title"><?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride['titre'])))) ?></h3>
                                    <p class="card-text"><?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride['topo'])))) ?></p>
                                    <a href="/traitements/ephemeride/modifierActu.php?idEphemeride=<?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride['idEphemeride'])))) ?>" class="btn btn-success active" role="button" aria-pressed="true">Modifier</a>
                                    <a onclick="return confirm('Are you sure you want to delete ?')" href="/traitements/ephemeride/deleteActu.php?idEphemeride=<?php echo strip_tags(stripslashes(htmlentities(trim($ephemeride['idEphemeride'])))) ?>" class="btn btn-danger active float-end" role="button" aria-pressed="true">Supprimer</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <a href="/traitements/ephemeride/addActu.php" class="btn btn-warning mb-5"><?php echo '&nbsp'; ?>Ajouter<?php echo '&nbsp'; ?></a>
            </div>
        <hr>
    </div>
</section>



<?php
include "../../templates/footer.php";
?>