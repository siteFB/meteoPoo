<?php

namespace Controllers;

require_once('../../libraries/sessions/sessionChoice.php');
require_once('../../libraries/base/deconnexionBDD.php');
require_once('../../libraries/utils/utils.php');
require_once('../../libraries/models/IndexVisiteurs.php');

class EphemerideConsulter extends ControllerEphemeride{

    protected $modelName = \Models\Ephemeride::class;

    //Montrer la totalité des éphémérides
    public function index(array $result =[]){

if (isset($_SESSION["user"]["statut"])){

extract($result);   
$result = $this->model->findAll();
$db = deco();

}else{
    info("erreur", "Vous devez vous connecter");
    redirect("index.php");
}

}

    //Montrer une seule éphéméride
    public function afficherUn(){

if (isset($_SESSION["user"]["statut"])){
if(isset($_GET['idEphemeride']) && !empty($_GET['idEphemeride'])){
    $id = strip_tags(stripslashes(htmlentities(trim($_GET['idEphemeride']))));
  
    $produit = $this->model->showOne($id);

    if(!$produit){
        info("erreur", "Cet id n'existe pas");
        redirect("consulterMeteo.php");
    }

}else{
    info("erreur", "URL invalide");
    redirect("consulterMeteo.php");
}
}else{
    info("erreur", "Vous devez vous connecter");
    redirect("index.php");
}

}

}
