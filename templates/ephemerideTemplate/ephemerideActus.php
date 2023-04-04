<link rel="stylesheet" href="../../boot.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

<section>
    <h2 class="display-5 fw-bold text-center mt-5 mb-5">Éphéméride</h2>
    <div class="container">
        <div class="row mb-5">
            <?php
            foreach ($result as $ephemeride) :
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
            endforeach
            ?>
        </div>
    </div>
</section>

