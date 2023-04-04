<?php
require_once('../libraries/utils/utils.php');
?>
<span class="d-flex justify-content-center">
    <h2 class="text-center pb-4 mx-4"><?php echo strip_tags(stripslashes(htmlentities(trim($gererTitre)))) ?></h2>
    <?php

    if (buttonBack("Gérer titre", "Membre", "/templates/espaceMembres/espaceMembre.php")) {
    } else {
        if (buttonBack("Gérer titre", "Admin", "/templates/espaceAdminister/espaceAdmin.php"));
    }
    ?>
</span>