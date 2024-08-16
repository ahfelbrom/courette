<div class="container">
    <button id="add-recette" class="btn btn-success">Ajouter une recette</button>
    <table class="table table-hover table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>NOM</th>
                <th>DUREE (en minutes)</th>
                <th>NB PERSONNES</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($aAllRecette as $aRecette): ?>
                <tr>
                    <td><?= $aRecette["REC_ID"] ?></td>
                    <td><?= $aRecette["REC_NOM"] ?></td>
                    <td><?= $aRecette["REC_DUREE"] ?></td>
                    <td><?= $aRecette["REC_NB_PERSONNE_BASE"] ?></td>
                    <td>
                        <button class="btn btn-info btn-sm edit-recette" data-infos='<?= str_replace("'", "&apos;", json_encode($aRecette)) ?>'>MODIFIER</button>
                        <a href="<?= base_url("recettes/detail/" . $aRecette['REC_ID']) ?>" class="btn btn-secondary btn-sm">DETAILS</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->include('modals/modal-add-update-recette') ?>