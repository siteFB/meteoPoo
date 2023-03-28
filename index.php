<?php
require_once('../meteoPoo/base/connexionBDD.php');

$sql = 'SELECT * FROM `ephemeride`';
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('../meteoPoo/base/deconnexionBDD.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="boot.css">
    <title>Météo version POO</title>
</head>
<body>
<nav class="navbar navbar-dark bg-dark" aria-label="First navbar example">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">MÉTÉO 58</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation" onclick="myFunction()">
            <span class="navbar-toggler-icon red"></span>
        </button>
        <div class="container" id="contenerNav">
            <div class="d-flex justify-content-center">
                <ul class="nav nav-pills">
                    <!-------------------------- Gérer les accès de navigation selon la connexion ------------------------------->
                    <?php if (!isset($_SESSION["user"])) : ?>
                        <li class="nav-item"><a href="formConnexion.php" class="nav-link text-white">Se connecter</a></li>
                        <li class="nav-item"><a href="#inscription" class="nav-link text-white">S'inscrire</a></li>
                    <?php elseif (isset($_SESSION["user"]) && ($_SESSION["user"]["statut"] == "Membre")) : ?>
                        <li class="nav-item"><a href="../consulterMeteo.php" class="nav-link text-white">Éphéméride</a></li>
                        <li class="nav-item"><a href="../espaceMembres/profilMembre.php" class="nav-link text-white">Profil</a></li>
                        <li class="nav-item"><a href="../deconnexion.php" class="nav-link text-white">Se déconnecter</a></li>
                    <?php elseif (isset($_SESSION["user"]) && ($_SESSION["user"]["statut"] == "Admin")) : ?>
                        <li class="nav-item"><a href="../consulterMeteo.php" class="nav-link text-white">Éphéméride</a></li>
                        <li class="nav-item"><a href="profilAdmin.php" class="nav-link text-white">Profil</a></li>
                        <li class="nav-item"><a href="../deconnexion.php" class="nav-link text-white">Se déconnecter</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarsExample01">
            <ul class="navbar-nav me-auto mb-2">
                <?php if (!isset($_SESSION["user"])) : ?>
                    <li class="nav-item"><a href="formConnexion.php" class="nav-link text-white">Se connecter</a></li>
                    <li class="nav-item"><a href="#inscription" class="nav-link text-white">S'inscrire</a></li>
                <?php elseif (isset($_SESSION["user"]) && ($_SESSION["user"]["statut"] == "Membre")) : ?>
                    <li class="nav-item"><a href="../consulterMeteo.php" class="nav-link text-white">Éphéméride</a></li>
                    <li class="nav-item"><a href="../espaceMembres/profilMembre.php" class="nav-link text-white">Profil</a></li>
                    <li class="nav-item"><a href="../deconnexion.php" class="nav-link text-white">Se déconnecter</a></li>
                <?php elseif (isset($_SESSION["user"]) && ($_SESSION["user"]["statut"] == "Admin")) : ?>
                    <li class="nav-item"><a href="../consulterMeteo.php" class="nav-link text-white">Éphéméride</a></li>
                    <li class="nav-item"><a href="profilAdmin.php" class="nav-link text-white">Profil</a></li>
                    <li class="nav-item"><a href="../deconnexion.php" class="nav-link text-white">Se déconnecter</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<!-------------------------- Titre ------------------------------->
<div class="px-4 pt-2 my-5 text-center">
    <img class="d-block mx-auto mb-4 w_" src="/imagenes/e23.png" alt="" width="80" height="auto">
    <h1 class="display-3 fw-bold">MÉTÉO 58</h1>
    <div class="col-lg-6 mx-auto">
        <p class="lead mb-1">Rapprochez-vous de <a href="#">MÉTÉO 58</a>, lorem ipsum dolor sit amet.</p>
    </div>
</div>
<!-------------------------- Séparateur ------------------------------->
<div class="divider"></div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<!-------------------------- Actus ------------------------------->
<section>
    <h2 class="display-5 fw-bold text-center mt-5 mb-5">Éphéméride</h2>
    <div class="container">
        <div class="row mb-5">
            <?php
            foreach ($result as $ephemeride) {
            ?>
                <div class="col-md-4 mb-5">
                    <div class="card col" style="height:550px">
                        <img src="/images/<?php echo $ephemeride['imgTemps'] ?>" class="card-img-top h-100">
                        <div class="card-body" style="height:200px">
                            <h3 class="card-title"><?php echo $ephemeride['titre'] ?></h3>
                            <p class="card-text"><?php echo $ephemeride['topo'] ?></p>
                            <button type="button" class="btn btn-primary" data-toggle="tooltip" data-bs-placement="right" title="Vous devez vous inscrire" style="float:left">Consulter</button>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!-------------------------- Séparateur ------------------------------->
    <div class="divider"></div>
    <!-------------------------- Inscription ------------------------------->
    <div class="container col-xl-10 col-xxl-8 pt-2 my-3">
        <div class="row align-items-center g-5 py-3">
            <section id="inscription" class="col-lg-7 text-center text-lg-start">
                <h2 class="display-4 fw-bold lh-1 mb-3">Inscription</h2>
                <!-------------------- En cas de champs vides au clic ------------------>
                <?php
                if (!empty($_SESSION['erreur'])) {
                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['erreur'] . '</div>';
                    $_SESSION['erreur'] = "";
                }
                ?>
                <!---->
                <p class="lead col-lg-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.
                    Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor.
                    Cras elementum ultrices diam.</p>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <button type="button" class="btn btn-primary">F</button>
                    <button type="button" class="btn btn-danger">An</button>
                    <button type="button" class="btn btn-warning">Al</button>
                </div>
            </section>
            <div class="col-10 mx-auto col-lg-5">
                <form action="Inscription.php" method="POST" class="p-5 border rounded-3 bg-light" id="sinscrire">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="pseudo" id="pseudo" pattern="[a-z]{2,25}">
                        <label for="pseudo">Pseudo ( <i>Exemple_58</i> )</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="email">
                        <label for="email">E-mail</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="pass" id="pass">
                        <label for="pass">Mot de passe</label>
                    </div>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit" name="forminscription">S'inscrire</button>
            </form>
        </div>
    </div>
    </div>
</section>
<!-------------------------- Séparateur ------------------------------->
<div class="divider"></div>
<!-------------------------- Contacts ------------------------------->
<section>
    <?php
    if (!empty($_SESSION['erreur'])) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['erreur'] . '</div>';
        $_SESSION['erreur'] = "";
    }
    ?>

    <div class="container bg-light col-xl-10 col-xxl-12 pt-2">
        <div class="row align-items-center g-5 py-3">
    <!------------ Message ----------->
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
    <!------------ Contacts ----------->
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
<footer class="bg-dark p-4 text-white text-center">
        <h2>Nos partenaires</h2>
        <hr>
        <nav class="nav d-flex justify-content-between" aria-label="Fith navbar example">
            <a class="p-2 link-secondary" href="https://www.hellowork.com/fr-fr/">Météo France</a>
            <a class="p-2 link-secondary" href="https://www.pole-emploi.fr/accueil/">Météo+</a>
            <a class="p-2 link-secondary" href="https://fr.indeed.com/">France Météo</a>
            <a class="p-2 link-secondary"
                href="https://openclassrooms.com/fr/paths/500-developpeur-dapplication-php-symfony">OpenClassRoom</a>
            &copy;MÉTÉO 58
        </nav>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="boot.js"></script>

</body>
</html>
