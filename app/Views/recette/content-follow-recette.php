<div class="row">
    <div class="col-3 border-dark border-end bg-neutral">
        <h5 class="pt-4">Liste des ingrédients</h5>
        <?php foreach($aAllIngredientOfRecette as $aIngredient): ?>
            <?= $aIngredient['ING_NOM'] ?> : <?= $aIngredient['IGE_NOMBRE'] . " " . ($aIngredient['ING_UNITE'] !== "Pièce"?$aIngredient['ING_UNITE']:"") ?>
            <hr style="margin: 0;">
        <?php endforeach; ?>
    </div>
    <div class="col-9 d-flex flex-column">
        <div class="alert alert-success" style="display: none;" id="alert-stop-countdown" role="alert"></div>
        <h5 class="pt-4 text-center">La recette</h5>
        <div id="carousel-follow-recette" class="carousel slide" style="flex:1;">
            <div class="carousel-inner">
                <?php foreach($aAllEtapeOfRecette as $key => $aStep): ?>
                    <div class="carousel-item <?php if ($key===0): ?>active <?php endif; ?> px-4 pb-4" data-stepnumber="<?= ($key+1) ?>">
                        <?= nl2br($aStep['ETR_DESCRIPTION']) ?>
                        <?php if ((float)$aStep['ETR_DUREE'] > 0): ?>
                            <br>
                            <button class="btn btn-secondary start-near-clock" data-ordreetape="<?= $aStep['ETR_ORDRE'] ?>" data-nbseconds="<?= $aStep['ETR_DUREE'] ?>">Démarrer le Chrono</button>
                            <span class="countdown" style="font-size: 25px;"><?= (int)($aStep['ETR_DUREE']/60) ?>:<?= str_pad(($aStep['ETR_DUREE']%60), 2, STR_PAD_LEFT) ?></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="custom-btn-carousel mb-2">
            <button class="btn btn-sm btn-info update-step-number" type="button" data-bs-target="#carousel-follow-recette" data-bs-slide="prev" style="width: 4rem;">
                <
            </button>
            <span class="bg-info text-center px-2 pt-1 rounded">
                <span id="number-step">1</span> / <span id="nb-all-step"></span>
            </span>
            <button class="custom-btn-carousel-right btn btn-sm btn-info update-step-number" type="button" data-bs-target="#carousel-follow-recette" data-bs-slide="next" style="width: 4rem;">
                >
            </button>
        </div>
    </div>
</div>