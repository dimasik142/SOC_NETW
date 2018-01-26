<?php
/**
 * Created by PhpStorm.
 * User: dimasik142
 * Date: 26.01.2018
 * Time: 3:51
 */

include($_SERVER["DOCUMENT_ROOT"].'/lib/php_interface/init.php');

$person = new \Sql\Person\Person();
$result['success'] = $person->changeStatusUser($_POST['id'],$_POST['status']);

die(json_encode($result));