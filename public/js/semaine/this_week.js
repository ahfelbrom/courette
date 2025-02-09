$(function(){
    $('#copy-list-ingredient').click(function(){
        let textToCopy = $(this).closest('.card').find('.card-body').text();
        navigator.clipboard.writeText(textToCopy.replace(/\s{2,}/g, "\r\n").trim());
    });

    // Initialisation du datepicker avec options
    $('#datepicker').datepicker({
        showWeek: true,
        firstDay: 1, // Commence la semaine le lundi
        dateFormat: 'yy-mm-dd',
        onSelect: function(dateText, inst) {
            let selectedDate = $(this).datepicker('getDate');
            let weekNumber = getWeekNumber(selectedDate);
            let reconstructedUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
            window.location = reconstructedUrl + "?num_week=" + weekNumber;
        },
        beforeShowDay: function(date) {
            // Ajouter l'attribut data-date aux cellules du calendrier
            let formattedDate = $.datepicker.formatDate('yy-mm-dd', date);
            return [true, '', formattedDate];
        },
        onChangeMonthYear: function(year, month, inst) {
            // Lors du changement de mois, réinitialiser la surbrillance
            $('#datepicker .ui-datepicker-calendar td').removeClass('highlight-week');
        }
    });

    // Ajouter un événement de survol (mouseenter) sur les jours du calendrier
    // Délégation d'événements pour que l'événement soit attaché aux cellules dynamiques
    $(document).on('mouseenter', '.ui-datepicker-calendar td', function() {
        var date = $(this).attr('title');
        if (date) {
            highlightWeek(new Date(date));
        }
    });
    $('#all-week').click(function(){
        $("#datepicker").focus();
    });
    // je lance l'évent click une fois pour lancer proprement la datepicker après (bidouille)
    $('#all-week').click();

    $('.launch-follow-recette').click(function(){
        let that = $(this);
        $.ajax({
            url: COMMON_BASE_URL + "recette/get_all_info_recette?recid=" + that.data('recid'),
            type: "GET",
            success: function(returnCall){
                if (returnCall.success){
                    $('#modal-follow-any-recette').find(".modal-body").html(returnCall.data.content);
                    $('#modal-follow-any-recette').find(".modal-title").text(returnCall.data.recette.REC_NOM);
                    $('#modal-follow-any-recette').find("#nb-all-step").text(returnCall.data.nbSteps);

                    $('#modal-follow-any-recette').modal('show');
                }else{
                    add_alert_message('#alert-error-general', "failure", returnCall.error_message);
                }
            },
            error: function(xhr, status, error){
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    });

    $('.show-liste-ingredient').click(function(){
        let that = $(this);
        $.ajax({
            url: COMMON_BASE_URL + "recette/get_all_ingredient_recette?recid=" + that.data('recid'),
            type: "GET",
            beforeSend: function (xhr) {
                $('#modal-liste-ingredient-recette').find(".modal-body").empty();
            },
            success: function(returnCall){
                if (returnCall.success){
                    let bodyModal = $('#modal-liste-ingredient-recette').find(".modal-body");
                    $.each(returnCall.data, function(key,ingredientInfo) {
                        let strInfoIngredient = ingredientInfo.ING_NOM + " : " + ingredientInfo.IGE_NOMBRE + " " + (ingredientInfo.ING_UNITE !== "Pièce"?ingredientInfo.ING_UNITE:"");
                        bodyModal.append(strInfoIngredient + '<hr style="margin: 0;">');
                    });

                    $('#modal-liste-ingredient-recette').modal('show');
                }else{
                    add_alert_message('#alert-error-general', "failure", returnCall.error_message);
                }
            },
            error: function(xhr, status, error){
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    });

    $(document).on('click', '.update-step-number', function(){
        // on met un timeout histoire de laisser le temps aux classes de se modifier
        // si j'avais des promise pour 
        setTimeout(function(){
            let numberStep = $('#modal-follow-any-recette').find(".carousel-item.active").data("stepnumber");
            $('#modal-follow-any-recette').find("#number-step").text(numberStep);
        }, 700);
    });

    $(document).on("click", '.start-near-clock', function(){
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

// Fonction pour obtenir le numéro de la semaine de l'année
function getWeekNumber(date) {
    let d = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    let dayNum = d.getDay() || 7; // Get current day number
    d.setDate(d.getDate() + 4 - dayNum); // Adjust date to Thursday
    let yearStart = new Date(d.getFullYear(), 0, 1);
    let weekNum = Math.ceil(((d - yearStart) / 86400000 + 1) / 7);

    return weekNum;
}

// Fonction pour surligner toute la semaine (lors du survol)
function highlightWeek(date) {
    var firstDayOfWeek = new Date(date);
    // fix si on est dimanche
    if (date.getDay() === 0) {
        var dateOffset = (24*60*60*1000) * 7;
        date.setTime(date.getTime() - dateOffset);
    }
    // On calcule la date du premier jour de la semaine, (24*60*60*1000) c'est le temps en miliseconde d'une journée
    // on ajoute un jour car on commence la semaine un lundi
    firstDayOfWeek.setTime(date.getTime() - ((24*60*60*1000)*date.getDay()) + (24*60*60*1000));

    // Réinitialiser les surlignage
    $('.ui-datepicker-calendar td').removeClass('highlight-week');

    // Ajouter la classe de surlignage pour tous les jours de la semaine
    for (var i = 0; i < 7; i++) {
        let currentDay = new Date(firstDayOfWeek);
        currentDay.setDate(firstDayOfWeek.getDate() + i);

        let formattedDate = $.datepicker.formatDate('yy-mm-dd', currentDay);
        // Ajouter la classe de surlignage sur le jour correspondant
        $('.ui-datepicker-calendar td[title="' + formattedDate + '"]').addClass('highlight-week');
    }
}