<?php
/**
 * User: dimasik142
 * User: ivanov.dmytro.ua@gmail.com
 * Date: 20.01.2018
 * Time: 16:25
 */

include($_SERVER["DOCUMENT_ROOT"].'/lib/php_interface/init.php');

$user = new \User\UserMethods();
$result['success'] = $user->registerUser($_POST);

echo (json_encode(['success' => $result['success']]));