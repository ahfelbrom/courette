$(function(){
    $('#add-ingredient').click(function(){
        $('#input-ingredient-nom').val("");
        $('#input-ingredient-unite').val("");
        $('#select-ingredient-mois-saison').val("");
        $('#select-ingredient-mois-saison option').attr("selected", true);
        $('#hidden-ingredient-id').val("");
        $('#action').val('add');

        $('#modal-add-update-ingredient').modal('show');
    });

    $('.edit-ingredient').click(function(){
        let allDataIngredient = $(this).data("infos");

        $('#input-ingredient-nom').val(allDataIngredient.ING_NOM);
        $('#input-ingredient-unite').val(allDataIngredient.ING_UNITE);
        $('#select-ingredient-mois-saison').val(allDataIngredient.ING_LISTEMOISSAISON);
        $('#select-ingredient-mois-saison option').removeAttr("selected");
        $.each(allDataIngredient.ING_LISTEMOISSAISON, function(key, month){
            $('#select-ingredient-mois-saison option[value="' + month + '"]').attr("selected", true);
        });
        $('#hidden-ingredient-id').val(allDataIngredient.ING_ID);
        $('#action').val('edit');

        $('#modal-add-update-ingredient').modal('show');
    });

    $('#send-add-update-ingredient').click(function(){
        let that = $('#form_add_update_ingredient');
        let action = "add_ingredient";
        if (that.find('#action').val() === "edit") {
            action = "edit_ingredient";
        }

        $.ajax({
            url: COMMON_BASE_URL + "ingredients/"+action,
            data: that.serialize(),
            type: "POST",
            beforeSend: function (xhr) {
                raz_form_from_errors("#form_add_update_ingredient");
            },
            success: function(returnCall){
                if (returnCall.success){
                    add_alert_message('#alert-modal-add-update-ingredient', "success", "L'action a fonctionné");
                    setTimeout(function(){
                        location.reload();
                    }, 1000);
                }else{
                    add_alert_message('#alert-modal-add-update-ingredient', "failure", returnCall.error_message);

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
    });

    $('.delete-ingredient').click(function(){
        if (confirm("T'es sûr de supprimer l'ingrédient ? Toujours dans l'app mais plus utilisable")) {
            let that = $(this);
            $.ajax({
                url: COMMON_BASE_URL + "ingredients/desactivate_ingredient",
                data: "id="+that.data("ingid"),
                type: "POST",
                success: function(returnCall){
                    if (returnCall.success){
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    }else{
                        alert('Pas désactivé')
                    }
                },
                error: function(xhr, status, error){
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        }
    })
});