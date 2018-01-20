<?php
/**
 * User: dimasik142
 * User: ivanov.dmytro.ua@gmail.com
 * Date: 19.01.2018
 * Time: 22:58
 */

include($_SERVER["DOCUMENT_ROOT"].'/lib/php_interface/init.php');

\User\UserMethods::logOutUser();
echo (json_encode(['success' => true]));