<?php
require_once('../../libraries/utils/utils.php');
include "../../traitements/boitemail/detailsAdmin.php";
?>

<?php
$titre = "Espace Administrateur";
$gererTitre = "Espace messagerie";

include "../../layout.php";
include "../../header.php";
include "../../templates/espaces/bienvenu.php";
?>

<link rel="stylesheet" href="../../boot.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<link rel="stylesheet" href="bm.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<section>
<?php
buttonBack("Espace Administrateur", "Admin", "/templates/espaceAdminister/espaceAdmin.php", "../../templates/formConnexion.php");
?>
    <div class="container mb-5">
        <div class="col-md-12 pb-4">
            <div>
                <div class="row bg-white border border-muted rounded">
                    <div class="col-md-3">
                        <div>
                            <ul class="nav flex-column mx-3">
                                <li> <a href="msgEcrireAdmin.php" class="btn btn-block btn-primary text-white my-4" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;ÉCRIRE&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                                <li class="mt-3 mb-3"><a class="fs-5" href="/templates/boitemailTemplate/msgRecusAdmin.php">Messages</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="bg-light border border-muted rounded col-10 mx-auto col-lg-7 pt-4 pb-2 mt-4 mb-4">
                        <?php
                        if (!empty($_SESSION['erreur'])) {
                            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['erreur'] . '</div>';
                            $_SESSION['erreur'] = "";
                        }
                        ?>
                        <?php
                        if (!empty($_SESSION['message'])) {
                            echo '<div class="alert alert-success" role="alert">' . $_SESSION['message'] . '</div>';
                            $_SESSION['message'] = "";
                        }
                        ?>
                        <div>
                            <div class="wrapinput mb-5">
                                <label for="auteur">Expéditeur</label>
                                <?php
                                if (!$msg_nbr == 0) {
                                ?>
                                    <input class="inputm d-block border border-muted rounded w-100 fs-5 px-4 p-3 text-primary fw-bold" id="auteur" type="text" name="expediteur" value="<?php echo $resultat[0]['pseudo'] ?> (<?php echo $msg_nbr; ?>)">
                                <?php
                                } else {
                                    $_SESSION['message'] = "Vous n'avez aucun message de cet utilisateur";
                                    header('Location: /traitements/boitemail/recusAdmin.php');
                                }
                                ?>
                            </div>
                            <?php
                            foreach ($resultat as $result) {
                            ?>
                                <div class="wrapinput">
                                    <input class="inputm d-block border border-muted rounded w-100 fs-6 fw-bold px-2 py-1 bg-light" type="text" name="titreMessage" value="<?php echo strip_tags(stripslashes(htmlentities(trim($result['titreMessage'])))) ?>">
                                </div>
                                <div class="wrapinput">
                                    <textarea class="inputm border border-muted rounded w-100 px-4 pt-1 pb-5 fs-6 fw-bold" type="text" name="message" value="mesage"><?php echo strip_tags(stripslashes(htmlentities(trim($result['mesage'])))) ?></textarea>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <p class="pt-2 px-2 text-end time"><?php echo strip_tags(stripslashes(htmlentities(trim($result['dateMess'])))) ?></p>
                                    <p class=" pt-2 px-2"><a class="fs-5 text-secondary text-primary" onclick="return confirm('Voulez-vous supprimer ce message?')" href="/traitements/boitemail/supprMessAdmin.php?idUser=<?php echo strip_tags(stripslashes(htmlentities(trim($result['idMessagerie'])))) ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></p>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php
include "../../footer.php";
?>