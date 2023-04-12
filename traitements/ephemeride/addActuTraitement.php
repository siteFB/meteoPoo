<?php
session_start();

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/sessions/sessionChoice.php');
require_once('../../libraries/base/deconnexionBDD.php');
require_once('../../libraries/utils/utils.php');
require_once('../../libraries/models/Ephemeride.php');

$model = new Ephemeride();

sess("Admin", "../../");

if ($_POST) {
    if (isset($_POST['imgTemps']) && !empty($_POST['imgTemps'])
        && isset($_POST['titre']) && !empty($_POST['titre'])
        && isset($_POST['topo']) && !empty($_POST['topo'])
    ) {

        $imgTemps = strip_tags(stripslashes(htmlentities(trim($_POST['imgTemps']))));
        $titre = strip_tags(stripslashes(htmlentities(trim($_POST['titre']))));
        $topo = strip_tags(stripslashes(htmlentities(trim($_POST['topo']))));

        $image = $_FILES['imgTemps']['name'];
        $tmp_name = $_FILES['imgTemps']['tmp_name'];
        $destination = "../../images/" . $image;
        move_uploaded_file($tmp_name, $destination);

        $model->add($imgTemps, $titre, $topo);

        $_SESSION["ephemeride"] = [
            "id" => strip_tags(stripslashes(htmlentities(trim($ephemeride["idEphemeride"])))),
            "imgTemps" => strip_tags(stripslashes(htmlentities(trim($ephemeride["imgTemps"])))),
            "titre" => strip_tags(stripslashes(htmlentities(trim($ephemeride["titre"])))),
            "topo" => strip_tags(stripslashes(htmlentities(trim($ephemeride["topo"]))))
        ];

        info("message", "L'éphéméride' est ajoutée");
        $db = deco(); 
        redirect("/templates/ephemerideTemplate/gererActu.php");
        
    } else {
        info("erreur", "Le formulaire est incomplet");
    }
}
?>
