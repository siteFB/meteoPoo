<?php
include "traitements/ephemeride/read_index.php";
?>
<?php
$titre = "Accueil";

include "layout.php";
include "header.php";
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

<!-------- Éphéméride -------->
<?php
include "templates/ephemerideTemplate/ephemerideActus.php";
?>

<div class="divider"></div>

<!-------- S'inscrire -------->
<?php
include "templates/inscription.php";
?>

<div class="divider"></div>

<!--------- Contacts ---------->
<section>
    <?php
    if (!empty($_SESSION['erreur'])) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['erreur'] . '</div>';
        $_SESSION['erreur'] = "";
    }
    ?>

    <div class="container bg-light col-xl-10 col-xxl-12 pt-2">
        <div class="row align-items-center g-5 py-3">
<!------------ Fake message ----------->
            <div class="col-10 mx-auto col-lg-5 pt-4 mt-4 mb-4">
                <form action="../messagerie/envoi.php" method="POST" class="p-5 pb-1 mt-3 border rounded-3 bg-white" id="sinscrire">
                <h4 class="display-6 pb-3 text-center">Laissez un message</h4>
                    <div class="form-outline">
                        <input type="text"  class="form-control bg-light" />
                        <label class="form-label text-secondary" for="form4Example1">Expéditeur</label>
                    </div>
                    <div class="form-outline">
                        <input type="text" class="form-control bg-light" />
                        <label class="form-label text-secondary" for="form4Example1">Destinataire</label>
                    </div>
                    <div class="form-outline">
                        <input type="text" class="form-control bg-light" />
                        <label class="form-label text-secondary" for="form4Example1">Titre</label>
                    </div>
                    <div class="form-outline">
                        <textarea class="form-control bg-light" rows="4"></textarea>
                        <label class="form-label text-secondary" for="form4Example3">Message</label>
                    </div>

                    <button type="button" class="btn btn-primary mt-2 mb-3" data-toggle="tooltip" data-bs-placement="right" title="Vous devez vous inscrire">Envoyer</button>

                </form>
            </div>
<!------------ Coordonnées ----------->
            <div class="container col-xl-4 col-xxl-6 pt-2">
                <div>
                    <div class="col-10 mx-auto col-lg-5 pt-4 mt-4 mb-4">
                        <h2 class="display-4 fw-bold mb-5 text-lg-end">Contact</h2>
                        <!---->
                        <div>
                            <p class="fst-italic text-primary">
                            <p type="button" class="btn btn-success align-baseline">
                                <i class="bi bi-telephone-plus"></i>
                            </p> +33 0 00 00 00 00
                            </p>
                        </div>
                        <div>
                            <p class="fst-italic text-primary">
                            <p type="button" class="btn btn-success align-baseline">
                                <i class="bi bi-pin-map">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pin-map" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z" />
                                        <path fill-rule="evenodd" d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z" />
                                    </svg>
                                </i>
                            </p> 00 rue de xxxxx 00000 LaVille
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include "footer.php";
?>