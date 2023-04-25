<?php

namespace Controllers;

require_once('../../libraries/base/connexionBDD.php');
require_once('../../libraries/sessions/sessionChoice.php');
require_once('../../libraries/controllers/ControllerEphemeride.php');
require_once('../../libraries/base/deconnexionBDD.php');
require_once('../../libraries/models/Ephemeride.php');
require_once('../../libraries/utils/utils.php');

class EphemerideCRUD extends ControllerEphemeride{

    protected $modelName = \Models\Ephemeride::class;


//Gestion de la météo: accueil admin
public function accueilMeteoAdmin(array $result =[]){
    
    sess("Admin", "../../");

    extract($result);
    $result = $this->model->afficherTout();

    $db = deco();
    }

//Créer une éphéméride
public function add(array $ephemeride =[]){
    
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
    
            $this->model->add($imgTemps, $titre, $topo);
    
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
            redirect("/templates/ephemerideTemplate/addActu.php");
        }
    }
        }


//Modifier une éphéméride
public function modifier(){

sess("Admin", "../../");

if ($_POST) {
    if (
        isset($_POST['idEphemeride']) && !empty($_POST['idEphemeride'])
        && isset($_FILES['imgTemps']) && !empty($_FILES['imgTemps'])
        && isset($_POST['titre']) && !empty($_POST['titre'])
        && isset($_POST['topo']) && !empty($_POST['topo'])
    ) {

        $id = strip_tags($_POST['idEphemeride']);
        $titre = strip_tags($_POST['titre']);
        $topo = strip_tags($_POST['topo']);

        $image = $_FILES['imgTemps']['name'];
        $tmp_name = $_FILES['imgTemps']['tmp_name'];
        $size = $_FILES['imgTemps']['size'];
        $error = $_FILES['imgTemps']['error'];
    
        $this->model->modifier($id, $image, $titre, $topo);

// Upload de l'image et vérifier chaque clé: name, type, fichier temp, error et taille
if (isset($_FILES['imgTemps']) &&  !empty($_FILES['imgTemps']['tmp_name'])) {

    if (is_uploaded_file($_FILES['imgTemps']['tmp_name'])) {  // clé error
		$types_autorises = ['image/png', 'image/jepg', 'image/jpg']; // Formats
        $typeMime = mime_content_type($_FILES['imgTemps']['tmp_name']);
        if(!in_array($typeMime, $types_autorises)){

            $size = filesize($_FILES['imgTemps']['tmp_name']);  //taille
            if($size > 10000){
                info("erreur", "L'image ne doit pas dépasser 10ko");
                redirect("/templates/ephemerideTemplate/modifierActu.php");
                }else{

                // Nettoyer le fichier, sécurité
                $nomAvantNettoyage = $_POST['fileName'];                                
                $nomEnCoursDeNettoyage = preg_replace('~[\\pL\d]+~u', '-', $nomAvantNettoyage);                                
                $nomEnCoursDeNettoyage = trim($nomEnCoursDeNettoyage, '-');                                 
                $nomEnCoursDeNettoyage = iconv('utf-8', 'us-ascii//TRANSLIT', $nomEnCoursDeNettoyage);                                
                $nomEnCoursDeNettoyage = strtolower($nomEnCoursDeNettoyage);

                $nomNettoye = preg_replace('~[^-\w]+~', '', $nomEnCoursDeNettoyage);

                //Construire le chemin de l'extension et sécuriser
                $extension = substr(strrchr($_FILES['imgTemps']['tmp_name'], "."), 1);
                $cheminDeDestination = '../../images/'.$nomNettoye. '.' .$extension;

                // Définitif         
                $moveIsOk = move_uploaded_file($_FILES['imgTemps']['tmp_name'], $cheminDeDestination);
                    if ($moveIsOk) {
                        info("message", "Image déplacée avec succès");
                        redirect("/templates/ephemerideTemplate/gererActu.php");
                        } else {
                            info("erreur", "echec, l\'image n\'a pas pu être déplacée");
                            redirect("/templates/ephemerideTemplate/modifierActu.php");
                                }
                }
                } else {
                    info("erreur", "Utiliser un format accepté: png, jpeg ou jpg");
                    redirect("/templates/ephemerideTemplate/modifierActu.php");
                }
            } else {
                info("erreur", "Un problème a eu lieu lors de l'upload");
                redirect("/templates/ephemerideTemplate/modifierActu.php");
            }
        } else {
            info("erreur", "Aucune image à télécharger");
            redirect("/templates/ephemerideTemplate/modifierActu.php");
        }

//Renommer l'image et envoi
$cheminEtNomTemporaire = $_FILES['imgTemps']['tmp_name'];

$extension=substr(strrchr($_FILES['imgTemps']['name'], "." ), 1);

$nouveauNom = $_POST['fileName']. '.' .$extension;

$cheminEtNomDefinitif = '../../images/' . $nouveauNom; 

$moveIsOk = move_uploaded_file($cheminEtNomTemporaire, $cheminEtNomDefinitif);

if ($moveIsOk) {
    info("message", "L'image est uploadée");
    redirect("/templates/ephemerideTemplate/gererActu.php");
    
} else {
    info("erreur", "Échec de l\'upload");
    redirect("/templates/ephemerideTemplate/modifierActu.php");
}
        info("message", "L'éphéméride est modifiée");
        $db = deco();  
        redirect("/templates/ephemerideTemplate/gererActu.php");

    } else {
        info("erreur", "Le formulaire est incomplet");
        redirect("/templates/ephemerideTemplate/modifierActu.php");
    }
}

if(isset($_GET['idEphemeride']) && !empty($_GET['idEphemeride'])) {
    $id = strip_tags(stripslashes(htmlentities(trim($_GET['idEphemeride']))));
   
    $produit = $this->model->showOne($id);

    if (!$produit) {
        info("erreur", "Cette éphéméride n'existe pas");
        redirect("/templates/ephemerideTemplate/gererActu.php");
    }
    
} else {
    redirect("/templates/ephemerideTemplate/gererActu.php");
}
    }

//Supprimer une éphéméride   
public function delete(){
    
    sess("Admin", "../../");
    
    if(isset($_GET['idEphemeride']) && !empty($_GET['idEphemeride'])){
    
        $id = strip_tags(stripslashes(htmlentities(trim($_GET['idEphemeride']))));
    
        $produit = $this->model->showOne($id);
    
        if(!$produit){
            info("erreur", "Cet id n'existe pas");
            redirect("../../templates/ephemerideTemplate/gererActu.php");
        }
    
        $this->model->delete($id);
    
        info("erreur", "Éphéméride supprimée");
        redirect("../../templates/ephemerideTemplate/gererActu.php");
    
    }else{
        info("erreur", "URL invalide");
        redirect("../../templates/ephemerideTemplate/gererActu.php");
    }
}
}
?>




