<?php
require_once('../libraries/sessions/sessionChoice.php');
require_once('../libraries/utils/utils.php');
include "../traitements/inscrits/voirInscrits.php";
?>

<?php
$titre = "Espace administrateur/Liste des inscrits";
$gererTitre = "Liste des inscrits";

include "../layout.php";
include "../header.php";
include "../templates/espaces/bienvenu.php";
?>
<link rel="stylesheet" href="../../boot.css">

<section>
  <?php
  sess("Admin", "../../");
  buttonBack("Liste des inscrits", "Admin", "/templates/espaceAdminister/espaceAdmin.php");
  ?>

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
          foreach ($result as $user) :
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
          endforeach;
          ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<?php
include "../footer.php";
?>