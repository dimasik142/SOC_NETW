<?php
/**
 * User: dimasik142
 * User: ivanov.dmytro.ua@gmail.com
 * Date: 21.01.2018
 * Time: 10:55
 */

include($_SERVER["DOCUMENT_ROOT"].'/lib/php_interface/init.php');

$chat = new \Sql\Communication\Chat\Chat();
echo $chat->changeMessage($_POST['messageId'], $_POST['text']);