<span class="d-flex justify-content-center">
    <h2 class="text-center pb-4 mx-4"><?php echo strip_tags(stripslashes(htmlentities(trim($gererTitre)))) ?></h2>
    <?php

    if ($_SESSION["user"]['statut'] == "Membre") {

        echo "
        <div>
            <button type='button' class='btn btn-success'><a class='text-white' href='/templates/espaceMembres/espaceMembre.php'>Retour</a></button>
        </div>
               ";
    } else {
        if ($_SESSION["user"]['statut'] == "Admin") {
            echo "    
        <div>
            <button type='button' class='btn btn-success'><a class='text-white' href='/templates/espaceAdminister/espaceAdmin.php'>Retour</a></button>
        </div>
               ";
        }
    }
    ?>
</span>