<div id="modal-follow-recette" class="modal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Recette</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" style="display: none;" id="alert-stop-countdown" role="alert">
                </div>
                <div id="carousel-follow-recette" class="carousel slide">
                    <div class="carousel-inner">
                        <?php foreach(array_chunk($aAllEtapeOfRecette, 3) as $key => $aThreeStep): ?>
                            <div class="carousel-item <?php if ($key===0): ?>active <?php endif; ?>">
                                <div class="container ps-5 ms-3">
                                    <div class="row">
                                        <div class="col-4 border-end">
                                            <?= nl2br($aThreeStep[0]['ETR_DESCRIPTION']) ?>
                                            <?php if ((float)$aThreeStep[0]['ETR_DUREE'] > 0): ?>
                                            <button class="btn btn-primary start-near-clock" data-ordreetape="<?= $aThreeStep[0]['ETR_ORDRE'] ?>" data-nbseconds="<?= $aThreeStep[0]['ETR_DUREE'] ?>">Démarrer le Chrono</button>
                                                <h3 class="countdown"><?= (int)($aThreeStep[0]['ETR_DUREE']/60) ?>:<?= str_pad(($aThreeStep[0]['ETR_DUREE']%60), 2, STR_PAD_LEFT) ?></h3>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (isset($aThreeStep[1])): ?>
                                            <div class="col-4 border-end">
                                                <?= nl2br($aThreeStep[1]['ETR_DESCRIPTION']) ?>
                                                <?php if ((float)$aThreeStep[1]['ETR_DUREE'] > 0): ?>
                                                <button class="btn btn-primary start-near-clock" data-ordreetape="<?= $aThreeStep[0]['ETR_ORDRE'] ?>" data-nbseconds="<?= $aThreeStep[1]['ETR_DUREE'] ?>">Démarrer le Chrono</button>
                                                    <h3 class="countdown"><?= (int)($aThreeStep[1]['ETR_DUREE']/60) ?>:<?= str_pad(($aThreeStep[1]['ETR_DUREE']%60), 2, STR_PAD_LEFT) ?></h3>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (isset($aThreeStep[2])): ?>
                                            <div class="col-4">
                                                <?= nl2br($aThreeStep[2]['ETR_DESCRIPTION']) ?>
                                                <?php if ((float)$aThreeStep[2]['ETR_DUREE'] > 0): ?>
                                                <button class="btn btn-primary start-near-clock" data-ordreetape="<?= $aThreeStep[0]['ETR_ORDRE'] ?>" data-nbseconds="<?= $aThreeStep[2]['ETR_DUREE'] ?>">Démarrer le Chrono</button>
                                                    <h3 class="countdown"><?= (int)($aThreeStep[2]['ETR_DUREE']/60) ?>:<?= str_pad(($aThreeStep[2]['ETR_DUREE']%60), 2, STR_PAD_LEFT) ?></h3>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev text-black" type="button" data-bs-target="#carousel-follow-recette" data-bs-slide="prev">
                        <
                    </button>
                    <button class="carousel-control-next text-black" type="button" data-bs-target="#carousel-follow-recette" data-bs-slide="next">
                        >
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
