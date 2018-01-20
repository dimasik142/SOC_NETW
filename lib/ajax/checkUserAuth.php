<?php
/**
 * Created by PhpStorm.
 * User: dimasik142
 * Date: 16.01.2018
 * Time: 14:46
 */
include($_SERVER["DOCUMENT_ROOT"].'/lib/php_interface/init.php');

$user = new \User\UserMethods();
$result['success'] = $user->authUser($_POST['email'], $_POST['pass']);

die(json_encode($result));
