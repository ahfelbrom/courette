<div id="modal-add-update-recette" class="modal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajout recette</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert" id="alert-modal-add-update-recette" role="alert" style="display: none;"></div>
                <form id="form_add_update_recette">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="input-recette-nom" class="form-label">Nom de la recette</label>
                                    <input class="form-control" id="input-recette-nom" name="REC_NOM" placeholder="200 car. max.">
                                </div>
                                <div class="mb-3">
                                    <label for="select-recette-liste-ustensile" class="form-label">Liste d'ustensile</label>
                                    <select class="form-select form-select-lg mb-3 chosen-select" id="select-recette-liste-ustensile" name="REC_LISTEUSTENSILE[]" size="3" multiple>
                                        <?php foreach(ALL_USTENSILE as $strCodeUstensile => $strUstensile): ?>
                                            <option value="<?= $strCodeUstensile ?>"><?= $strUstensile ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="input-recette-nombre-personne" class="form-label">Nombre de personne de base</label>
                                    <input type="number" class="form-control" name="REC_NBPERSONNE" id="input-recette-nombre-personne">
                                </div>
                                <div class="mb-3">
                                    <label for="input-recette-duree" class="form-label">Durée de la recette (en minutes)</label>
                                    <input type="number" class="form-control" name="REC_DUREE" id="input-recette-duree">
                                </div>
                                <div class="mb-3">
                                    <label for="input-recette-tag-list" class="form-label">Badges liés</label>
                                    <div class="row mb-2">
                                        <div class="col-10">
                                            <input type="text" placeholder="Ajouter un tag" class="form-control" id="tag-to-add" />
                                        </div>
                                        <button type="button" id="add-tag" class="col-2 btn btn-sm btn-info">Ajouter tag</button>
                                    </div>
                                    <select class="form-select form-select-lg mb-3 chosen-select" id="select-recette-liste-tag" name="REC_TAGLIST[]" size="3" multiple>
                                        <?php foreach($aAllTagForRecettes as $strTag): ?>
                                            <option value="<?= $strTag ?>"><?= $strTag ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="hidden-recette-id" name="REC_ID" value=""/>
                    <input type="hidden" id="action" value="add"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <a href="#" id="send-add-update-recette" class="btn btn-primary">Ajouter</a>
            </div>
        </div>
    </div>
</div>
