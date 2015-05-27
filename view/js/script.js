/**
 * Created by Kévin on 12/05/2015.
 */
$(document).ready(function() {

    $('#accountMenu').hide();

    // evite l'appartion/disparition du menu si on refresh ailleur dans le site
    if (!$('#header').visible(true, false, 'vertical'))
        $('#menu').hide();

    // scroll pour accéder au contenu après le header
    $("#scrollBottomButton").click(function(){
        $('html, body').animate({scrollTop:$(window).height()}, 'slow');
        $('#menu').fadeOut('fast');
    });

    // scroll pour accéder au contenu après le header
    $(window).scroll(function(){
        if ($('#header').visible(true, false, 'both')){
            $('#menu').fadeIn('slow');
        } else {
            $('#menu').fadeOut('fast');
        }
    });

    if ($('.messageFlash').is(":visible")) {
        setTimeout(function() {
            $('.messageFlash').fadeOut();
        }, 4000);
    }

    $('#goTop').click(function() {
        $("html,body").animate({scrollTop:0}, 1000);
    });

    $('#loadMenu').click(function() {
        if ($('#accountMenu').is(':visible')) {
            $('#accountMenu').fadeOut();
        } else
            $('#accountMenu').fadeIn();
    });
});