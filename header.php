<nav class="navbar navbar-dark bg-dark" aria-label="First navbar example">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">MÉTÉO 58</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation" onclick="myFunction()">
            <span class="navbar-toggler-icon red"></span>
        </button>
        <div class="container" id="contenerNav">
            <div class="d-flex justify-content-center">
                <ul class="nav nav-pills">

                    <!-------------------------- Gérer les accès selon la connexion ------------------------------->
                    <?php if (!isset($_SESSION["user"])) : ?>
                        <li class="nav-item"><a href="templates/formConnexion.php" class="nav-link text-white">Se connecter</a></li>
                        <li class="nav-item"><a href="../index.php/#inscription" class="nav-link text-white">S'inscrire</a></li>
                    <?php elseif (isset($_SESSION["user"]) && ($_SESSION["user"]["statut"] == "Membre")) : ?>
                        <li class="nav-item"><a href="../espaces/consulterMeteo.php" class="nav-link text-white">Éphéméride</a></li>
                        <li class="nav-item"><a href="../espaceMembres/profilMembre.php" class="nav-link text-white">Profil</a></li>
                        <li class="nav-item"><a onclick="return confirm('Are you sure you want to deconnect ?')" href="/traitements/connection/deconnexion.php" class="nav-link text-white">Se déconnecter</a></li>
                    <?php elseif (isset($_SESSION["user"]) && ($_SESSION["user"]["statut"] == "Admin")) : ?>
                        <li class="nav-item"><a href="../espaces/consulterMeteo.php" class="nav-link text-white">Éphéméride</a></li>
                        <li class="nav-item"><a href="../espaceAdminister/profilAdmin.php" class="nav-link text-white">Profil</a></li>
                        <li class="nav-item"><a onclick="return confirm('Are you sure you want to deconnect ?')" href="/traitements/connection/deconnexion.php" class="nav-link text-white">Se déconnecter</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarsExample01">
            <ul class="navbar-nav me-auto mb-2">
                <?php if (!isset($_SESSION["user"])) : ?>
                    <li class="nav-item"><a href="templates/formConnexion.php" class="nav-link text-white">Se connecter</a></li>
                    <li class="nav-item"><a href="../index.php/#inscription" class="nav-link text-white">S'inscrire</a></li>
                <?php elseif (isset($_SESSION["user"]) && ($_SESSION["user"]["statut"] == "Membre")) : ?>
                    <li class="nav-item"><a href="../espaces/consulterMeteo.php" class="nav-link text-white">Éphéméride</a></li>
                    <li class="nav-item"><a href="../espaceMembres/profilMembre.php" class="nav-link text-white">Profil</a></li>
                    <li class="nav-item"><a onclick="return confirm('Are you sure you want to deconnect ?')" href="/traitements/connection/deconnexion.php" class="nav-link text-white">Se déconnecter</a></li>
                <?php elseif (isset($_SESSION["user"]) && ($_SESSION["user"]["statut"] == "Admin")) : ?>
                    <li class="nav-item"><a href="../espaces/consulterMeteo.php" class="nav-link text-white">Éphéméride</a></li>
                    <li class="nav-item"><a href="../espaceAdminister/profilAdmin.php" class="nav-link text-white">Profil</a></li>
                    <li class="nav-item"><a onclick="return confirm('Are you sure you want to deconnect ?')" href="/traitements/connection/deconnexion.php" class="nav-link text-white">Se déconnecter</a></li>
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

<div class="divider"></div>