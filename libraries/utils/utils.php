<?php
function info(string $sort, string $show) // show message or erreur
{
    $_SESSION["$sort"] = "$show";
}

function redirect(string $url):void  // return vide
{
    header("Location: $url");
}

function buttonBack(string $gererTitre, string $role, string $url1):void
{
    ?>
    <span class="d-flex justify-content-center">
    <h2 class="text-center pb-4 mx-4 my-5"><?php echo strip_tags(stripslashes(htmlentities(trim($gererTitre)))) ?></h2>
    <?php
    ($_SESSION["user"]['statut'] == "$role") 
        ?>
        <div>
            <button type='button' class='btn btn-success my-5'><a class='text-white' href='<?php echo $url1 ?>'>Retour</a></button>
        </div>
    </span>
    <?php
}
?>