<?php
/**
 * User: dimasik142
 * User: ivanov.dmytro.ua@gmail.com
 * Date: 21.01.2018
 * Time: 00:33
 */

require($_SERVER["DOCUMENT_ROOT"]."/templates/main/header.php");
$chat = new \Sql\Communication\Chat\Chat();
$user = new \Sql\Person\Person();
$userData = $user->getUserInformation($_SESSION['USER_AUTH_ID']);
$userReceiverData = $user->getUserInformation($_GET['id']);

$messagesList = $chat->getMessagesList($_SESSION['USER_AUTH_ID'],$_GET['id'],25);

?>
<script src="../../templates/main/js/ChatList.js"></script>
<script src="../../templates/main/js/chatController.js"></script>

<div class="main_window">
    <div class="block_button_dialog">
        <ul class="dialog_menu">
            <li><a href="/conversations/">Діалоги</a></li>
            <li class="selected"><a href="#">Перегляд діалогів</a></li>
        </ul>
    </div>
    <hr>
        <div id="history"></div>
    <hr>
    <div class="form_block">
        <img src="<?= $userData['photo'] ?>" class="dialog_photo">
        <form name="newMassageForm">
            <input type="text" id="newMassage" required name="newMassage" >
            <input type="submit" value="Отправить" name="send" class="button" style="float: right; margin: 30px 0 0 0">
        </form>
    </div>
</div>
<script>
    var chatList = new ChatList({
        messagesList: '<?= json_encode($messagesList, JSON_FORCE_OBJECT); ?>',
        senderData: '<?= json_encode($userData); ?>',
        receiverData: '<?= json_encode($userReceiverData); ?>',

        deleteMessageAjaxUrl: '/lib/ajax/deleteMessage.php',
        changeMessageAjaxUrl: '/lib/ajax/changeMessage.php',
        sendMessageAjaxUrl: '/lib/ajax/sendMessage.php',
        refreshAjaxUrl: '/lib/ajax/refreshMessageList.php',
        messageQuantity: '250',
        listContainer: '#history'
    });
    chatList.init();
</script>


<?php require($_SERVER["DOCUMENT_ROOT"]."/templates/main/footer.php"); ?>

