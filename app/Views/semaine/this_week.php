<div class="container-fluid">
<?php if (!empty($thisSemaine)): ?>
    <h1>La liste des recette de cette semaine :</h1>
<?php else: ?>
    <h1>Pas de choix effectué pour cette semaine</h1>
<?php endif; ?>
    <div class="row">
        <div class="col-6">
            <h2>Les recettes choisies de la semaine</h2>
            <div class="row">
                <?php foreach($aAllInfosRecetteOfSemaine as $aRecette): ?>
                    <div class="col-4 mb-2">
                        <div class="card">
                            <h5 class="card-header bg-secondary"><?= $aRecette['REC_NOM'] ?></h5>
                            <div class="card-body">
                                <h5 class="card-title"><?= $aRecette['REC_DUREE'] ?> minutes</h5>
                                <div class="float-end">
                                    <a href="<?= base_url("recettes/detail/" . $aRecette['REC_ID']) ?>" class="btn btn-primary btn-sm">Détails</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-6">
            <h2>La liste de course</h2>
            <ul>
                <?php foreach($aAllIngredientNeededForSemaine as $aIngredient): ?>
                    <li><?= $aIngredient['NOM'] ?> : <?= $aIngredient['NOMBRE'] . " " . ($aIngredient['UNITE'] !== "Pièce"?$aIngredient['UNITE']:"") ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>