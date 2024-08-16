<div class="container-fluid">
<?php if (!empty($thisSemaine)): ?>
    <h1>La liste des recette de cette semaine :</h1>
<?php else: ?>
    <h1>Pas de choix effectué pour cette semaine</h1>
<?php endif; ?>
    <div class="row">
        <?php foreach($aAllInfosRecetteOfSemaine as $aRecette): ?>
            <div class="col-4 mb-2">
                <div class="card">
                    <h5 class="card-header bg-secondary"><?= $aRecette['REC_NOM'] ?></h5>
                    <div class="card-body">
                        <h5 class="card-title"><?= $aRecette['REC_DUREE'] ?> minutes</h5>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>