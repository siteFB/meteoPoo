<?php
session_start();
require_once('../../libraries/utils/utils.php');

$titre = "Espace membre";

include "../../layout.php";
include "../../header.php";
include "../espaces/bienvenu.php";
?>
<link rel="stylesheet" href="../../boot.css">

<?php
buttonBack("Modifier mon profil", "Membre", "/templates/espaceMembres/espaceMembre.php");
?>
<div class="container mt-4 mb-5">
    <div class="text-center darken-grey-text mb-4">
        <table class="table">
            <tbody>
                <tr class="table-warning">
                    <th scope="row">Mon pseudo</th>
                    <td><?php echo $_SESSION["user"]['pseudo'] ?></td>
                    <td>Modifier</td>
                </tr>
                <tr class="table-success">
                    <th scope="row">Mon e-mail</th>
                    <td><?php echo $_SESSION["user"]['email'] ?></td>
                    <td>Modifier</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
include "../../footer.php";
?>