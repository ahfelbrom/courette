function add_alert_message(elmtId, type, message){
    $(elmtId).removeAttr('class')
            .addClass('alert');
    if (type === "success"){
        $(elmtId).addClass('alert-success');
    }else if (type === "failure"){
        $(elmtId).addClass('alert-danger');
    }
    $(elmtId).text(message).fadeIn("slow");

    setTimeout(function(){
        $(elmtId).fadeOut("slow");
    }, 3000);
}

function raz_form_from_errors(elmtId){
    $(elmtId + " .is-invalid").removeClass("is-invalid");
    $(elmtId + " .invalid-feedback").remove();
}

function show_all_errors_in_form(all_errors){
    $.each(all_errors, function(elmName,messageError){
        let invalidElmt = $('<div/>').addClass('invalid-feedback').text(messageError);
        $("[name='" + elmName + "']").addClass('is-invalid');
        $("[name='" + elmName + "']").parent().append(invalidElmt);
    });
}

$(function(){
    if ($('.chosen-select').length > 0) {
        $('.chosen-select').chosen({
            no_results_text: "Aucun résultat", 
            width: "100%"
        });
    }
});