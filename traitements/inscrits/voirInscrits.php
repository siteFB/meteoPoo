<?php
session_start();
if (!isset($_SESSION["user"])) {
  header("Location: ../templates/formConnexion.php");
  die();
}

require_once('../../base/connexionBDD.php');

$sql = 'SELECT * FROM `users`';

$query = $db->prepare($sql);

$query->execute();

$result = $query->fetchAll(PDO::FETCH_ASSOC);

$titre = "Espace administrateur/Liste des inscrits";
$gererTitre = "Liste des inscrits";

include "../../templates/layout.php";
include "../../templates/header.php";
include "../../templates/espaces/bienvenu.php";
?>

<link rel="stylesheet" href="../../boot.css">
<section>

<span class="d-flex justify-content-center">
    <h2 class="text-center mt-5 mb-5 text-primary"><?php echo strip_tags(stripslashes(htmlentities(trim($gererTitre)))) ?></h2>
    <?php
    
    if (isset($_SESSION["user"]) && ($_SESSION["user"]["statut"] == "Admin")) {

        echo "
        <div>
            <button type='button' class='btn btn-success mx-5 mt-5 '><a class='text-white' href='/templates/espaceAdminister/espaceAdmin.php'>Retour</a></button>
        </div>
               ";
    } else{
        header('Location: ../../templates/formConnexion.php');
    }
    ?>
</span>

  <div class="container mb-5">
    <div class="table-responsive">
      <table class="table table-bordered table-striped m-5">
        <thead class="table__head bg-warning">
          <tr class="winner__table">
            <th>id</th>
            <th><i class="fa fa-user" aria-hidden="true">&ensp;</i>Pseudo</th>
            <th><i class="fa fa-envelope" aria-hidden="true">&ensp;</i>Email</th>
            <th><i class="fa fa-calendar" aria-hidden="true">&ensp;</i>Date</th>
            <th><i aria-hidden="true">&ensp;</i>Role</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($result as $user) {
          ?>
            <tr>
              <td><?php echo strip_tags(stripslashes(htmlentities(trim($user['idUser'])))) ?></td>
              <td><?php echo strip_tags(stripslashes(htmlentities(trim($user['pseudo'])))) ?></td>
              <td><?php echo strip_tags(stripslashes(htmlentities(trim($user['email'])))) ?></td>
              <td><?php echo strip_tags(stripslashes(htmlentities(trim($user['dateInscrit'])))) ?></td>
              <td><?php if ($user["statut"] == "Admin") {
                    echo ' <p class="text-danger">' . $user["statut"] . '</p>';
                  } else {
                    echo ' <p class="text-primary">' . $user["statut"] . '</p>';
                  }; ?>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<?php
include "../../templates/footer.php";
?>