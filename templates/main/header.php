<?php
/**
 * Created by PhpStorm.
 * User: dimasik142
 * Date: 14.01.2018
 * Time: 3:21
 */
include($_SERVER["DOCUMENT_ROOT"].'/lib/php_interface/init.php');

\User\UserMethods::checkUserAuth();
if (!(\User\UserMethods::checkUserAuth())){
    header('Location: http://'.$_SERVER["HTTP_HOST"].'/personal/auth/');
}

?>
<!DOCTYPE html>
<html lang="ua">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
    <title> Моя сторінка </title>
    <link href="../../templates/main/css/styles.css" rel="stylesheet" />
    <script src="../../templates/main/js/jquery-3.2.1.min.js"></script>
    <script src="../../templates/main/js/script.js"></script>
</head>
<body>
<div class="container">
    <?php include($_SERVER["DOCUMENT_ROOT"].'/templates/main/include/header_menu.html'); ?>
