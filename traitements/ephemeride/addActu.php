<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../../templates/formConnexion.php");
    exit;
}

if ($_POST) {
    if (isset($_POST['imgTemps']) && !empty($_POST['imgTemps'])
        && isset($_POST['titre']) && !empty($_POST['titre'])
        && isset($_POST['topo']) && !empty($_POST['topo'])
    ) {

        require_once('../../base/connexionBDD.php');

        $imgTemps = strip_tags(stripslashes(htmlentities(trim($_POST['imgTemps']))));
        $titre = strip_tags(stripslashes(htmlentities(trim($_POST['titre']))));
        $topo = strip_tags(stripslashes(htmlentities(trim($_POST['topo']))));

        $image = $_FILES['imgTemps']['name'];
        $tmp_name = $_FILES['imgTemps']['tmp_name'];
        $destination = "../../images/" . $image;
        move_uploaded_file($tmp_name, $destination);
        //echo $image;

        $sql = 'INSERT INTO `ephemeride`(`imgTemps`, `titre`, `topo`) VALUES (:imgTemps, :titre, :topo);';

        $query = $db->prepare($sql);

        $query->bindValue(':imgTemps', $imgTemps, PDO::PARAM_STR);
        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':topo', $topo, PDO::PARAM_STR);

        $query->execute();

        $_SESSION["ephemeride"] = [
            "id" => strip_tags(stripslashes(htmlentities(trim($ephemeride["idEphemeride"])))),
            "imgTemps" => strip_tags(stripslashes(htmlentities(trim($ephemeride["imgTemps"])))),
            "titre" => strip_tags(stripslashes(htmlentities(trim($ephemeride["titre"])))),
            "topo" => strip_tags(stripslashes(htmlentities(trim($ephemeride["topo"]))))
        ];

        $_SESSION['message'] = "L'éphéméride' est ajoutée";
        require_once('../../base/deconnexionBDD.php');
        header('Location: /templates/espaceAdminister/gererActu.php');
        
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }

}
?>

<?php
$titre = "Espace administrateur/Gérer l'actualité";
$gererTitre = "Ajouter une éphéméride";

include "../../templates/layout.php";
include "../../templates/header.php";
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
    } else{
        header('Location: ../../templates/formConnexion.php');
    }
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
include "../../templates/footer.php";
?>