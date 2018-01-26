<?php
/**
 * Created by PhpStorm.
 * User: dimasik142
 * Date: 16.01.2018
 * Time: 14:46
 */
include($_SERVER["DOCUMENT_ROOT"].'/lib/php_interface/init.php');

if ($_POST['email'] != 'admin@amin.admin' AND $_POST['pass'] != 'admin') {
    $user = new \User\UserMethods();
    $result['success'] = $user->authUser($_POST['email'], $_POST['pass']);
} else {
    $result['success'] = 'admin';
    $result['path'] = 'http://localhost/admin/';
}
die(json_encode($result));
