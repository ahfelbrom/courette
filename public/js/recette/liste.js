$(function(){
    $('#add-recette').click(function(){
        $('#modal-add-update-recette').find('#action').val("add");
        $('#modal-add-update-recette').modal('show');
    });

    $('#send-add-update-recette').click(function(event){
        event.preventDefault();

        let that = $('#form_add_update_recette');
        let action = "add_recette";
        if (that.find('#action').val() === "edit"){
            action = "edit_recette";
        }

        $.ajax({
            url: COMMON_BASE_URL + "recettes/"+action,
            data: that.serialize(),
            type: "POST",
            beforeSend: function (xhr) {
                raz_form_from_errors("#form_add_update_recette");
            },
            success: function(returnCall){
                if (returnCall.success){
                    add_alert_message('#alert-modal-add-update-recette', "success", "L'action a fonctionné");
                    setTimeout(function(){
                        location.reload();
                    }, 1000);
                }else{
                    add_alert_message('#alert-modal-add-update-recette', "failure", returnCall.error_message);

                    if (typeof returnCall.form_errors !== "undefined"){
                        show_all_errors_in_form(returnCall.form_errors);
                    }
                }
            },
            error: function(xhr, status, error){
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });

        return false;
    });

    $('.edit-recette').click(function(){
        let allInfosRecette = $(this).data("infos");

        $('#hidden-recette-id').val(allInfosRecette.REC_ID);
        $('#input-recette-nom').val(allInfosRecette.REC_NOM);
        $('#input-recette-nombre-personne').val(allInfosRecette.REC_NB_PERSONNE_BASE);
        $('#input-recette-duree').val(allInfosRecette.REC_DUREE);
        // d'abord on reset la select, puis on ajuste sa valeur
        $('#select-recette-liste-ustensile option').removeAttr("selected");
        $.each(allInfosRecette.REC_LISTE_USTENSILE, function(key, valueUstensile){
            $('#select-recette-liste-ustensile option[value="' + valueUstensile + '"]').attr("selected", true);
        });

        $('#modal-add-update-recette').find('#action').val("edit");
        $('#modal-add-update-recette').modal('show');
    });
});