<?php
/**
 * User: dimasik142
 * User: ivanov.dmytro.ua@gmail.com
 * Date: 21.01.2018
 * Time: 08:28
 */
include($_SERVER["DOCUMENT_ROOT"].'/lib/php_interface/init.php');

$chat = new \Sql\Communication\Chat\Chat();
echo $chat->saveMessage($_POST['text'],$_SESSION['USER_AUTH_ID'],$_POST['receiver_id']);
