/**
 * Created by Kévin on 18/05/2015.
 */
var regexMail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

$('form[name=subscription] input[name=lastName]').change(function() {
    if($(this).val().length < 3 && $(this).val() != '')
        $('#errLastName').text('3 caratères minimum');
    else
        $('#errLastName').text('');
});

$('form[name=subscription] input[name=firstName]').change(function() {
    if($(this).val().length < 3 && $(this).val() != '')
        $('#errFirstName').text('3 caratères minimum');
    else
        $('#errFirstName').text('');
});

$('form[name=subscription] input[name=mail]').change(function() {
    mail = $(this).val();
    if(!regexMail.test(mail) && mail != '')
        $('#errMail').text('Mail invalide');
    else
        $('#errMail').text('');
});

$('form[name=subscription] input[name=tel]').change(function() {
    var tel = $(this).val();
    if(tel.length < 10 && tel != '')
        $('#errTel').text('Téléphone invalide');
    else
        $('#errTel').text('');
});

$('form[name=subscription] input[name=password]').change(function() {
    if($(this).val().length < 6 && $(this).val() != '')
        $('#errPass').text('6 caratères minimum');
    else
        $('#errPass').text('');
    if ($(this).val() == $('form[name=subscription] input[name=password_verif]').val())
        $('#errVerif').text('');
});

$('input[name=password_verif]', 'form[name=subscription]').change(function() {
    var pass = $('input[name=password]', 'form[name=subscription]').val();
    var verif = $(this).val();
    if($(this).val() != $('input[name=password]', 'form[name=subscription]').val() && $(this).val() != '')
        $('#errVerif').text('Les mots de passe sont différents');
    else
        $('#errVerif').text('');
    console.log(pass+' -> '+verif);
});

$('form[name=subscription]').submit(function() {
    var formOk = true;
    var data = {};
    $.each($('form[name=subscription]').serializeArray(), function(i, field) {
        data[field.name] = field.value;
    });

    console.log(data);

    if (data.lastName.length < 3)
        formOk = false;
    console.log(formOk+'1');
    if (data.firstName.length < 3)
        formOk = false;
    console.log(formOk+'2');
    if (!regexMail.test(data.mail))
        formOk = false;
    console.log(formOk+'3');
    if (data.password.length < 6)
        formOk = false;
    console.log(formOk+'4');
    if (data.password != data.password_verif)
        formOk = false;
    console.log(formOk+'5');
    if (typeof data.radio == 'undefined')
        formOk = false;
    console.log(formOk+'6');



    return formOk;

    // return false;
});

if ($('.messageFlash').is(":visible")) {
    setTimeout(function() {
        $('.messageFlash').fadeOut();
    }, 4000);
}