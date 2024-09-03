<div id="modal-add-update-etape" class="modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-plus"></i>/<i class="fa fa-pencil"></i> étape</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert" id="alert-modal-add-update-etape" role="alert" style="display: none;"></div>
                <form id="form_add_update_etape">
                    <div class="container-fluid">
                        <div class="mb-3">
                            <label for="input-etape-duree" class="form-label">Durée</label>
                            <input type="time" class="form-control" id="input-etape-duree" name="ETR_DUREE"/>
                        </div>
                        <div class="mb-3">
                            <label for="text-etape-description" class="form-label">Description</label>
                            <textarea class="form-control" id="text-etape-description" style="resize: vertical;" rows="5" name="ETR_DESCRIPTION"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="REC_ID" value="<?= $aInfosRecette['REC_ID'] ?>"/>
                    <input type="hidden" id="hidden-etape-id" name="ETR_ID" value=""/>
                    <input type="hidden" id="action" value="add"/>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" id="delete-etape" class="btn btn-danger">Supprimer</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <a href="#" id="send-add-update-etape" class="btn btn-primary">Enregistrer</a>
            </div>
        </div>
    </div>
</div>
