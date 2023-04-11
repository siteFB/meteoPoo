<?php

/**
 * Return a message after click
 * 
 * @return MESSAGE
 */
function info(string $sort, string $show)
{
    $_SESSION["$sort"] = "$show";
}

/**
 * Colored message according to type message
 * 
 * @return COLORED_MESSAGE
 */
function colorMess(string $sort, string $color)
{
    if(isset($_SESSION["$sort"]) && !empty($_SESSION["$sort"])){
        ?><div class='alert alert-<?php echo "$color" ?>' role='alert'><?php echo $_SESSION[$sort] ?></div>
        <?php ; 
        $_SESSION["$sort"] = "";
    }
}

/**
 * Redirection
 * 
 * @return REDIRECTION
 */
function redirect(string $url):void  // return vide
{
    header("Location: $url");
    exit();
}

/**
 * Button for back according to role
 * 
 * @return BUTTON/BACK
 */
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