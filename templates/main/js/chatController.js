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

    $('body').on('submit', 'form[name=changeMassageForm]', function() {
        event.preventDefault();
        chatList.сhangeMessage($('#newChangeMassage').val());

        $('#changeMassageForm').hide();
        $('#newMassageForm').show();
        $('#newChangeMassage').val('');
        chatList.idMessageToChange = 0;
        chatList.refreshMessagesArray();
    });

    // setInterval(function run () {
    //     chatList.refreshMessagesArray(false);
    // }, 5000);

    $('.changeMessage').click(function () {
        console.log(this)
    });

});
