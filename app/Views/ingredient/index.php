<div class="container">
    <button id="add-ingredient" class="btn btn-success">Ajouter un ingrédient</button>
    <table class="table table-hover table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Unité à appliquer</th>
                <th>Liste des mois (saison)</th>
                <th>Catégorie</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($aAllIngredient as $aIngredient): ?>
                <tr>
                    <td><?= $aIngredient["ING_ID"] ?></td>
                    <td><?= $aIngredient["ING_NOM"] ?></td>
                    <td><?= $aIngredient["ING_UNITE"] ?></td>
                    <td><?= implode(" ; ", $aIngredient["ING_LISTEMOISSAISON"]) ?></td>
                    <td><?= ALL_CATEGORIE_INGREDIENT[$aIngredient["ING_CODECATEGORIE"]] ?></td>
                    <td>
                        <button class="btn btn-info btn-sm edit-ingredient" data-infos='<?= str_replace("'", "&apos;", json_encode($aIngredient)) ?>'>MODIFIER</button>
                        <button class="btn btn-danger btn-sm delete-ingredient" data-ingid="<?= $aIngredient['ING_ID'] ?>">DESACTIVER</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->include('modals/modal-add-update-ingredient') ?>