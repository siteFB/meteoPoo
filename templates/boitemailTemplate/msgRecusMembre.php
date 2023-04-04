<?php
require_once('../../libraries/utils/utils.php');
include "../../traitements/boitemail/recusMembre.php";
?>

<?php
$titre = "Espace Membre";

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
buttonBack("Espace Membre", "Membre", "/templates/espaceMembres/espaceMembre.php", "../../templates/formConnexion.php");
?>
    <div class="container mb-5">
        <div class="col-md-12 pb-4">
            <div>
                <div class="row bg-white border border-muted rounded px-3">
                    <div class="col-md-3">
                        <div>
                            <ul class="nav flex-column mt-5">
                                <li><a href="msgEcrireMembre.php" class="btn btn-block btn-primary text-white my-4" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;ÉCRIRE&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                                <li class="mt-3 mb-3"><a class="fs-5" href="/templates/boitemailTemplate/msgRecusMembre.php">Messages (<?php echo $msg_nbr; ?>)</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 my-5 bg-light p-3">
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
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <?php
                                    if ($msg_nbr == 0) {
                                        $_SESSION['message'] = "Vous n'avez aucun message";
                                    }

                                    while ($m = $msg->fetch()) {
                                        $p_exp = $db->prepare('SELECT pseudo FROM users WHERE idUser= ?');
                                        $p_exp->execute(array($m['id_expediteur']));
                                        $p_exp = $p_exp->fetch();
                                        $p_exp = $p_exp['pseudo'];
                                    ?>
                                        <tr>
                                            <td class="fs-5"><?php echo "$p_exp"; ?></td>
                                            <td><a class="fs-5" href="/templates/boitemailTemplate/msgDetailsMembre.php?idUser=<?php echo $m['id_expediteur']; ?>"><?php echo $m['titreMessage']; ?></a></td>
                                            <td class="time"><?php echo $m['dateMess']; ?></td>
                                            <td><a class="fs-5 text-secondary" onclick="return confirm('Voulez-vous supprimer ce message?')" href="/traitements/boitemail/supprMessMembre.php?idUser=<?php echo $m['idMessagerie']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
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