$(function(){
    $('#launch-add-ingredient').click(function(){
        $('#select-ingredient-recette').val("");
        $('#unite-ingredient-recette').text("");
        $('#input-ingredient-recette-nombre').val("");
        $('#hidden-ingredient-recette-id').val("");
        $('#action').val("add");
        $('#delete-ingredient-recette').hide();
        $('#modal-add-update-ingredient-recette').modal('show');
    });

    $('#select-ingredient-recette').change(function(){
        let optionSelected = $(this).find(':selected');
        $('#unite-ingredient-recette').text(optionSelected.data('unite'));
    });

    $('#send-add-update-ingredient-recette').click(function(){
        let that = $('#form_add_update_ingredient_recette');
        let action = "add_ingredient_recette";
        if (that.find('#action').val() === "edit") {
            action = "edit_ingredient_recette";
        }

        $.ajax({
            url: COMMON_BASE_URL + "recettes/"+action,
            data: that.serialize(),
            type: "POST",
            beforeSend: function (xhr) {
                raz_form_from_errors("#form_add_update_ingredient_recette");
            },
            success: function(returnCall){
                if (returnCall.success){
                    add_alert_message('#alert-modal-add-update-ingredient-recette', "success", "L'action a fonctionné");
                    setTimeout(function(){
                        location.reload();
                    }, 1000);
                }else{
                    add_alert_message('#alert-modal-add-update-ingredient-recette', "failure", returnCall.error_message);

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

    $('.line-table-ingredient').click(function(){
        let dataLine = $(this).data("infos");
        $('#select-ingredient-recette').val(dataLine.ING_ID)
                .change();
        $('#input-ingredient-recette-nombre').val(dataLine.IGE_NOMBRE);
        $('#hidden-ingredient-recette-id').val(dataLine.IGE_ID);
        $('#action').val("edit");
        $('#delete-ingredient-recette').show();

        $('#modal-add-update-ingredient-recette').modal('show');
    });

    $('#delete-ingredient-recette').click(function(){
        $.ajax({
            url: COMMON_BASE_URL + "recettes/delete_ingredient_recette",
            data: {
                IGE_ID: $('#hidden-ingredient-recette-id').val()
            },
            type: "POST",
            success: function(returnCall){
                if (returnCall.success){
                    add_alert_message('#alert-modal-add-update-ingredient-recette', "success", "La suppression a fonctionné");
                    setTimeout(function(){
                        location.reload();
                    }, 1000);
                }else{
                    add_alert_message('#alert-modal-add-update-ingredient-recette', "failure", returnCall.error_message);
                }
            },
            error: function(xhr, status, error){
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    });

    $('#launch-add-etape').click(function(){
        $('#modal-add-update-etape').modal('show');
    });

    $('#send-add-update-etape').click(function(){
        let that = $('#form_add_update_etape');

        $.ajax({
            url: COMMON_BASE_URL + "recettes/add_etape",
            data: that.serialize(),
            type: "POST",
            beforeSend: function (xhr) {
                raz_form_from_errors("#form_add_update_etape");
            },
            success: function(returnCall){
                if (returnCall.success){
                    add_alert_message('#alert-modal-add-update-etape', "success", "L'action a fonctionné");
                    setTimeout(function(){
                        location.reload();
                    }, 1000);
                }else{
                    add_alert_message('#alert-modal-add-update-etape', "failure", returnCall.error_message);

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

    $('.update-etape-text').dblclick(function(){
        $(this).find('.card-text').fadeOut("slow");
        $(this).find('.text-description-etape').fadeIn("slow");
    });

    $('.text-description-etape').keyup(function(event){
        if ((event.keyCode === 10 || event.keyCode === 13) && event.ctrlKey){
            $.ajax({
                url: COMMON_BASE_URL + "recettes/edit_etape",
                data: {
                    "ETR_ID": $(this).closest(".update-etape-text").find('.id-of-etape').val(),
                    "ETR_DESCRIPTION": $(this).val()
                },
                type: "POST",
                success: function(returnCall){
                    if (returnCall.success){
                        add_alert_message('#alert-update-etape', "success", "Modification de l'étape OK");
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    }else{
                        add_alert_message('#alert-update-etape', "failure", returnCall.error_message);
                    }
                },
                error: function(xhr, status, error){
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        }
    });

    $('#launch-follow-etape').click(function(){
        $('#modal-follow-recette').modal('show');
    });

    $('.start-near-clock').click(function(){
        let that = $(this);
        let elmCountdown = that.parent().find('.countdown');
        let nbSecondsToGo = parseInt(that.data('nbseconds'));
        let interval = setInterval(function(){
            nbSecondsToGo -= 1;
            let textToShow = parseInt(nbSecondsToGo / 60) + ":" + String(nbSecondsToGo % 60).padStart(2, '0');
            elmCountdown.text(textToShow);

            if (nbSecondsToGo <= 0){
                clearInterval(interval);
                $('#alert-stop-countdown').text("Etape " + that.data('ordreetape') + " : Chrono terminé").fadeIn("slow");
                let audio = new Audio(COMMON_BASE_URL + 'audio/bip.mp3');
                audio.play();
                setTimeout(function(){
                    $('#alert-stop-countdown').fadeOut("slow");
                }, 2000);
            }
        }, 1000);
    });
});