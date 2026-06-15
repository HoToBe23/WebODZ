$(function () {
    var filename = $(location).attr('href').split('/').pop();
    $btns = $('#admin-page-handler a');
    $btns.each(function () {
        if ($(this).attr("href") == filename.split('?')[0]) {
            $(this).toggleClass('btn-secondary btn-primary');
        }
    });
});