<div id="modal-add-update-ingredient" class="modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-plus"></i>/<i class="fa fa-pencil"></i> ingrédient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert" id="alert-modal-add-update-ingredient" role="alert" style="display: none;"></div>
                <form id="form_add_update_ingredient">
                    <div class="container-fluid">
                        <div class="mb-3">
                            <label for="input-ingredient-nom" class="form-label">Nom</label>
                            <input class="form-control" id="input-ingredient-nom" name="ING_NOM"/>
                        </div>
                        <div class="mb-3">
                            <label for="input-ingredient-unite" class="form-label">Unité</label>
                            <input class="form-control" id="input-ingredient-unite" name="ING_UNITE"/>
                        </div>
                        <div class="mb-3">
                            <label for="select-ingredient-mois-saison" class="form-label">Unité</label>
                            <select class="form-select form-select-lg mb-3" id="select-ingredient-mois-saison" name="ING_LISTEMOISSAISON[]" multiple>
                                <option value="JAN" selected>Janvier</option>
                                <option value="FEV" selected>Février</option>
                                <option value="MAR" selected>Mars</option>
                                <option value="AVR" selected>Avril</option>
                                <option value="MAI" selected>Mai</option>
                                <option value="JUN" selected>Juin</option>
                                <option value="JUL" selected>Juillet</option>
                                <option value="AOU" selected>Aout</option>
                                <option value="SEP" selected>Septembre</option>
                                <option value="OCT" selected>Octobre</option>
                                <option value="NOV" selected>Novembre</option>
                                <option value="DEC" selected>Décembre</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="hidden-ingredient-id" name="ING_ID" value=""/>
                    <input type="hidden" id="action" value="add"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <a href="#" id="send-add-update-ingredient" class="btn btn-success">Enregistrer</a>
            </div>
        </div>
    </div>
</div>
