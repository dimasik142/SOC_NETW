<?php
/**
 * Created by PhpStorm.
 * User: dimasik142
 * Date: 16.01.2018
 * Time: 14:01
 */
include($_SERVER["DOCUMENT_ROOT"].'/lib/php_interface/init.php');

if (\User\UserMethods::checkUserAuth()){
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: http://'.$_SERVER["HTTP_HOST"].'/home/');
}
?>
<!DOCTYPE html>
<html >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title> Вхід </title>
    <link rel="stylesheet" href="../../templates/login/css/style.css" />
    <script src="../../templates/main/js/jquery-3.2.1.min.js"></script>
    <script src="../../templates/login/js/script.js"></script>
</head>