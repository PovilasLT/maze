$(document).delegate('.lightbox img:not(.emoji)', 'click', function (event) {
    event.preventDefault();
    return $(this).ekkoLightbox({type:"image",remote:$(this).attr('src')});
});