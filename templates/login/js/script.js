$(document).ready(function(){
    $('body').on('submit', 'form[name=LOGIN_FORM]', function() {
        event.preventDefault();

        var email = $('#user_email').val();
        var pass = $('#user_password').val();
        var url = '/lib/ajax/checkUserAuth.php';

        if (email && pass){
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    email:email,
                    pass:pass
                },
                dataType: 'json'
            }).done(function (result) {
                if (result['success']){
                    if (result['success'] !== 'admin') {
                        var url = "http://localhost/home/";
                        $(location).attr('href', url);
                    } else {
                        $(location).attr('href', result['path']);
                    }
                } else {
                    $('.errors').html('Неправильно введені данні або ВИ заблоковані адміністратором')
                }
            }).fail(function (result) {
                $('.errors').html('Некоректні данні')
            });
        }
        return false;
    });
});
