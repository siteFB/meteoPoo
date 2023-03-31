<?php
session_start();
if (!isset($_SESSION["user"]) && $user["statut"] == "Admin") {
    header("Location: ../templates/formConnexion.php");
    exit;
}

if ($_POST) {
    if (isset($_POST['imgTemps']) && !empty($_POST['imgTemps'])
        && isset($_POST['titre']) && !empty($_POST['titre'])
        && isset($_POST['topo']) && !empty($_POST['topo'])
    ) {

        require_once('../../libraries/base/connexionBDD.php');
        require_once('../../libraries/base/deconnexionBDD.php');

        $db = getPdo();

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

        $db = deco(); 
        header('Location: /templates/ephemerideTemplate/gererActu.php');
        
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}
?>
