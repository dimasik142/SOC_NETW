/**
 * Created by dimasik142
 * Email ivanov.dmytro.ua@gmail.com
 */

$(document).ready(function(){
    $('body').on('submit', 'form[name=newMassageForm]', function() {
        event.preventDefault();
        chatList.sendMessage($('#newMassage').val());
        $('#newMassage').val('');
    });

    setInterval(function run () {
        chatList.refreshMessagesArray(false);
    }, 5000);

});
