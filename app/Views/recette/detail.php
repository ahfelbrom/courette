<div class="container">
    <div class="row">
        <div class="col-5 shadow bg-light">
            <p>Durée (en minutes) : <?= $aInfosRecette['REC_DUREE'] ?></p>
            <p>nombre de personne de base : <?= $aInfosRecette['REC_NB_PERSONNE_BASE'] ?></p>
            <p>Liste d'ustensile</p>
            <ul>
                <?php foreach($aInfosRecette['REC_LISTE_USTENSILE'] as $strCodeUstensile): ?>
                    <li><?= ALL_USTENSILE[$strCodeUstensile] ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-6 offset-1 shadow bg-light">
            LA LISTE DES INGREDIENTS
            <a href="#" class="btn btn-sm btn-success" id="launch-add-ingredient">Ajouter un ingrédient</a>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NOM</th>
                        <th>NOMBRE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($aAllIngredientOfRecette as $aIge){
                        if (isset($aAllIngredient[$aIge['ING_ID']])): ?>
                            <tr class="line-table-ingredient" data-infos='<?= json_encode($aIge) ?>'>
                                <td><?= $aAllIngredient[$aIge['ING_ID']]['ING_NOM'] ?></td>
                                <td><?= $aIge['IGE_NOMBRE'] ?> <?= $aAllIngredient[$aIge['ING_ID']]['ING_UNITE'] ?></td>
                            </tr>
                        <?php endif;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container-fluid mt-4">
    LES ETAPES DE LA RECETTE
    <a href="#" class="btn btn-sm btn-success" id="launch-add-etape">Ajouter une étape</a>
    <a href="#" class="btn btn-sm btn-primary" id="launch-follow-etape">Réaliser la recette</a>
    <div class="alert" id="alert-update-etape" role="alert" style="display: none;"></div>
    <div class="row mt-2">
        <?php foreach($aAllEtapeOfRecette as $aEtape): ?>
            <div class="col-2">
                <div class="card update-etape-text">
                    <div class="card-header">
                        <h5 class="card-title">Étape <?= $aEtape['ETR_ORDRE'] ?></h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?= nl2br($aEtape['ETR_DESCRIPTION']) ?></p>
                        <textarea style="display:none;" class="text-description-etape form-control"><?= $aEtape['ETR_DESCRIPTION'] ?></textarea>
                    </div>
                    <input type="hidden" class="id-of-etape" value="<?= $aEtape['ETR_ID'] ?>"/>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->include('modals/modal-add-update-ingredient-recette') ?>
<?= $this->include('modals/modal-add-update-etape') ?>
<?= $this->include('modals/modal-follow-recette') ?>