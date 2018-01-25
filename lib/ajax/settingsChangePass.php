<?php
/**
 * Created by PhpStorm.
 * User: dimasik142
 * Date: 25.01.2018
 * Time: 21:33
 */

include($_SERVER["DOCUMENT_ROOT"].'/lib/php_interface/init.php');

$person = new \Sql\Person\Person();
$result = $person->changeUserPassword(
    $_SESSION['USER_AUTH_ID'],
    $_POST['lastPassword'],
    $_POST['newPassword']
);

die(json_encode($result));