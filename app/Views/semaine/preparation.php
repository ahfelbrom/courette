<div class="container-fluid">
    <div class="alert" id="alert-select-recette" role="alert" style="display: none;"></div>
    <div class="row">
        <div class="col-4">
            LES RECETTES QUE J'AI CHOISIS<button class="btn btn-success" id="validate-recette-choisie">Valider les choix</button>
            <div class="px-5" id="list-recette-choisie">
                <?php if (isset($aAllInfosRepas)): ?>
                    <?php foreach($aAllInfosRepas as $strIdRepas => $aRepas): ?>
                        <div class="card mb-4 carte-recette">
                            <h5 class="card-header bg-secondary" id="nom-recette-choisie"><?= $aRepas['REC_NOM'] ?></h5>
                            <div class="card-body">
                                <button class="btn btn-danger retirer-recette-semaine" data-recid="<?= $strIdRepas ?>">
                                    Retirer
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-8">
            LA LISTE DES RECETTES DANS L'APP
            <div class="row">
                <?php foreach($aAllRecette as $aRecette): ?>
                    <div class="col-4 mb-2">
                        <div class="card">
                            <h5 class="card-header bg-secondary"><?= $aRecette['REC_NOM'] ?></h5>
                            <div class="card-body">
                                <h5 class="card-title"><?= $aRecette['REC_DUREE'] ?> minutes</h5>
                                <button class="btn btn-primary select-recette-semaine" data-recid='<?= $aRecette['REC_ID'] ?>' data-recnom="<?= $aRecette['REC_NOM'] ?>">
                                    Choisir
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div class="d-none">
    <div id="prototype-card-recette-choisie">
        <div class="card mb-4 carte-recette" style="display: none;">
            <h5 class="card-header bg-secondary" id="nom-recette-choisie"></h5>
            <div class="card-body">
                <button class="btn btn-danger retirer-recette-semaine">
                    Retirer
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let listeIdRecetteChoisie = <?= isset($aAllInfosRepas)?json_encode(array_keys($aAllInfosRepas)):"[]" ?>;
</script>