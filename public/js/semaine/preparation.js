let urlParams = new URLSearchParams(window.location.search);
$(function(){
    $('.select-recette-semaine').click(function(){
        listeIdRecetteChoisie.push($(this).data('recid'));
        let newRecetteChoisie = $('#prototype-card-recette-choisie').children().clone();
        newRecetteChoisie.find("#nom-recette-choisie").text($(this).data('recnom'));
        newRecetteChoisie.find("button").data("recid", $(this).data('recid'));

        $('#list-recette-choisie').append(newRecetteChoisie);
        newRecetteChoisie.fadeIn('slow');
    });

    $('#list-recette-choisie').on("click", '.retirer-recette-semaine', function(){
        let that = $(this);
        listeIdRecetteChoisie.splice(listeIdRecetteChoisie.indexOf($(this).data('recid')),1);
        that.closest('.carte-recette').fadeOut("slow", function(){
            that.closest('.carte-recette').remove();
        });
    });

    $('#validate-recette-choisie').click(function(){
        $.ajax({
            url: COMMON_BASE_URL + "semaine/select_recette_semaine",
            data: {
                "all_recette": listeIdRecetteChoisie,
                "week_number": urlParams.get("num_week")
            },
            type: "POST",
            success: function(returnCall){
                if (returnCall.success){
                    add_alert_message('#alert-select-recette', "success", "L'action a fonctionné");
                    setTimeout(function(){
                        window.location = COMMON_BASE_URL + "?num_week=" + urlParams.get("num_week");
                    }, 1000);
                }else{
                    add_alert_message('#alert-select-recette', "failure", returnCall.error_message);
                }
            },
            error: function(xhr, status, error){
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    });
});