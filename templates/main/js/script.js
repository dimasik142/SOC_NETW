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
            var url = "http://soc:8888/";
            $(location).attr('href',url);
        }).fail(function (result) {
            console.log('Виникла помилка при розлогіненні')
        });
    })

});