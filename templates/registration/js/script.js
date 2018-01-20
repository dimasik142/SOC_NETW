/**
 * Created by dimasik142
 * Email ivanov.dmytro.ua@gmail.com
 */

$(document).ready(function(){
    $('body').on('submit', 'form[name=REGISTRATION_FORM]', function() {
        event.preventDefault();

        var pass = $('#pass').val();
        var email = $('#email').val();
        var pass_repeat = $('#pass_repeat').val();
        var data = {
            name : $('#name').val(),
            surename : $('#surename').val(),
            pass : pass,
            email : email
        };
        var url = '/lib/ajax/userRegistration.php';

        if (pass == pass_repeat){
            $.ajax({
                type: 'post',
                url: url,
                data: data,
                dataType: 'json'
            }).done(function (result) {
                if (result['success']['ERROR']){
                    $('.errors').html(result['success']['ERROR']);
                } else {
                    var url = "http://soc:8888/home/";
                    $(location).attr('href',url);
                }
            }).fail(function (result) {
                $('.errors').html('Виникла помилка при реєтрації користувача');
            });
        } else {
            $('.errors').html('Паролі не співпадають');
        }
    });

    $('#name').val('dimas');
    $('#surename').val('ivanov');
    $('#pass').val('60adarep');
    $('#email').val('dimasik111@mail.ua');
    $('#pass_repeat').val('60adarep');

});
