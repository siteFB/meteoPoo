<section>
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
                <form action="../traitements/connection/traiterInscription.php" method="POST" class="p-5 border rounded-3 bg-light" id="sinscrire">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="pseudo" id="pseudo" pattern="[a-z]{2,25}">
                        <label for="pseudo">Pseudo (format Exemple_58)</label>
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
</section>