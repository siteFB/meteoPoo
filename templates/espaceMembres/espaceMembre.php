<?php
session_start();

if(!isset($_SESSION["user"])) {
    redirect("/templates/formConnexion.php");
}

$titre = "Espace membre";

include "../../layout.php";
include "../../header.php";
include "../espaces/bienvenu.php";
?>
<link rel="stylesheet" href="../../boot.css">

<h2 class="text-center pb-4 mx-4">Que souhaitez-vous faire?</h2>

<?php
echo "<div class='container my-5 pb-5 bg-light'>
                <div class='col-md-12 text-center'>
                    <button type='button' class='btn btn-success'><a class='text-white' href='/templates/espaces/consulterMeteo.php'>Consulter la météo</a></button>
                    <button type='button' class='btn btn-primary'><a href='../boitemailTemplate/msgRecusMembre.php' class='text-white'>Ma messagerie</a></button>
                    <button type='button' class='btn btn-warning'><a href='profilMembre.php'>Modifier mon profil</a></button>
                </div>
            </div>";
?>

<?php
include "../../footer.php";
?>