<div id="modal-add-update-ingredient-recette" class="modal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-plus"></i>/<i class="fa fa-pencil"></i> ingrédient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert" id="alert-modal-add-update-ingredient-recette" role="alert" style="display: none;"></div>
                <form id="form_add_update_ingredient_recette">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="select-ingredient-recette" class="form-label">Ingrédient</label>
                                    <select class="form-select form-select-lg mb-3" id="select-ingredient-recette" name="ING_ID" style="font-size: 1.5rem;">
                                        <option value="">---</option>
                                        <?php foreach($aAllIngredient as $aIngredient): ?>
                                            <option data-unite="<?= $aIngredient['ING_UNITE'] ?>" value="<?= $aIngredient['ING_ID'] ?>"><?= $aIngredient['ING_NOM'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="input-ingredient-recette-nombre" class="form-label">Nombre (<span id="unite-ingredient-recette"></span>)</label>
                                    <input class="form-control" id="input-ingredient-recette-nombre" name="IGE_NOMBRE"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="REC_ID" value="<?= $aInfosRecette['REC_ID'] ?>"/>
                    <input type="hidden" id="hidden-ingredient-recette-id" name="IGE_ID" value=""/>
                    <input type="hidden" id="action" value="add"/>
                </form>
            </div>
            <div class="modal-footer">
                <div class="float-start">
                    <a href="#" id="delete-ingredient-recette" class="btn btn-danger">Supprimer</a>
                </div>
                <div class="float-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <a href="#" id="send-add-update-ingredient-recette" class="btn btn-primary">Enregistrer</a>
                </div>
            </div>
        </div>
    </div>
</div>
