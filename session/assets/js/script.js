$(document).ready( function () {
    setTimeout( function () {
        $("#load").fadeOut();
    }, 400);

    
    $('#avatar').click(function () {
        $('#avatar-drop').toggleClass("active");
    });
    var content = "";
    $(".square > div > div").mouseenter(function () {
        content = $(this).html();
        $(this).html("Coming Soon");
    });
    
    $(".square > div > div").mouseleave(function () {
        $(this).html(content);
    });
});
var scroll = new LocomotiveScroll({
    el: document.querySelector('[data-scroll-container]'),
    smooth: true,
    multiplier: 1.16,
    getSpeed: true,
    scrollFromAnywhere: true
});
scroll.destroy();
$(window).on("load", function () {
scroll.init();
});