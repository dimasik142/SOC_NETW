$(document).ready(function(){
    var touch = $('#touch-menu');
    var menu = $('.nav');

    $(touch).on('click', function(e) {
        e.preventDefault();
        menu.slideToggle();
    });
    $(window).resize(function(){
        var wid = $(window).width();
        if(wid > 760 && menu.is(':hidden')) {
            menu.removeAttr('style');
        }
    });
    $('#logoutButton').click(function () {
        $.ajax({
            type: 'post',
            url: '/lib/ajax/logOut.php',
            dataType: 'json'
        }).done(function (result) {
            var url = "http://localhost";
            $(location).attr('href',url);
        }).fail(function (result) {
            console.log('Виникла помилка при розлогіненні')
        });
    });
    $('body').on('submit', 'form[name=settingsChangePassword]', function() {
        event.preventDefault();

        var lastPass = $('#current_password_settings').val();
        var newPass = $('#new_password_settings').val();
        var newPassRepeat = $('#new_password_repeat_settings').val();

        if (newPass === newPassRepeat) {
            $.ajax({
                type: 'post',
                url: '/lib/ajax/settingsChangePass.php',
                dataType: 'json',
                data: {
                    lastPassword: lastPass,
                    newPassword: newPass
                }
            }).done(function(result) {
                $('.settingsPassResult').html('Пароль змінено');
                $('#current_password_settings').val('')
                $('#new_password_settings').val('')
                $('#new_password_repeat_settings').val('')
            }).fail(function(result) {
                $('.settingsPassError').html('Виникла помилка при зміні паролю');
            });
        } else {
            $('.settingsPassError').html('Нові паролі не співпадають');
        }
    });
});