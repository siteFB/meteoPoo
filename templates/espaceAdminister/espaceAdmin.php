<?php
session_start();

if(!isset($_SESSION["user"])) {
    redirect("../templates/formConnexion.php");
    exit();
}

$titre = "Espace administrateur";

include "../../layout.php";
include "../../header.php";
include "../espaces/bienvenu.php";
?>
<link rel="stylesheet" href="../../boot.css">

<h2 class="text-center pb-4 mx-4">Que souhaitez-vous gérer?</h2>

<?php
echo "<div class='container my-5 pb-5 bg-light'>
                <div class='col-md-12 text-center'>
                    <button type='button' class='btn btn-success'><a class='text-white' href='/templates/liste_des_inscrits.php'>Voir les inscrits</a></button>
                    <button type='button' class='btn btn-warning'><a href='/templates/ephemerideTemplate/gererActu.php'>Gérer l'actualité</a></button>
                    <button type='button' class='btn btn-primary'><a href='../boitemailTemplate/msgRecusAdmin.php' class='text-white'>Ma messagerie</a></button>
                    <button type='button' class='btn btn-danger'><a class='text-white' href='profilAdmin.php'>Modifier mon profil</a></button>
                </div>
            </div>";
?>

<?php
include "../../footer.php";
?>