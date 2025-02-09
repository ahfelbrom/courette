<div class="container-fluid">
    <div id="header-view" class="d-flex">
        <h1>Repas de la semaine du <?= $strDateDebutSemaine ?></h1>
        <a href="?num_week=<?= $aWeeksMove["before"] ?>" class="btn btn-sm btn-primary m-1 py-3"><i class="fa fa-less-than"></i></a>
        <button class="btn btn-sm btn-primary m-1" id="all-week"><i class="fa fa-calendar-days"></i></button>
        <input type="text" class="d-none" id="datepicker">
        <a href="?num_week=<?= $aWeeksMove["after"] ?>" class="btn btn-sm btn-primary m-1 py-3"><i class="fa fa-greater-than"></i></a>
    </div>
    <div class="row mx-4">
        <?php if (!empty($thisSemaine)): ?>
            <h2>La liste des recette de cette semaine :</h2>
        <?php else: ?>
            <h2>Pas de choix effectué pour cette semaine</h2>
        <?php endif; ?>
        <div class="alert alert-success" style="display: none;" id="alert-error-general" role="alert"></div>
        <div class="col-10">
            <div class="row">
                <?php foreach($aAllInfosRecetteOfSemaine as $aRecette): ?>
                    <div class="col-3 mb-2">
                        <div class="card">
                            <h5 class="card-header bg-secondary" style="font-family: Viga"><?= $aRecette['REC_NOM'] ?> (<?= $aRecette['REC_DUREE'] ?> minutes)</h5>
                            <div class="card-body">
                                <h5 class="card-title">QUAND PHOTO, AFFICHER</h5>
                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-center">
                                    <div class="col-3">
                                        <button class="btn btn-info launch-follow-recette" data-recid="<?= $aRecette['REC_ID'] ?>"><i class="fa fa-list"></i></button>
                                    </div>
                                    <div class="col-3">
                                        <a href="<?= base_url("recettes/detail/" . $aRecette['REC_ID']) ?>"class="btn btn-info"><i class="fa fa-search"></i></a>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-info show-liste-ingredient" data-recid="<?= $aRecette['REC_ID'] ?>"><i class="fa fa-carrot"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-2">
            <div class="card">
                <h5 class="card-header bg-secondary text-center">La liste de course</h5>
                <div class="card-body">
                    <?php foreach($aAllIngredientNeededForSemaine as $aIngredient): ?>
                        <?= $aIngredient['NOM'] ?> : <?= $aIngredient['NOMBRE'] . " " . ($aIngredient['UNITE'] !== "Pièce"?$aIngredient['UNITE']:"") ?>
                        <hr style="margin: 0;">
                    <?php endforeach; ?>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-info" id="copy-list-ingredient"><i class="fa fa-copy"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button class="btn btn-info">Modifier la liste des repas</button>
    </div>
</div>

<?= $this->include('modals/modal-follow-any-recette') ?>
<?= $this->include('modals/modal-liste-ingredient-recette') ?>