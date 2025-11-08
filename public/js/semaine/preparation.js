let urlParams = new URLSearchParams(window.location.search);
$(function(){
    $('.select-recette-semaine').click(function(){
        listeIdRecetteChoisie[$(this).data('recid')] = {
            id: $(this).data('recid'),
            nombre: $(this).data('recnombre')
        };
        let newRecetteChoisie = $('#prototype-card-recette-choisie').children().clone();
        newRecetteChoisie.find("#nom-recette-choisie").text($(this).data('recnom'));
        newRecetteChoisie.find("#nombre-personne-recette").val($(this).data('recnombre'));
        newRecetteChoisie.find("button").data("recid", $(this).data('recid'));

        $('#list-recette-choisie').append(newRecetteChoisie);
        newRecetteChoisie.fadeIn('slow');
    });

    $('#list-recette-choisie').on("click", '.retirer-recette-semaine', function(){
        let that = $(this);
        delete listeIdRecetteChoisie[$(this).data('recid')];
        that.closest('.carte-recette').fadeOut("slow", function(){
            that.closest('.carte-recette').remove();
        });
    });
    
    $('#list-recette-choisie').on('change', '.update-nombre-plat', function(){
        let idRecetteConcerned = $(this).closest('.carte-recette').find('.retirer-recette-semaine').data("recid");
        listeIdRecetteChoisie[idRecetteConcerned].nombre = $(this).val();
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

    $('#filter-tag').change(function(){
        // d'abord on cherche les éléments qui voudront êtres affichés
        const aFilters = $(this).val();
        let allElemFiltered = $('.card-recette');
        $.each(aFilters, function(iIndex, sFilter){
            allElemFiltered = allElemFiltered.filter(function(iIndex,oElem) {
                return $(oElem).data('listtag').indexOf(sFilter) > -1;
            });
        });

        // ensuite on cache tout puis on affiche que ceux qu'on veut afficher
        $('.card-recette').hide();
        allElemFiltered.each(function(iIndex, oElemFiltered){
            $(oElemFiltered).show();
        });
    });
});