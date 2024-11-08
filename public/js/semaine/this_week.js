$(function(){
    $('#copy-list-ingredient').click(function(){
        let textToCopy = $(this).closest('.card').find('.card-body').text();
        navigator.clipboard.writeText(textToCopy.replace(/\s{2,}/g, "\r\n").trim());
    });
});